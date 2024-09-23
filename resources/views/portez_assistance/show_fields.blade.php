@php $styleCss = 'style' @endphp
<div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
    <div class="card mb-5 mb-xl-8">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.web.patient_name')}}</label>
                    <span class="fs-4 text-gray-800">
                        <a href="{{ getLogInUser()->hasRole('assistant') ?  url('assistants/patients/'.$assistance->assistancePatient->id) :  route('patients.show', $assistance->assistancePatient->id) }}"
                                                         class="fs-3 text-gray-800 text-hover-primary mb-3 text-decoration-none">{{ $assistance->assistancePatient->user->full_name }}</a></span>
                </div>
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.user.email')}}</label>
                    <span class="fs-4 text-gray-800">{{ $assistance->assistancePatient->user->email }}</span>
                </div>
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.patient.profile')}}</label>
                    <img src="{{ $assistance->assistancePatient->profile }}" alt="user" class="object-cover image image-circle" style="height: 50px; width: 50px">
                </div>
                @if(!getLogInUser()->hasRole('assistant'))
                    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                        <label class="pb-2 fs-4 text-gray-600">{{__('messages.assistant_session.assistant')}}</label>
                        <span class="fs-4 text-gray-800"> {{$assistance->assistanceAssistant->user->full_name }}</span>
                    </div>
                @endif
                
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.web.contact') }}</label>
                    <span class="fs-4 text-gray-800">{{ $assistance->assistancePatient->user->contact }}</span>
                </div>
                
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.doctor.created_at')}}</label>
                    <span class="fs-4 text-gray-800" data-bs-toggle="tooltip" data-bs-placement="top"
                          title="{{\Carbon\Carbon::parse($assistance->created_at)->isoFormat('DD MMM YYYY')}}">{{$assistance->updated_at->diffForHumans()}}</span>
                </div>
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.doctor.updated_at')}}</label>
                    <span class="fs-4 text-gray-800" data-bs-toggle="tooltip" data-bs-placement="top"
                          title="{{\Carbon\Carbon::parse($assistance->updated_at)->isoFormat('DD MMM YYYY')}}">{{$assistance->updated_at->diffForHumans()}}</span>
                </div>
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.portez_assistance.assistance_date')}}</label>
                    <span class="fs-4 text-gray-800">{{\Carbon\Carbon::parse($assistance->assistance_date)->isoFormat('DD MMM YYYY')}}</span>
                </div>
                {{-- @if(getLogInUser()->hasRole('assistant'))
                    <div class="col-md-12 d-flex flex-column mb-md-10 mb-5">
                        <label class="pb-2 fs-4 text-gray-600">{{__('messages.portez_assistance.description')}}</label>
                        <span class="fs-4 text-gray-800" style="max-height: 200px; overflow:auto;">{{!empty($assistance->description) ? $assistance->description : 'N/A'}}</span>
                    </div>
                @endif --}}
            </div>
        </div>
    </div>
</div>



<div class="flex-lg-row-fluid">
    <!--begin:::Tabs-->

    <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="subAnalytics" role="tablist">

        <li class="nav-item position-relative me-7 mb-3" role="presentation">
            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                href="#problesTab">{{ __('messages.vulnerabilite') }}</a>
        </li>
        <li class="nav-item position-relative me-7 mb-3" role="presentation">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                href="#observationsTab">{{ __('messages.enquete') }}</a>
        </li>
        <li class="nav-item position-relative me-7 mb-3" role="presentation">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                href="#notesTab">{{ __('messages.services_sollicite') }}</a>
        </li>
        <li class="nav-item position-relative me-7 mb-3" role="presentation">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                href="#prescriptionsTab">{{ __('messages.devenir_du_cas.devenir_title') }}</a>
        </li>
    </ul>

    <!--begin:::Tab content-->
    <div class="tab-content" id="myTabContent">
        <!--begin:::Tab pane-->
        <div class="tab-pane fade active show" id="problesTab" role="tabpanel">
            <!--begin::Card-->
            <div class="card card-flush mb-6 mb-xl-9">
                <div class="card-header align-items-center">
                    <h3 class="align-left m-0">{{ __('messages.vulnerabilite_1') }}</h3>
                </div>
                <div class="card-body pt-4">
                    <div class="p-0 visit-detail-card">
                        <div class="px-2">
                            <div class="col-md-12">
                                <ul class="list-group list-group-flush problem-list" id="problemLists">
                                    @if (!empty($assistance))
                                        @if (is_array($assistance->vulnerabilites))
                                            @foreach ($assistance->vulnerabilites as $vulnerabilite)
                                                @if ($vulnerabilite == 1)
                                                    <li>
                                                        <i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.1') }}
                                                    </li>
                                                @endif
                                                @if ($vulnerabilite == 2)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.2') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 3)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.3') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 4)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.4') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 5)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.5') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 6)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.6') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 7)
                                                    <li> {{ __('messages.vulnerabilites.7') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 8)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.8') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 9)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.9') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 10)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.10') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 11)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.11') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 12)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.12') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 13)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.13') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 14)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.14') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 15)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.15') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 16)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.16') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 17)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.17') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 18)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.18') }}</li>
                                                @endif
                                                @if ($vulnerabilite == 19)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.vulnerabilites.19') }}</li>
                                                @endif
                                            @endforeach
                                        @else
                                            <p class="text-center fw-bold mt-3 text-muted text-gray-600">
                                                {{ __('messages.common.no_records_found') }}
                                            </p>
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end:::Tab pane-->
        <!--begin:::Tab pane-->
        <div class="tab-pane fade" id="observationsTab" role="tabpanel">
            <!--begin::Card-->
            <div class="tab-pane fade active show" id="observationsTab" role="tabpanel">
                <!--begin::Card-->
                <div class="card card-flush mb-6 mb-xl-9">
                    <div class="card-header align-items-center">
                        <h3 class="align-left m-0">{{ __('messages.enquete') }}</h3>
                    </div>
                    <table class="table table-striped align-middle table-row-dashed fs-6 gy-5 mt-5">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bolder fs-7 text-uppercase gs-0">
                                <th scope="col">{{ __('messages.etat_enquete.type_enquete') }}</th>
                                <th scope="col">{{ __('messages.etat_enquete.motif_title') }}</th>
                                <th scope="col">{{ __('messages.decision.title') }}</th>
                                <th scope="col">{{ __('messages.etat_enquete.enquete') }}</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold visit-prescriptions">

                            <tr id="prescriptionLists">
                                <td class="text-break text-wrap">
                                    <ul class="list-group list-group-flush problem-list" id="problemLists">
                                        @if (!empty($assistance))
                                            <li>
                                                <i class="fas fa-check-circle"></i>
                                                @if ($assistance->type === 1)
                                                    {{ __('messages.motif_enquete.1') }}
                                                @endif
                                                @if ($assistance->type === 2)
                                                    {{ __('messages.motif_enquete.2') }}
                                                @endif
                                            </li>
                                        @else
                                            <p class="fw-bold mt-3 text-muted text-gray-600">
                                                {{ __('messages.common.no_records_found') }}
                                            </p>
                                        @endif
                                    </ul>
                                </td>
                                <td class="text-break text-wrap">
                                    <ul class="list-group list-group-flush problem-list" id="problemLists">
                                        @if (!empty($assistance))
                                            <li>
                                                <i class="fas fa-check-circle"></i>
                                                @if ($assistance->motif_enquete === 1)
                                                    {{ __('messages.motif_enquete.1') }}
                                                @endif
                                                @if ($assistance->motif_enquete === 2)
                                                    {{ __('messages.motif_enquete.2') }}
                                                @endif
                                                @if ($assistance->motif_enquete === 3)
                                                    {{ __('messages.motif_enquete.3') }}
                                                @endif
                                                @if ($assistance->motif_enquete === 4)
                                                    {{ __('messages.motif_enquete.4') }}
                                                @endif
                                                @if ($assistance->motif_enquete === 5)
                                                    {{ __('messages.motif_enquete.5') }}
                                                @endif
                                                @if ($assistance->motif_enquete === 6)
                                                    {{ __('messages.motif_enquete.6') }}
                                                @endif
                                                @if ($assistance->motif_enquete === 7)
                                                    {{ __('messages.motif_enquete.7') }}
                                                @endif
                                            </li>
                                        @else
                                            <p class="fw-bold mt-3 text-muted text-gray-600">
                                                {{ __('messages.common.no_records_found') }}
                                            </p>
                                        @endif
                                    </ul>
                                </td>
                                <td class="text-break text-wrap">
                                    {{-- {{ $prescription->duration }} --}}
                                    <ul class="list-group list-group-flush problem-list" id="problemLists">
                                        @if (!empty($assistance))
                                            <li>
                                                <i class="fas fa-check-circle"></i>
                                                @if ($assistance->decision === 1)
                                                    {{ __('messages.decision.1') }}
                                                @endif
                                                @if ($assistance->decision === 2)
                                                    {{ __('messages.decision.2') }}
                                                @endif
                                                @if ($assistance->decision === 3)
                                                    {{ __('messages.decision.3') }}
                                                @endif
                                            </li>
                                        @else
                                            <p class="fw-bold mt-3 text-muted text-gray-600">
                                                {{ __('messages.common.no_records_found') }}
                                            </p>
                                        @endif
                                    </ul>
                                </td>

                                <td class="text-break text-wrap">
                                    <ul class="list-group list-group-flush problem-list" id="problemLists">
                                        @if (!empty($assistance))
                                            <li>
                                                <i class="fas fa-check-circle"></i>
                                                @if ($assistance->etat_enquete === 1)
                                                    {{ __('messages.etat_enquete.realisee') }}
                                                @endif
                                                @if ($assistance->etat_enquete === 2)
                                                    {{ __('messages.etat_enquete.non_realisee') }}
                                                @endif
                                                @if ($assistance->etat_enquete === 3)
                                                    {{ __('messages.etat_enquete.en_cours_realisation') }}
                                                @endif
                                            </li>
                                        @else
                                            <p class="fw-bold mt-3 text-muted text-gray-600">
                                                {{ __('messages.common.no_records_found') }}
                                            </p>
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end:::Tab pane-->
        <!--begin:::Tab pane-->
        <div class="tab-pane fade" id="notesTab" role="tabpanel">
            <!--begin::Card-->
            <div class="tab-pane fade active show" id="notesTab" role="tabpanel">
                <!--begin::Card-->
                <div class="card card-flush mb-6 mb-xl-9">
                    <div class="card-header align-items-center">
                        <h3 class="align-left m-0">{{ __('messages.services_sollicite') }}</h3>
                    </div>
                    <table class="table table-striped align-middle table-row-dashed fs-6 gy-5 mt-5">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bolder fs-7 text-uppercase gs-0">
                                <th scope="col">{{ __('messages.motif_title') }}</th>
                                <th scope="col">{{ __('messages.activite_mener.activite_mener_title') }}</th>
                                <th scope="col">
                                    {{ __('messages.resultat_realisation.resultat_realisation_title') }}</th>
                                <th scope="col">{{ __('messages.delais.delais_title') }}</th>

                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold visit-prescriptions">

                            <tr id="prescriptionLists">
                                <td class="text-break text-wrap">
                                    <ul class="list-group list-group-flush problem-list" id="problemLists">

                                        @if (!empty($assistance))
                                            @if (is_array($assistance->motif_service))
                                                @foreach ($assistance->motif_service as $motif)
                                                    @if ($motif == 1)
                                                        <li>
                                                            <i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.1') }}
                                                        </li>
                                                    @endif
                                                    @if ($motif == 2)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.2') }}</li>
                                                    @endif
                                                    @if ($motif == 3)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.3') }}</li>
                                                    @endif
                                                    @if ($motif == 4)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.4') }}</li>
                                                    @endif
                                                    @if ($motif == 5)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.5') }}</li>
                                                    @endif
                                                    @if ($motif == 6)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.6') }}</li>
                                                    @endif
                                                    @if ($motif == 7)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.7') }}</li>
                                                    @endif
                                                    @if ($motif == 8)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.8') }}</li>
                                                    @endif
                                                    @if ($motif == 9)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.9') }}</li>
                                                    @endif
                                                    @if ($motif == 10)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.10') }}</li>
                                                    @endif
                                                    @if ($motif == 11)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.11') }}</li>
                                                    @endif
                                                    @if ($motif == 12)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.12') }}</li>
                                                    @endif
                                                    @if ($motif == 13)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.13') }}</li>
                                                    @endif
                                                    @if ($motif == 14)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.14') }}</li>
                                                    @endif
                                                    @if ($motif == 15)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.15') }}</li>
                                                    @endif
                                                    @if ($motif == 16)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.16') }}</li>
                                                    @endif
                                                    @if ($motif == 17)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.17') }}</li>
                                                    @endif
                                                    @if ($motif == 18)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.18') }}</li>
                                                    @endif
                                                    @if ($motif == 19)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.19') }}</li>
                                                    @endif
                                                    @if ($motif == 20)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.20') }}</li>
                                                    @endif
                                                    @if ($motif == 21)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.21') }}</li>
                                                    @endif
                                                    @if ($motif == 22)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.22') }}</li>
                                                    @endif
                                                    @if ($motif == 23)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.23') }}</li>
                                                    @endif
                                                    @if ($motif == 24)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.24') }}</li>
                                                    @endif
                                                    @if ($motif == 25)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.25') }}</li>
                                                    @endif
                                                    @if ($motif == 26)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.26') }}</li>
                                                    @endif
                                                    @if ($motif == 27)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.Motifs_du_service.27') }}</li>
                                                    @endif
                                                @endforeach
                                            @else
                                                <p class="text-center fw-bold mt-3 text-muted text-gray-600">
                                                    {{ __('messages.common.no_records_found') }}
                                                </p>
                                            @endif
                                        @endif
                                    </ul>
                                </td>

                                <td class="text-break text-wrap">
                                    <ul class="list-group list-group-flush problem-list" id="problemLists">

                                        @if (!empty($assistance))
                                            @if (is_array($assistance->activites_menees))
                                                @foreach ($assistance->activites_menees as $activite)
                                                    @if ($activite == 1)
                                                        <li>
                                                            <i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.1') }}
                                                        </li>
                                                    @endif
                                                    @if ($activite == 2)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.2') }}</li>
                                                    @endif
                                                    @if ($activite == 3)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.3') }}</li>
                                                    @endif
                                                    @if ($activite == 4)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.4') }}</li>
                                                    @endif
                                                    @if ($activite == 5)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.5') }}</li>
                                                    @endif
                                                    @if ($activite == 6)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.6') }}</li>
                                                    @endif
                                                    @if ($activite == 7)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.7') }}</li>
                                                    @endif
                                                    @if ($activite == 8)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.8') }}</li>
                                                    @endif
                                                    @if ($activite == 9)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.9') }}</li>
                                                    @endif
                                                    @if ($activite == 10)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.10') }}</li>
                                                    @endif
                                                    @if ($activite == 11)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.11') }}</li>
                                                    @endif
                                                    @if ($activite == 12)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.12') }}</li>
                                                    @endif
                                                    @if ($activite == 13)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.13') }}</li>
                                                    @endif
                                                    @if ($activite == 14)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.14') }}</li>
                                                    @endif
                                                    @if ($activite == 15)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.15') }}</li>
                                                    @endif
                                                    @if ($activite == 16)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.16') }}</li>
                                                    @endif
                                                    @if ($activite == 17)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.17') }}</li>
                                                    @endif
                                                    @if ($activite == 18)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.18') }}</li>
                                                    @endif
                                                    @if ($activite == 19)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.19') }}</li>
                                                    @endif
                                                    @if ($activite == 20)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.20') }}</li>
                                                    @endif
                                                    @if ($activite == 21)
                                                        <li><i class="fas fa-check-circle"></i>
                                                            {{ __('messages.activite_mener.21') }}</li>
                                                    @endif
                                                @endforeach
                                            @else
                                                <p class="text-center fw-bold mt-3 text-muted text-gray-600">
                                                    {{ __('messages.common.no_records_found') }}
                                                </p>
                                            @endif
                                        @endif
                                    </ul>
                                </td>

                                <td class="text-break text-wrap">

                                    <ul class="list-group list-group-flush problem-list" id="problemLists">
                                        @if (!empty($assistance))
                                            <li>
                                                <i class="fas fa-check-circle"></i>
                                                @if ($assistance->resultat_realisation === 1)
                                                    {{ __('messages.resultat_realisation.realisee') }}
                                                @endif
                                                @if ($assistance->resultat_realisation === 2)
                                                    {{ __('messages.resultat_realisation.non_realisee') }}
                                                @endif
                                                @if ($assistance->resultat_realisation === 3)
                                                    {{ __('messages.resultat_realisation.en_cours_realisation') }}
                                                @endif
                                            </li>
                                        @else
                                            <p class="fw-bold mt-3 text-muted text-gray-600">
                                                {{ __('messages.common.no_records_found') }}
                                            </p>
                                        @endif
                                    </ul>
                                </td>

                                <td class="text-break text-wrap">{{ $assistance->delai }}
                                    {{ __('messages.resultat_realisation.day') }}

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end:::Tab pane-->
        <!--begin:::Tab pane-->
        <div class="tab-pane fade" id="prescriptionsTab" role="tabpanel">
            <!--begin::Card-->
            <div class="tab-pane fade active show" id="prescriptionsTab" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h3 class="align-left m-0">{{ __('messages.devenir_du_cas.devenir_title') }}</h3>
                </div>
                <table class="table table-striped align-middle table-row-dashed fs-6 gy-5 mt-5">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bolder fs-7 text-uppercase gs-0">
                            <th scope="col">{{ __('messages.devenir_du_cas.devenir_title') }}</th>
                            <th scope="col">{{ __('messages.observation_title') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold visit-prescriptions">
                        <tr id="prescriptionLists">
                            <td class="text-break text-wrap">
                                <ul class="list-group list-group-flush problem-list" id="problemLists">
                                    @if (!empty($assistance))
                                        @if (is_array($assistance->devenir_du_cas))
                                            @foreach ($assistance->devenir_du_cas as $devenir)
                                                @if ($devenir == 1)
                                                    <li>
                                                        <i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.1') }}
                                                    </li>
                                                @endif
                                                @if ($devenir == 2)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.2') }}</li>
                                                @endif
                                                @if ($devenir == 3)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.3') }}</li>
                                                @endif
                                                @if ($devenir == 4)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.4') }}</li>
                                                @endif
                                                @if ($devenir == 5)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.5') }}</li>
                                                @endif
                                                @if ($devenir == 6)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.6') }}</li>
                                                @endif
                                                @if ($devenir == 7)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.7') }}</li>
                                                @endif
                                                @if ($devenir == 8)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.8') }}</li>
                                                @endif
                                                @if ($devenir == 9)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.9') }}</li>
                                                @endif
                                                @if ($devenir == 10)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.10') }}</li>
                                                @endif
                                                @if ($devenir == 11)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.11') }}</li>
                                                @endif
                                                @if ($devenir == 12)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.12') }}</li>
                                                @endif
                                                @if ($devenir == 13)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.13') }}</li>
                                                @endif
                                                @if ($devenir == 14)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.14') }}</li>
                                                @endif
                                                @if ($motif == 15)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.15') }}</li>
                                                @endif
                                                @if ($motif == 16)
                                                    <li><i class="fas fa-check-circle"></i>
                                                        {{ __('messages.devenir_du_cas.16') }}</li>
                                                @endif
                                            @endforeach
                                        @else
                                            <p class="text-center fw-bold mt-3 text-muted text-gray-600">
                                                {{ __('messages.common.no_records_found') }}
                                            </p>
                                        @endif
                                    @endif
                                </ul>


                            </td>
                            <td class="text-break text-wrap">
                                {{ $assistance->observation }}

                            </td>
                        </tr>

                    </tbody>
                </table>
                <!--begin::Card-->

            </div>
            <!--end::Card-->
        </div>
        <!--end:::Tab pane-->
    </div>
    <!--end:::Tab content-->
</div>
