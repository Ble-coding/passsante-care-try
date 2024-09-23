<div class="col-md-6 mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.doctor.specialization')  }}</label>
    <br> 
    @foreach($assistantDetailData['data']->occupations as $specialization)
        <span class="badge my-1 me-1 bg-{{ getBadgeColor($loop->index) }}">{{ $specialization->name }}</span>
    @endforeach
</div>

<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient.blood_group')  }}</label>
    <span class="fs-4 text-gray-800">{{ !empty($assistantDetailData['data']->user->blood_group) ? \App\Models\Assistant::BLOOD_GROUP_ARRAY[$assistantDetailData['data']->user->blood_group] : __('messages.common.n/a') }}</span>
</div>

<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.user.gender')  }}</label>
    <span class="fs-4 text-gray-800">{{ ($assistantDetailData['data']->user->gender == 1) ? __('messages.doctor.male') : __('messages.doctor.female') }}</span>
</div>

<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.doctor.dob')  }}</label>
    <span class="fs-4 text-gray-800">{{ !empty($assistantDetailData['data']->user->dob) ? \Carbon\Carbon::parse($assistantDetailData['data']->user->dob)->isoFormat('DD MMM YYYY') : __('messages.common.n/a') }}</span>
</div>

<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.doctor.experience')  }}</label>
    <span class="fs-4 text-gray-800">{{ !empty($assistantDetailData['data']->experience) ? $assistantDetailData['data']->experience : __('messages.common.n/a') }}</span>
</div>

<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.setting.address')  }}</label>
    <span class="fs-4 text-gray-800">{{ !empty($assistantDetailData['data']->user->address->address1) ? $assistantDetailData['data']->user->address->address1 : __('messages.common.n/a') }}</span>
</div>

<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient.registered_on')  }}</label>
    <span class="fs-4 text-gray-800">{{$assistantDetailData['data']->user->created_at->diffForHumans()}}</span>
</div>

<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient.last_updated')  }}</label>
    <span class="fs-4 text-gray-800">{{$assistantDetailData['data']->user->updated_at->diffForHumans()}}</span>
</div>
