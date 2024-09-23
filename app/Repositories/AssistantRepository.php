<?php

namespace App\Repositories;

use App\DataTable\UserDataTable;
use App\Models\Appointment;
use App\Models\Assistant;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\DoctorSession;
use App\Models\Patient;
use App\Models\Qualification;
use App\Models\Specialization;
use App\Models\User;
use Arr;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use App\Models\Setting;

/**
 * Class AssistantRepository
 */ 
class AssistantRepository extends BaseRepository
{
    public $fieldSearchable = [ 
        'first_name',
        'last_name',
        'email',
        'contact',
        'dob',
        // 'specialization',
        // 'experience',
        'gender',
        'status',
        'password',

    ];

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model()
    {
        return User::class;
    }

    public function getData(): array
    {
        $data['patientUniqueId'] = mb_strtoupper(Patient::generatePatientUniqueId());
        $data['countries'] = Country::toBase()->pluck('name', 'id');
        $data['bloodGroupList'] = Patient::BLOOD_GROUP_ARRAY;

        return $data;
    }

    /**
     * @return mixed
     */
    public function store(array $input)
    {
        $addressInputArray = Arr::only($input,
            ['address1', 'address2', 'country_id', 'city_id', 'state_id', 'postal_code']);
        $doctorArray = Arr::only($input, ['experience', 'twitter_url', 'linkedin_url', 'instagram_url']);
        $specialization = $input['specializations'];
        try {
            DB::beginTransaction();
            $input['email'] = setEmailLowerCase($input['email']);
            $input['status'] = (isset($input['status'])) ? 1 : 0;
            $input['password'] = Hash::make($input['password']);
            $input['type'] = User::ASSISTANT;
            $input['language'] = Setting::where('key','language')->get()->toArray()[0]['value'];
            $doctor = User::create($input);
            $doctor->assignRole('assistant');
            $doctor->address()->create($addressInputArray);
            $createDoctor = $doctor->assistant()->create($doctorArray);
            $createDoctor->specializations()->sync($specialization);
            if (isset($input['profile']) && ! empty('profile')) {
                $doctor->addMedia($input['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }
            $doctor->sendEmailVerificationNotification();

            DB::commit();

            return $doctor;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input, $assistant)
    {
        $addressInputArray = Arr::only($input,
            ['address1', 'address2', 'city_id', 'state_id', 'country_id', 'postal_code']);
        $doctorArray = Arr::only($input, ['experience', 'twitter_url', 'linkedin_url', 'instagram_url']);
        $qualificationArray = json_decode($input['qualifications'], true);
        $specialization = $input['specializations'];
        try {
            DB::beginTransaction();
            $input['email'] = setEmailLowerCase($input['email']);
            $input['status'] = (isset($input['status'])) ? 1 : 0;
            $input['type'] = User::ASSISTANT;
            $assistant->user->update($input);
            $assistant->user->address()->update($addressInputArray);
            $assistant->update($doctorArray);
            $assistant->specializations()->sync($specialization);

            if (count($qualificationArray) >= 0) {
                if (isset($input['deletedQualifications'])) {
                    Qualification::whereIn('id', explode(',', $input['deletedQualifications']))->delete();
                }

                foreach ($qualificationArray as $qualifications) {
                    if ($qualifications == null) {
                        continue;
                    }
                    if (isset($qualifications['id'])) {
                        $assistant->user->qualifications()->where('id', $qualifications['id'])->update($qualifications);
                    } else {
                        unset($qualifications['id']);
                        $assistant->user->qualifications()->create($qualifications);
                    }
                }
            }

            if (isset($input['profile']) && ! empty('profile')) {
                $assistant->user->clearMediaCollection(User::PROFILE);
                $assistant->user->media()->delete();
                $assistant->user->addMedia($input['profile'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
            }
            DB::commit();

            return $assistant;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function updateProfile(array $userInput): bool
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $patient =  Patient::where('user_id',$user->id)->first();


            $addressInputArray = Arr::only($userInput,
                ['address1', 'address2', 'city_id', 'state_id', 'country_id', 'postal_code']);
            $userInput['type'] = User::PATIENT;
            $userInput['email'] = setEmailLowerCase($userInput['email']);
            /** @var Patient $patient */
            $patient->user()->update(Arr::except($userInput, [
                'address1', 'address2', 'city_id', 'state_id', 'country_id', 'postal_code', 'patient_unique_id',
                'avatar_remove',
                'profile', 'is_edit', 'edit_patient_country_id', 'edit_patient_state_id', 'edit_patient_city_id',
                'backgroundImg',
            ]));

            if(isset($patient->address)){
                $patient->address()->update($addressInputArray);
            }else{
                $patient->address()->create($addressInputArray);
            }

            if ((getLogInUser()->hasRole('patient'))) {
                if (! empty($userInput['image'])) {
                    $user->clearMediaCollection(Patient::PROFILE);
                    $user->patient->media()->delete();
                    $user->patient->addMedia($userInput['image'])->toMediaCollection(Patient::PROFILE,
                        config('app.media_disc'));
                }
            } else {
                if ((! empty($userInput['image']))) {
                    $user->clearMediaCollection(User::PROFILE);
                    $user->media()->delete();
                    $user->addMedia($userInput['image'])->toMediaCollection(User::PROFILE, config('app.media_disc'));
                }
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function getSpecializationsData($doctor)
    {
        $data['specializations'] = Specialization::pluck('name', 'id')->toArray();
        $data['doctorSpecializations'] = $doctor->specializations()->pluck('specialization_id')->toArray();
        $data['countryId'] = $doctor->user->address()->pluck('country_id');
        $data['stateId'] = $doctor->user->address()->pluck('state_id');

        return $data;
    }

    /**
     * @return mixed
     */
    public function getCountries()
    {
        $countries = Country::pluck('name', 'id');

        return $countries;
    }

    public function addQualification($input)
    {
        $input['user_id'] = $input['id'];
        $qualification = Qualification::create($input);

        return $qualification;
    }

    /**
     * @throws \Exception
     */
    public function assistantDetail($input): array
    { 
        $todayDate = Carbon::now()->format('Y-m-d');
        $assistant['data'] = Assistant::with(['user.address', 'occupations'])->whereId($input->id)->first();
        // $assistant['data'] = Assistant::with(['user.address', 'occupations', 'appointments.patient.user'])->whereId($input->id)->first();
        $assistant['assistantSession'] = DoctorSession::whereAssistantId($input->id)->get();
        //        $doctor['appointments'] = DataTables::of((new UserDataTable())->getAppointment($input->id))->make(true);
        $assistant['appointmentStatus'] = Appointment::ALL_STATUS;
        $assistant['totalAppointmentCount'] = Appointment::whereAssistantId($input->id)->count();
        $assistant['todayAppointmentCount'] = Appointment::whereAssistantId($input->id)->where('date', '=',
            $todayDate)->count();
        $assistant['upcomingAppointmentCount'] = Appointment::whereAssistantId($input->id)->where('date', '>',
            $todayDate)->count();

        return $assistant;
    }
}
