

<div class="row">
    <p class="text-center mb-4 fs-5 fw-bold p-2"
        style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
        {{ __('messages.visitor.title_visit') }} </p>



        {{-- <div class="col-lg-6"> --}}
            <div class="col-md-6 mb-5">
                {{ Form::label('nom',__('messages.visitor.last_name').':' ,['class' => 'form-label']) }}
                {{ Form::select('nom_id', [], null,['class' => 'io-select2 form-select', 'data-control'=>'select2', 'id'=> 'editDoctorCityId','placeholder' => __('messages.visitor.last_name')]) }}
            </div>
        {{-- </div> --}}


        {{-- <div class="col-lg-6"> --}}
            <div class="col-md-6 mb-5">
                {{ Form::label('prenom',__('messages.visitor.first_name').':' ,['class' => 'form-label']) }}
                {{ Form::select('prenom_id', [], null,['class' => 'io-select2 form-select', 'data-control'=>'select2', 'id'=> 'editDoctorCityId','placeholder' => __('messages.visitor.first_name')]) }}
            </div>
        {{-- </div> --}}


        
    
{{-- Statut  --}}
<div class="mb-5">
    <label class="form-label required">
        {{ __('messages.status_title') }}
        :
    </label>
    <span class="is-valid">
        <div class="mt-2">
            <input class="form-check-input" type="radio" name="statut" value="A" id="status_cas_1">
            <label class="form-label mr-3" for="status_cas_1">{{ __('messages.status_cas_1') }}</label>
            <input class="form-check-input ms-2" type="radio" name="statut" value="N"
                id="status_cas_2">
            <label class="form-label mr-3" for="status_cas_2">{{ __('messages.status_cas_2') }}</label>
        </div>
    </span>
</div>

    {{-- HORAIRES  --}}

    <p class="text-center mb-4 fs-5 fw-bold p-2"
        style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
        {{ __('messages.hours') }}
    </p>

    <div class="col-md-6 mb-5">
        {{ Form::label('heure_de_debut', __('messages.start') . ':', ['class' => 'form-label']) }}
        <input type="time" name="heure_de_debut" class="form-control" id="visitorTime">
    </div>

    <div class="col-md-6 mb-5">
        {{ Form::label('heure_de_fin', __('messages.end') . ':', ['class' => 'form-label']) }}
        <input type="time" name="heure_de_fin" class="form-control" id="visitorTime">
    </div>


    {{-- VULNERABILITE --}}

    <p class="text-center mb-4 fs-5 fw-bold p-2"
        style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
        {{ __('messages.vulnerabilite') }}
    </p>

    {{-- Vulnerabilités  1 --}}
    <div class="col-md-6 mb-5">
        <p class="mb-3 fs-5 fw-bold p-2 required">
            {{ __('messages.vulnerabilite_1') }}
        </p>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked1"> {{ __('messages.1') }}
                <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked1">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked2"> {{ __('messages.2') }}
                <input class="form-check-input" type="checkbox" value="2" id="flexCheckChecked2">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked3">{{ __('messages.3') }}

                <input class="form-check-input" type="checkbox" value="3" id="flexCheckChecked3">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked4">{{ __('messages.4') }}
                <input class="form-check-input" type="checkbox" value="4" id="flexCheckChecked4">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked5">{{ __('messages.5') }}
                <input class="form-check-input" type="checkbox" value="5" id="flexCheckChecked5">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked6">{{ __('messages.6') }}
                <input class="form-check-input" type="checkbox" value="6" id="flexCheckChecked6">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked7"> {{ __('messages.7') }}
                <input class="form-check-input" type="checkbox" value="7" id="flexCheckChecked7">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked8">{{ __('messages.8') }}
                <input class="form-check-input" type="checkbox" value="8" id="flexCheckChecked8">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked9">{{ __('messages.9') }}
                <input class="form-check-input" type="checkbox" value="9" id="flexCheckChecked9">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked10">{{ __('messages.10') }}
                <input class="form-check-input" type="checkbox" value="10" id="flexCheckChecked10">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked11">{{ __('messages.11') }}
                <input class="form-check-input" type="checkbox" value="11" id="flexCheckChecked11">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked12">{{ __('messages.12') }}
                <input class="form-check-input" type="checkbox" value="12" id="flexCheckChecked12">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked13">{{ __('messages.13') }}
                <input class="form-check-input" type="checkbox" value="13" id="flexCheckChecked13">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked14">{{ __('messages.14') }}
                <input class="form-check-input" type="checkbox" value="14" id="flexCheckChecked14">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked15">{{ __('messages.15') }}
                <input class="form-check-input" type="checkbox" value="15" id="flexCheckChecked15">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked16">{{ __('messages.16') }}
                <input class="form-check-input" type="checkbox" value="16" id="flexCheckChecked16">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked17">{{ __('messages.17') }}
                <input class="form-check-input" type="checkbox" value="17" id="flexCheckChecked17">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked18">{{ __('messages.18') }}
                <input class="form-check-input" type="checkbox" value="18" id="flexCheckChecked18">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked19">{{ __('messages.19') }}
                <input class="form-check-input" type="checkbox" value="19" id="flexCheckChecked19">

            </label>
        </div>

    </div>

    {{-- Vulnerabilités  2 --}}
    <div class="col-md-6 mb-5">
        <p class="mb-3 fs-5 fw-bold p-2 required">
            {{ __('messages.vulnerabilite_2') }}
        </p>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked2_1"> {{ __('messages.2_1') }}
                <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked2_1">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked2_2"> {{ __('messages.2_2') }}
                <input class="form-check-input" type="checkbox" value="2" id="flexCheckChecked2_2">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked2_3">{{ __('messages.2_3') }}

                <input class="form-check-input" type="checkbox" value="3" id="flexCheckChecked2_3">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked2_4">{{ __('messages.2_4') }}
                <input class="form-check-input" type="checkbox" value="4" id="flexCheckChecked2_4">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked2_5">{{ __('messages.2_5') }}
                <input class="form-check-input" type="checkbox" value="5" id="flexCheckChecked2_5">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked2_6">{{ __('messages.2_6') }}
                <input class="form-check-input" type="checkbox" value="6" id="flexCheckChecked2_6">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked2_7"> {{ __('messages.2_7') }}
                <input class="form-check-input" type="checkbox" value="7" id="flexCheckChecked2_7">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked2_8">{{ __('messages.2_8') }}
                <input class="form-check-input" type="checkbox" value="8" id="flexCheckChecked2_8">

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="flexCheckChecked2_9">{{ __('messages.2_9') }}
                <input class="form-check-input" type="checkbox" value="9" id="flexCheckChecked2_9">

            </label>
        </div>


    </div>


 
    {{-- ENQUETE  --}}

    <p class="text-center mb-4 fs-5 fw-bold p-2"
        style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
        {{ __('messages.enquete') }}
    </p>
    {{-- type d'enquete  --}}
    <div class="col-md-6">
        <div class="mb-5">
            <label class="form-label required">
                {{ __('messages.type') }}
                :
            </label>
            <span class="is-valid">
                <div class="mt-2">
                    <input class="form-check-input" type="radio" name="type" value="1" id="type_1">
                    <label class="form-label mr-3" for="type_1">{{ __('messages.type_1') }}</label>
                    <input class="form-check-input ms-2" type="radio" name="type" value="2"
                        id="type_2">
                    <label class="form-label mr-3" for="type_2">{{ __('messages.type_2') }}</label>
                </div>
            </span>
        </div>
        {{-- motif  --}}
        <div class="col-md-6">
            <div class="mb-5">
                <label class="form-label required">
                    {{ __('messages.motif') }}
                    :
                </label>
                <span class="is-valid">
                    <div class="mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="1"
                                id="motif_1">
                            <label class="form-check-label mb-2" for="motif_1">{{ __('messages.motif_1') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="2"
                                id="motif_2">
                            <label class="form-check-label" for="motif_2">{{ __('messages.motif_2') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="3"
                                id="motif_3">
                            <label class="form-check-label" for="motif_3">{{ __('messages.motif_3') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="4"
                                id="motif_4">
                            <label class="form-check-label" for="motif_4">{{ __('messages.motif_4') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="5"
                                id="motif_5">
                            <label class="form-check-label" for="motif_5">{{ __('messages.motif_5') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="6"
                                id="motif_6">
                            <label class="form-check-label" for="motif_6">{{ __('messages.motif_6') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="7"
                                id="motif_7">
                            <label class="form-check-label" for="motif_7">{{ __('messages.motif_7') }}</label>
                        </div>
                    </div>
                </span>
            </div>
        </div>
    </div>

    {{-- decision  --}}
    <div class="col-md-6">
        <div class="mb-5">
            <label class="form-label required">
                {{ __('messages.decision') }}
                :
            </label>
            <span class="is-valid">
                <div class="mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="decision" value="1"
                            id="decision_1">
                        <label class="form-check-label mb-2" for="decision_1">{{ __('messages.decision_1') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="decision" value="2"
                            id="decision_2">
                        <label class="form-check-label" for="decision_2">{{ __('messages.decision_2') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="decision" value="3"
                            id="decision_3">
                        <label class="form-check-label" for="decision_3">{{ __('messages.decision_3') }}</label>
                    </div>

                </div>
            </span>
        </div>
        {{-- etat de l'enquete  --}}
        <div class="col-md-6">
            <div class="mb-5">
                <label class="form-label required">
                    {{ __('messages.etat_enquete') }}
                    :
                </label>
                <span class="is-valid">
                    <div class="mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="etat_enquete" value="R"
                                id="etat_enquete_1">
                            <label class="form-check-label mb-2"
                                for="etat_enquete_1">{{ __('messages.etat_enquete_1') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="etat_enquete" value="NR"
                                id="etat_enquete_2">
                            <label class="form-check-label"
                                for="etat_enquete_2">{{ __('messages.etat_enquete_2') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="etat_enquete" value="ECR"
                                id="etat_enquete_3">
                            <label class="form-check-label"
                                for="etat_enquete_3">{{ __('messages.etat_enquete_3') }}</label>
                        </div>

                    </div>
                </span>
            </div>
        </div>
        {{-- autres  --}}
        {{-- <div class="col-md-6"> --}}
        <div class="mb-5">
            {{ Form::label('autre', __('messages.autre') . ':', ['class' => 'form-label']) }}
            {{ Form::text('autre', null, ['class' => 'form-control', 'placeholder' => __('messages.autre_txt')]) }}
        </div>
        {{-- </div> --}}
    </div>


    {{-- SERVICE SOLLICITES  --}}

    <p class="text-center mb-4 fs-5 fw-bold p-2"
        style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
        {{ __('messages.services_sollicite') }}
    </p>
    {{-- motifs --}}
    <div class="col-md-6 mb-5">
        <p class="mb-3 fs-5 fw-bold p-2 required">
            {{ __('messages.motif_title') }}
        </p>
        @for ($i = 1; $i <= 28; $i++)
            <div class="form-check">
                <label class="form-check-label" for="cas_{{ $i }}"> {{ __('messages.cas_' . $i) }}
                    <input class="form-check-input" type="checkbox" value="{{ $i }}"
                        id="cas_{{ $i }}">
                </label>
            </div>
        @endfor
        <div class="mb-5">
            {{ Form::label('autre', __('messages.cas_29') . ':', ['class' => 'form-label']) }}
            {{ Form::text('service_motif_autre', null, ['class' => 'form-control', 'placeholder' => __('messages.cas_30')]) }}
        </div>
    </div>

    {{-- Actions menées --}}
    <div class="col-md-6 mb-5">
        <p class="mb-3 fs-5 fw-bold p-2 required">
            {{ __('messages.action_0') }}
        </p>
        @for ($i = 1; $i <= 18; $i++)
            <div class="form-check">
                <label class="form-check-label" for="action_{{ $i }}"> {{ __('messages.action_' . $i) }}
                    <input class="form-check-input" type="checkbox" value="{{ $i }}"
                        id="action_{{ $i }}">
                </label>
            </div>
        @endfor
        <div class="form-check">
            <label class="form-check-label" for="action_19.a"> {{ __('messages.action_19.a') }}
                <input class="form-check-input" type="checkbox" value="19.a" id="action_19.a">
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="action_19.b"> {{ __('messages.action_19.b') }}
                <input class="form-check-input" type="checkbox" value="19.b" id="action_19.b">
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="action_20.a"> {{ __('messages.action_20.a') }}
                <input class="form-check-input" type="checkbox" value="20.a" id="action_20.a">
            </label>
        </div>
        <div class="mb-5">
            {{ Form::label('autre', __('messages.action_20.c') . ':', ['class' => 'form-label']) }}
            {{ Form::text('service_activite_autre', null, ['class' => 'form-control', 'placeholder' => __('messages.action_20.b')]) }}
        </div>
    </div>

{{-- delais de realisation  --}}
<div class="col-md-6">

<div class="mb-5">
    {{ Form::label('delais_details', __('messages.delais_title') . ':', ['class' => 'form-label']) }}
    {{ Form::text('delais_details', null, ['class' => 'form-control', 'placeholder' => __('messages.delais_details')]) }}
</div>
</div>

{{-- resultat de realisation  --}}
    <div class="col-md-6">
        <div class="mb-5">
            <label class="form-label required">
                {{ __('messages.resultat_title') }}
                :
            </label>
            <span class="is-valid">
                <div class="mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="delais_de_realisation" value="R"
                            id="resultat_1">
                        <label class="form-check-label mb-2"
                            for="resultat_1">{{ __('messages.etat_enquete_1') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="delais_de_realisation" value="NR"
                            id="resultat_2">
                        <label class="form-check-label"
                            for="resultat_2">{{ __('messages.etat_enquete_2') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="delais_de_realisation" value="ECR"
                            id="resultat_3">
                        <label class="form-check-label"
                            for="resultat_3">{{ __('messages.etat_enquete_3') }}</label>
                    </div>

                </div>
            </span>
        </div>
    </div>

{{-- Devenir de cas  --}}
<div class="col-md-6 mb-5">
    <p class="mb-3 fs-5 fw-bold p-2 required">
        {{ __('messages.devenir_title') }}
    </p>
    @for ($i = 1; $i <= 14; $i++)
        <div class="form-check">
            <label class="form-check-label" for="devenir_{{ $i }}"> {{ __('messages.devenir_' . $i) }}
                <input class="form-check-input" type="checkbox" value="{{ $i }}"
                    id="devenir_{{ $i }}">
            </label>
        </div>
    @endfor
    
</div>

{{-- obersation  --}}
<div class="col-md-6">
<div class="mb-5">
    {{ Form::label('autre', __('messages.observation_title') . ':', ['class' => 'form-label']) }}
    {{ Form::textarea('observation', null, ['class' => 'form-control', 'placeholder' => __('messages.observation_details')]) }}
</div>
</div>





    
    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('assistants.visiteurs.index') }}" type="reset"
            class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
    </div>






    
    {{-- <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        <label class="pb-2 fs-4 text-gray-600">{{ __('messages.visitor.shool_level') }}</label>
        <span class="fs-4 text-gray-800">

            {{ $visiteur->niveau_scolaire }}
        </span>
    </div> --}}
