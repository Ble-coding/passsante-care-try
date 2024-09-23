<?php

namespace App\Http\Controllers;

use App\Events\DeleteAppointmentFromGoogleCalendar;
use App\Http\Requests\CreateAppointmentAssistantRequest;
use App\Http\Requests\CreateFrontAppointmentAssistantRequest;
use App\Models\AppointmentAssistant;
use App\Models\Assistant;
use App\Models\TransactionAssistant;
use App\Models\NotificationAssistant;
use App\Models\Patient;
use App\Models\ServiceAssistant;
use App\Models\User;
use App\Models\UserGoogleAppointment;
use App\Repositories\AppointmentAssistantRepository;
use App\Repositories\GoogleCalendarRepository;
use \PDF;
use Carbon\Carbon;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class AppointmentAssistantController extends AppBaseController
{
    /** @var AppointmentAssistantRepository */
    private $appointmentAssistantRepository;

    public function __construct(AppointmentAssistantRepository $appointmentRepo)
    {
        $this->appointmentAssistantRepository = $appointmentRepo;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $allPaymentStatus = getAllPaymentStatusAssistant();
        $paymentStatus = Arr::except($allPaymentStatus, [AppointmentAssistant::MANUALLY]);
        $paymentGateway = getPaymentGatewayAssistant();

        return view('appointments_assistants.index', compact('allPaymentStatus', 'paymentGateway', 'paymentStatus'));
    }

    /**
     * Show the form for creating a new Appointment.
     *
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        $data = $this->appointmentAssistantRepository->getData();

        return view('appointments_assistants.create', compact('data'));
    }

    /**
     * @throws ApiErrorException
     */

    public function store(CreateAppointmentAssistantRequest $request): JsonResponse
    {
        $input = $request->all();
        $appointment = $this->appointmentAssistantRepository->store($input);

        if ($input['payment_type'] == AppointmentAssistant::STRIPE) {
            $result = $this->appointmentAssistantRepository->createSession($appointment);

            return $this->sendResponse([
                'appointmentId' => $appointment->id,
                'payment_type' => $input['payment_type'],
                $result,
            ], 'Stripe '.__('messages.appointment.session_created_successfully'));
        }

        if ($input['payment_type'] == AppointmentAssistant::PAYSTACK) {
            if ($request->isXmlHttpRequest()) {
                return $this->sendResponse([
                    'redirect_url' => route('paystack.init', ['appointmentData' => $appointment]),
                    'payment_type' => $input['payment_type'],
                    'appointmentId' => $appointment->id,
                ], 'Paystack '.__('messages.appointment.session_created_successfully'));
            }

            return redirect(route('paystack.init'));
        }

        if ($input['payment_type'] == AppointmentAssistant::PAYPAL) {
            if ($request->isXmlHttpRequest()) {
                return $this->sendResponse([
                    'redirect_url' => route('paypal.index', ['appointmentData' => $appointment]),
                    'payment_type' => $input['payment_type'],
                    'appointmentId' => $appointment->id,
                ], 'Paypal '.__('messages.appointment.session_created_successfully'));
            }

            return redirect(route('paypal.init'));
        }

        if ($input['payment_type'] == AppointmentAssistant::RAZORPAY) {
            return $this->sendResponse([
                'payment_type' => $input['payment_type'],
                'appointmentId' => $appointment->id,
            ], 'Razorpay '.__('messages.appointment.session_created_successfully'));
        }

        if ($input['payment_type'] == AppointmentAssistant::AUTHORIZE) {
            return $this->sendResponse([
                'payment_type' => $input['payment_type'],
                'appointmentId' => $appointment->id,
            ], 'Authorize '.__('messages.appointment.session_created_successfully'));
        }

        if ($input['payment_type'] == AppointmentAssistant::PAYTM) {
            return $this->sendResponse([
                'payment_type' => $input['payment_type'],
                'appointmentId' => $appointment->id,
            ], 'Paytm '.__('messages.appointment.session_created_successfully'));
        }

        $url = route('asstts-apptmt.index');

        if (getLogInUser()->hasRole('patient')) {
            $url = route('patients.patient-assistant-appointments-assistant-index');
        }
        $data = [
            'url' => $url,
            'payment_type' => $input['payment_type'],
            'appointmentId' => $appointment->id,
        ];

        return $this->sendResponse($data, __('messages.flash.appointment_create'));
    }

    /**
     * Display the specified Appointment.
     *
     * @return Application|RedirectResponse|Redirector
     */
    // public function show(AppointmentAssistant $appointment)
    // {
    //     $allPaymentStatus = getAllPaymentStatusAssistant();
    //     if (getLogInUser()->hasRole('assistant')) {
    //         $assistant = AppointmentAssistant::whereId($appointment->id)->whereAssistantId(getLogInUser()->assistant->id);
    //         if (! $assistant->exists()) {
    //             return redirect()->back();
    //         }
    //     } elseif (getLogInUser()->hasRole('patient')) {
    //         $patient = AppointmentAssistant::whereId($appointment->id)->wherePatientId(getLogInUser()->patient->id);
    //         if (! $patient->exists()) {
    //             return redirect()->back();
    //         }
    //     }

    //     $appointment = $this->appointmentAssistantRepository->showAppointment($appointment);

    //     if (empty($appointment)) {
    //         Flash::error(__('messages.flash.appointment_not_found'));

    //         if (getLogInUser()->hasRole('patient')) {
    //             return redirect(route('patients.patient-appointments-assistant-index'));
    //         } else {
    //             return redirect(route('admin.asstts-apptmt.index'));
    //         }
    //     }

    //     if (getLogInUser()->hasRole('patient')) {
    //         return view('patient_appointments_assistants.show')->with('appointment', $appointment);
    //     } else {
    //         return view('appointments_assistants.show')->with('appointment', $appointment)
    //         ->with('allPaymentStatus',$allPaymentStatus)
    //         ->with([
    //             'paid' => AppointmentAssistant::PAID,
    //             'pending' => AppointmentAssistant::PENDING,
    //         ])
    //         ->with([
    //             'all' => AppointmentAssistant::ALL,
    //             'book' => AppointmentAssistant::BOOKED,
    //             'checkIn' => AppointmentAssistant::CHECK_IN,
    //             'checkOut' => AppointmentAssistant::CHECK_OUT,
    //             'cancel' => AppointmentAssistant::CANCELLED,
    //         ]);

    //     }
    // }
    public function show(AppointmentAssistant $appointment)
    {
        $allPaymentStatus = getAllPaymentStatusAssistant();

        $user = getLogInUser();

        if ($user->hasRole('assistant')) {
            $assistant = AppointmentAssistant::whereId($appointment->id)->whereAssistantId($user->assistant->id);
            if (! $assistant->exists()) {
                return redirect()->back();
            }
        } elseif ($user->hasRole('patient')) {
            $patient = AppointmentAssistant::whereId($appointment->id)->wherePatientId($user->patient->id);
            if (! $patient->exists()) {
                return redirect()->back();
            }
        }

        $appointment = $this->appointmentAssistantRepository->showAppointment($appointment);

        if (empty($appointment)) {
            Flash::error(__('messages.flash.appointment_not_found'));

            if ($user->hasRole('patient')) {
                return redirect(route('patients.patient-appointments-assistant-index'));
            } else {
                return redirect(route('admin.asstts-apptmt.index'));
            }
        }

        $viewData = [
            'appointment' => $appointment,
            'allPaymentStatus' => $allPaymentStatus,
            'paid' => AppointmentAssistant::PAID,
            'pending' => AppointmentAssistant::PENDING,
            'all' => AppointmentAssistant::ALL,
            'book' => AppointmentAssistant::BOOKED,
            'checkIn' => AppointmentAssistant::CHECK_IN,
            'checkOut' => AppointmentAssistant::CHECK_OUT,
            'cancel' => AppointmentAssistant::CANCELLED,
        ];

        if ($user->hasRole('patient')) {
            return view('patient_appointments_assistants.show', $viewData);
        } else {
            return view('appointments_assistants.show', $viewData);
        }
    }


    /**
     * Remove the specified Appointment from storage.
     */
    // public function destroy(AppointmentAssistant $appointment): JsonResponse
    // {
    //     if (getLogInUser()->hasrole('patient')) {
    //         if ($appointment->patient_id !== getLogInUser()->patient->id) {
    //             return $this->sendError('Seems, you are not allowed to access this record.');
    //         }
    //     }
    //     $appointmentUniqueId = $appointment->appointment_unique_id;

    //     $transaction = TransactionAssistant::whereAppointmentId($appointmentUniqueId)->first();

    //     if ($transaction) {
    //         $transaction->delete();
    //     }

    //     $appointment->delete();

    //     return $this->sendSuccess(__('messages.flash.appointment_delete'));
    // }


    public function destroy(AppointmentAssistant $assistants_appointment): JsonResponse
    {

        // dd($assistants_appointment->patient_id);
        if (getLogInUser()->hasRole('patient')) {
            if ($assistants_appointment->patient_id !== getLogInUser()->patient->id) {
                return $this->sendError('Seems, you are not allowed to access this record.');
            }
        }
        $appointmentUniqueId = $assistants_appointment->appointment_unique_id;

        // dd(appointmentUniqueId);
        $transaction = TransactionAssistant::whereAppointmentId($appointmentUniqueId)->first();

        if ($transaction) {
            $transaction->delete();
        }

        $assistants_appointment->delete();




        return $this->sendSuccess(__('messages.flash.appointment_delete'));
    }


    /**
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function assistantAppointment(Request $request): \Illuminate\View\View
    {
        $appointmentStatus = AppointmentAssistant::ALL_STATUS;
        $paymentStatus = getAllPaymentStatusAssistant();

        return view('assistant_appointment.index', compact('appointmentStatus', 'paymentStatus'));
    }

    /**
     * @return Application|Factory|View|JsonResponse
     */
    public function assistantAppointmentCalendar(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $data = $this->appointmentAssistantRepository->getAppointmentsData();

            return $this->sendResponse($data, __('messages.flash.doctor_appointment'));
        }

        return view('assistant_appointment.calendar');
    }

    /**
     * @return Application|Factory|View
     */
    public function patientAppointmentCalendar(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $data = $this->appointmentAssistantRepository->getPatientAppointmentsCalendar();

            return $this->sendResponse($data, __('messages.flash.patient_appointment'));
        }

        return view('appointments_assistants.patient-calendar');
    }

    /**
     * @return Application|Factory|View|JsonResponse
     */
    public function appointmentCalendar(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $data = $this->appointmentAssistantRepository->getCalendar();

            return $this->sendResponse($data, __('messages.flash.appointment_retrieve'));
        }

        return view('appointments_assistants.calendar');
    }

    /**
     * @return Application|Factory|View
     */
    public function appointmentDetail(AppointmentAssistant $appointment): \Illuminate\View\View
    {
        //not complate query optimize
        $appointment = $this->appointmentAssistantRepository->showAssistantAppointment($appointment);

        return view('assistant_appointment.show', compact('appointment'));
    }

    /**
     * @return mixed
     */
    public function changeStatus(Request $request)
    {
        $input = $request->all();

        if (getLogInUser()->hasRole('assistant')) {
            $doctor = AppointmentAssistant::whereId($input['appointmentId'])->whereAssistantId(getLogInUser()->assistant->id);
            if (! $doctor->exists()) {
                return $this->sendError(__('messages.common.not_allow__assess_record'));
            }
        }

        $appointment = AppointmentAssistant::findOrFail($input['appointmentId']);

        $appointment->update([
            'status' => $input['appointmentStatus'],
        ]);
        $fullTime = $appointment->from_time.''.$appointment->from_time_type.' - '.$appointment->to_time.''.$appointment->to_time_type.' '.' '.Carbon::parse($appointment->date)->format('jS M, Y');
        // $patient = Patient::whereId($appointment->patient_id)->with('user')->first();
        $patient = Patient::whereId($appointment->patient_id)->with('user')->first();
        $doctor = Assistant::whereId($appointment->assistant_id)->with('user')->first();
        if ($input['appointmentStatus'] == AppointmentAssistant::CHECK_OUT) {
            NotificationAssistant::create([
                'title' => NotificationAssistant::APPOINTMENT_CHECKOUT_PATIENT_MSG.' '.getLogInUser()->full_name,
                'type' => NotificationAssistant::CHECKOUT,
                'user_id' => $patient->user_id,
            ]);
            NotificationAssistant::create([
                'title' => $patient->user->full_name.'\'s appointment check out by '.getLogInUser()->full_name.' at '.$fullTime,
                'type' => NotificationAssistant::CHECKOUT,
                'user_id' => $doctor->user_id,
            ]);
        } elseif ($input['appointmentStatus'] == AppointmentAssistant::CANCELLED) {
            $events = UserGoogleAppointment::with(['user'])->where('appointment_id', $appointment->id)->get();

            /** @var GoogleCalendarRepository $repo */
            $repo = App::make(GoogleCalendarRepository::class);

            $repo->destroy($events);

            NotificationAssistant::create([
                'title' => NotificationAssistant::APPOINTMENT_CANCEL_PATIENT_MSG.' '.getLogInUser()->full_name,
                'type' => NotificationAssistant::CANCELED,
                'user_id' => $patient->user_id,
            ]);
            NotificationAssistant::create([
                'title' => $patient->user->full_name.'\'s appointment cancelled by'.getLogInUser()->full_name.' at '.$fullTime,
                'type' => NotificationAssistant::CANCELED,
                'user_id' => $doctor->user_id,
            ]);
        }

        return $this->sendSuccess(__('messages.flash.status_update'));
    }

    /**
     * @return mixed
     */
    public function cancelStatusAssistant(Request $request)
    {

        $appointment = AppointmentAssistant::findOrFail($request['appointmentId']);
        if ($appointment->patient_id !== getLogInUser()->patient->id) {
            return $this->sendError(__('messages.common.not_allow__assess_record'));
        }
        $appointment->update([
            'status' => AppointmentAssistant::CANCELLED,
        ]);

        $events = UserGoogleAppointment::with('user')
            ->where('appointment_id', $appointment->id)
            ->get()
            ->groupBy('user_id');

        foreach ($events as $userID => $event) {
            $user = $event[0]->user;
            DeleteAppointmentFromGoogleCalendar::dispatch($event, $user);
        }

        $fullTime = $appointment->from_time.''.$appointment->from_time_type.' - '.$appointment->to_time.''.$appointment->to_time_type.' '.' '.Carbon::parse($appointment->date)->format('jS M, Y');
        $patient = Patient::whereId($appointment->patient_id)->with('user')->first();

        $assistant = Assistant::whereId($appointment->assistant_id)->with('user')->first();
        NotificationAssistant::create([
            'title' => $patient->user->full_name.' '.NotificationAssistant::APPOINTMENT_CANCEL_ASSISTANT_MSG.' '.$fullTime,
            'type' => NotificationAssistant::CANCELED,
            'user_id' => $assistant->user_id,
        ]);

        return $this->sendSuccess(__('messages.flash.appointment_cancel'));
    }

    // public function cancelStatusAssistant(Request $request): JsonResponse
    // {
    //     $user = Auth::user();

    //     // Vérifiez si l'utilisateur est un patient
    //     if ($user->hasRole('patient')) {
    //         $patient = $user->patient;
    //         $appointment = AppointmentAssistant::where('id', $request->appointmentId)
    //             ->where('patient_id', $patient->id)
    //             ->first();

    //         if (!$appointment) {
    //             return $this->sendError(__('messages.common.not_allow__assess_record'));
    //         }
    //     } else {
    //         // Autres vérifications pour les rôles, si nécessaire
    //         return $this->sendError(__('messages.common.not_allow__assess_record'));
    //     }

    //     $appointment->update([
    //         'status' => AppointmentAssistant::CANCELLED,
    //     ]);

    //     // Notification et suppression du calendrier
    //     $this->handleNotificationsAndCalendar($appointment);

    //     return $this->sendSuccess(__('messages.flash.appointment_cancel'));
    // }

    // private function handleNotificationsAndCalendar(AppointmentAssistant $appointment)
    // {
    //     $events = UserGoogleAppointment::with('user')
    //         ->where('appointment_id', $appointment->id)
    //         ->get()
    //         ->groupBy('user_id');

    //     foreach ($events as $userID => $event) {
    //         $user = $event[0]->user;
    //         DeleteAppointmentFromGoogleCalendar::dispatch($event, $user);
    //     }

    //     $fullTime = $appointment->from_time . '' . $appointment->from_time_type . ' - ' . $appointment->to_time . '' . $appointment->to_time_type . ' ' . Carbon::parse($appointment->date)->format('jS M, Y');
    //     $patient = Patient::whereId($appointment->patient_id)->with('user')->first();

    //     $assistant = Assistant::whereId($appointment->assistant_id)->with('user')->first();
    //     NotificationAssistant::create([
    //         'title' => $patient->user->full_name . ' ' . NotificationAssistant::APPOINTMENT_CANCEL_ASSISTANT_MSG . ' ' . $fullTime,
    //         'type' => NotificationAssistant::CANCELED,
    //         'user_id' => $assistant->user_id,
    //     ]);
    // }


    /**
     * @throws ApiErrorException
     */
    public function frontAppointmentBook(CreateFrontAppointmentAssistantRequest $request): JsonResponse
    {
        app()->setLocale(checkLanguageSession());
        $input = $request->all();
        $appointment = $this->appointmentAssistantRepository->frontSideStore($input);
        if ($input['payment_type'] == AppointmentAssistant::STRIPE) {
            $result = $this->appointmentAssistantRepository->createSession($appointment);

            return $this->sendResponse([
                'payment_type' => $input['payment_type'],
                $result,
            ], 'Stripe '.__('messages.appointment.session_created_successfully'));
        }

        if ($input['payment_type'] == AppointmentAssistant::PAYPAL) {
            if ($request->isXmlHttpRequest()) {
                return $this->sendResponse([
                    'redirect_url' => route('paypal.index', ['appointmentData' => $appointment]),
                    'payment_type' => $input['payment_type'],
                    'appointmentId' => $appointment->id,
                ], 'Paypal '.__('messages.appointment.session_created_successfully'));
            }
        }

        if ($input['payment_type'] == AppointmentAssistant::PAYSTACK) {
            if ($request->isXmlHttpRequest()) {
                return $this->sendResponse([
                    'redirect_url' => route('paystack.init', ['appointmentData' => $appointment]),
                    'payment_type' => $input['payment_type'],
                ], 'Paystck '.__('messages.appointment.session_created_successfully'));
            }

            return redirect(route('paystack.init'));
        }

        if ($input['payment_type'] == AppointmentAssistant::RAZORPAY) {
            return $this->sendResponse([
                'payment_type' => $input['payment_type'],
                'appointmentId' => $appointment->id,
            ], 'Razorpay '.__('messages.appointment.session_created_successfully'));
        }

        if ($input['payment_type'] == AppointmentAssistant::PAYTM) {
            return $this->sendResponse([
                'payment_type' => $input['payment_type'],
                'appointmentId' => $appointment->id,
            ], 'Paytm '.__('messages.appointment.session_created_successfully'));
        }

        if ($input['payment_type'] == AppointmentAssistant::AUTHORIZE) {
            return $this->sendResponse([
                'payment_type' => $input['payment_type'],
                'appointmentId' => $appointment->id,
            ], __('messages.appointment.authorize_session_created_successfully'));
        }

        $data['payment_type'] = $input['payment_type'];
        $data['appointmentId'] = $appointment->id;

        return $this->sendResponse($data, __('messages.flash.appointment_booked'));
    }

    public function frontHomeAppointmentBook(Request $request): RedirectResponse
    {
        $data = $request->all();

        return redirect()->route('medicalAppointment')->with(['data' => $data]);
    }

    /**
     * @return HigherOrderBuilderProxy|mixed|string
     *
     * @throws Exception
     */
    public function getPatientName(Request $request)
    {
        $checkRecord = User::whereEmail($request->email)->whereType(User::PATIENT)->first();

        if ($checkRecord != '') {
            return $this->sendResponse($checkRecord->full_name, __('messages.appointment.patient_name_retrieved') );
        }

        return false;
    }

    /**
     * @return Application|RedirectResponse|Redirector
     *
     * @throws ApiErrorException
     */
    public function paymentSuccess(Request $request): RedirectResponse
    {
        $sessionId = $request->get('session_id');
        if (empty($sessionId)) {
            throw new UnprocessableEntityHttpException(__('messages.appointment.session_id_required'));
        }
        setStripeApiKey();

        $sessionData = \Stripe\Checkout\Session::retrieve($sessionId);
        $appointment = AppointmentAssistant::whereAppointmentUniqueId($sessionData->client_reference_id)->first();
        $patientId = User::whereEmail($sessionData->customer_details->email)->pluck('id')->first();
        $transaction = [
            'user_id' => $patientId,
            'transaction_id' => $sessionData->id,
            'appointment_id' => $sessionData->client_reference_id,
            'amount' => intval($sessionData->amount_total / 100),
            'type' => AppointmentAssistant::STRIPE,
            'meta' => $sessionData,
        ];

        TransactionAssistant::create($transaction);

        $appointment->update([
            'payment_method' => AppointmentAssistant::STRIPE,
            'payment_type' => AppointmentAssistant::PAID,
        ]);

        Flash::success(__('messages.flash.appointment_created_payment_complete'));

        $patient = Patient::whereUserId($patientId)->with('user')->first();
        NotificationAssistant::create([
            'title' => NotificationAssistant::APPOINTMENT_PAYMENT_DONE_PATIENT_MSG,
            'type' => NotificationAssistant::PAYMENT_DONE,
            'user_id' => $patient->user_id,
        ]);

        if (parse_url(url()->previous(), PHP_URL_PATH) == '/medical-appointment-assistant') {
            return redirect(route('medicalAppointmentAssistant'));
        }

        if (! getLogInUser()) {
            return redirect(route('medical-assistant'));
        }

        if (getLogInUser()->hasRole('patient')) {
            return redirect(route('patients.patient-appointments-assistants-index'));
        }

        return redirect(route('appointments_assistants.index'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function handleFailedPayment(): RedirectResponse
    {
        setStripeApiKey();

        Flash::error(__('messages.flash.appointment_created_payment_not_complete'));

        if (! getLogInUser()) {
            return redirect(route('medicalAppointment'));
        }

        if (getLogInUser()->hasRole('patient')) {
            return redirect(route('patients.patient-appointments-index'));
        }

        return redirect(route('asstts-apptmt.index'));
    }

    /**
     * @return mixed
     *
     * @throws ApiErrorException
     */
    public function appointmentPayment(Request $request)
    {
        $appointmentId = $request['appointmentId'];
        $appointment = AppointmentAssistant::whereId($appointmentId)->first();

        $result = $this->appointmentAssistantRepository->createSession($appointment);

        return $this->sendResponse($result, __('messages.appointment.session_created_successfully'));
    }

    /**
     * @return mixed
     */
    public function changePaymentStatus(Request $request)
    {
        $input = $request->all();
        if (getLogInUser()->hasRole('assistant')) {
            $doctor = AppointmentAssistant::whereId($input['appointmentId'])->whereAssistantId(getLogInUser()->assistant->id);
            if (! $doctor->exists()) {
                return $this->sendError(__('messages.common.not_allow__assess_record'));
            }
        }

        $appointment = AppointmentAssistant::with('patient')->findOrFail($input['appointmentId']);
        $transactionExist = TransactionAssistant::whereAppointmentId($appointment['appointment_unique_id'])->first();

        $appointment->update([
            'payment_type' => $input['paymentStatus'],
            'payment_method' => $input['paymentMethod'],
        ]);

        if (empty($transactionExist)) {
            $transaction = [
                'user_id' => $appointment->patient->user_id,
                'transaction_id' => Str::random(10),
                'appointment_id' => $appointment->appointment_unique_id,
                'amount' => $appointment->payable_amount,
                'type' => AppointmentAssistant::MANUALLY,
                'status' => TransactionAssistant::SUCCESS,
                'accepted_by' => $input['loginUserId'],
            ];

            TransactionAssistant::create($transaction);
        } else {
            $transactionExist->update([
                'status' => TransactionAssistant::SUCCESS,
                'accepted_by' => $input['loginUserId'],
            ]);
        }

        $appointmentNotification = TransactionAssistant::with('acceptedPaymentUser')->whereAppointmentId($appointment['appointment_unique_id'])->first();

        $fullTime = $appointment->from_time.''.$appointment->from_time_type.' - '.$appointment->to_time.''.$appointment->to_time_type.' '.' '.Carbon::parse($appointment->date)->format('jS M, Y');
        $patient = Patient::whereId($appointment->patient_id)->with('user')->first();
        NotificationAssistant::create([
            'title' => $appointmentNotification->acceptedPaymentUser->full_name.' changed the payment status '.AppointmentAssistant::PAYMENT_TYPE[AppointmentAssistant::PENDING].' to '.AppointmentAssistant::PAYMENT_TYPE[$appointment->payment_type].' for appointment '.$fullTime,
            'type' => NotificationAssistant::PAYMENT_DONE,
            'user_id' => $patient->user_id,
        ]);

        return $this->sendSuccess(__('messages.flash.payment_status_updated'));
    }

    public function cancelAppointment($patient_id, $appointment_unique_id): RedirectResponse
    {
        //not complate  query
        $uniqueId = Crypt::decryptString($appointment_unique_id);
        $appointment = AppointmentAssistant::whereAppointmentUniqueId($uniqueId)->wherePatientId($patient_id)->first();

        $appointment->update(['status' => AppointmentAssistant::CANCELLED]);

        return redirect(route('medical'));
    }

    public function assistantBookAppointment(Assistant $doctor): RedirectResponse
    {
        $data = [];
        $data['assistant_id'] = $doctor['id'];

        return redirect()->route('medicalAppointment')->with(['data' => $data]);
    }

    public function serviceBookAppointment(ServiceAssistant $service): RedirectResponse
    {
        $data = [];
        $data['service'] = ServiceAssistant::whereStatus(ServiceAssistant::ACTIVE)->get()->pluck('name', 'id');
        $data['service_id'] = $service['id'];

        return redirect()->route('medicalAppointment')->with(['data' => $data]);
    }

    /**
     * @return bool|JsonResponse
     */
    public function createGoogleEventForAssistant(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->sendSuccess(__('messages.flash.operation_performed_success'));
        }

        return true;
    }

    /**
     * @return bool|JsonResponse
     */
    public function createGoogleEventForPatient(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->sendSuccess(__('messages.flash.operation_performed_success'));
        }
        return true;
    }

    public function manuallyPayment(Request $request): RedirectResponse
    {
        $input = $request->all();
        $appointment = AppointmentAssistant::findOrFail($input['appointmentId'])->load('patient');
        $transaction = [
            'user_id' => $appointment->patient->user_id,
            'transaction_id' => Str::random(10),
            'appointment_id' => $appointment->appointment_unique_id,
            'amount' => $appointment->payable_amount,
            'type' => AppointmentAssistant::MANUALLY,
            'status' => TransactionAssistant::PENDING,
        ];

        TransactionAssistant::create($transaction);

        if (parse_url(url()->previous(), PHP_URL_PATH) == '/medical-appointment') {
            return redirect(route('medicalAppointment'));
        }

        if (! getLogInUser()) {
            return redirect(route('medical'));
        }

        if (getLogInUser()->hasRole('patient')) {
            return redirect(route('patients.patient-assistant-appointments-assistant-index'));
        }

        if (getLogInUser()->hasRole('assistant')) {

            return redirect(route('assistants.asstts-apptmt'));
        }

        return redirect(route('appointments.index'));
    }

    public function appointmentPdf($id)
    {
        // $datas = AppointmentAssistant::with(['patient.user', 'assistant.user', 'services'])->findOrFail($id);
        $datas = AppointmentAssistant::with(['patient.user', 'assistant.user', 'services'])->findOrFail($id);
        $pdf = Pdf::loadView('assistant_appointment_pdf.invoice', ['datas' => $datas]);

        return $pdf->download('invoice.pdf');
    }
}
