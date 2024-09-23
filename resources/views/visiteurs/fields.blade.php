
<div class="row">

    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('nom', __('messages.visitor.last_name') . ':', ['class' => 'form-label required']) }}
            {{ Form::text('nom', isset($visiteur) ? $visiteur->nom : null, ['class' => 'form-control', 'placeholder' => __('messages.visitor.last_name'), 'required']) }}

        </div>
    </div>


    {{-- lieu de residence  --}}

    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('lieu_de_residence', __('messages.visitor.lieu_de_residence') . ':', ['class' => 'form-label required']) }}
            {{ Form::text('lieu_de_residence', isset($visiteur) ? $visiteur->lieu_de_residence : null, ['class' => 'form-control', 'placeholder' => __('messages.visitor.lieu_de_residence'), 'required']) }}
        </div>
    </div>

    {{-- prenom  --}}
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('prenom', __('messages.visitor.first_name') . ':', ['class' => 'form-label required']) }}
            {{ Form::text('prenom', isset($visiteur) ? $visiteur->prenom : null, ['class' => 'form-control', 'placeholder' => __('messages.visitor.first_name'), 'required']) }}
        </div>
    </div>

    {{-- profession  --}}

    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('profession', __('messages.visitor.profession') . ':', ['class' => 'form-label required']) }}
            {{ Form::text('profession', isset($visiteur) ? $visiteur->profession : null, ['class' => 'form-control', 'placeholder' => __('messages.visitor.profession'), 'required']) }}
        </div>
    </div>

    {{-- date de naissance  --}}
    <div class="col-md-6">
        <div class="mb-5">
            {{ Form::label('date_de_naissance', __('messages.doctor.dob') . ':', ['class' => 'form-label required']) }}
            {{ Form::text('date_de_naissance', isset($visiteur) ? $visiteur->date_de_naissance : null, ['class' => 'form-control doctor-dob', 'placeholder' => __('messages.doctor.dob'), 'id' => 'dob']) }}
        </div>
    </div>


    {{-- Niveau d'étude  --}}

    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('niveau_scolaire', __('messages.visitor.shool_level') . ':', ['class' => 'form-label required']) }}
            {{ Form::select(
                'niveau_scolaire',
                [
                    '1' => __('messages.visitor.prescolaire'),
                    '2' => __('messages.visitor.primaire'),
                    '3' => __('messages.visitor.secondaire'),
                    '4' => __('messages.visitor.superieur'),
                    '5' => __('messages.visitor.jamais_scolarise'),
                ],
                isset($visiteur) ? $visiteur->niveau_scolaire : null,
                ['class' => 'form-select io-select2', 'required', 'data-control' => 'select2', 'placeholder' => __('messages.visitor.select')]
            ) }}
        </div>
    </div>
    


    {{-- Genre  --}}
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('gender', __('messages.visitor.gender') . ':', ['class' => 'form-label required']) }}
            <span class="is-valid">
                <div class="mt-2">
                    <input class="form-check-input" checked type="radio" name="gender" value="1" 
                    {{ !empty($visiteur) && $visiteur->gender === 1 ? 'checked' : '' }} required>
                    <label class="form-label mr-3">{{ __('messages.visitor.male') }}</label>

                    <input class="form-check-input ms-2" type="radio" name="gender" value="2"
                    {{ !empty($visiteur) && $visiteur->gender === 2 ? 'checked' : '' }} required>
                    <label class="form-label mr-3">{{ __('messages.visitor.female') }}</label>
                </div>
            </span>
        </div>
    </div>
    
    {{-- Cas sociaux  --}}
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('cas_social', __('messages.visitor.cas_sociaux') . ':', ['class' => 'form-label required']) }}
            {{ Form::select(
                'cas_social',
                [
                    '1' => __('messages.visitor.oev'),
                    '2' => __('messages.visitor.chomeur'),
                    '3' => __('messages.visitor.pauvre'),
                    '4' => __('messages.visitor.autres'),
                ],
                isset($visiteur) ? $visiteur->cas_social : null,
                ['class' => 'form-select io-select2', 'required', 'data-control' => 'select2', 'placeholder' => __('messages.visitor.select')]
            ) }}
        </div>
    </div>
    

    {{-- Categorie  --}}

    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('categorie', __('messages.visitor.categorie') . ':', ['class' => 'form-label required']) }}
            <span class="is-valid">
                <div class="mt-2">
                    
                    <input class="form-check-input ms-2" type="radio" name="categorie" value="A" 
                    {{ !empty($visiteur) && $visiteur->categorie === 'A' ? 'checked' : '' }} required>
                    <label class="form-label mr-3">{{ __('messages.visitor.adulte') }}</label>
                    
                    <input class="form-check-input" type="radio" name="categorie" value="E" 
                    {{ !empty($visiteur) && $visiteur->categorie === 'E' ? 'checked' : '' }} required>
                    <label class="form-label mr-3">{{ __('messages.visitor.enfant') }}</label>

                </div>
            </span>
        </div>
    </div>



    {{-- Matrimonial  --}}

    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('matrimonial', __('messages.visitor.matrimonial_situation') . ':', ['class' => 'form-label required']) }}
            {{ Form::select(
                'matrimonial',
                [
                    'C' => __('messages.visitor.celibataire'),
                    'Cb' => __('messages.visitor.concubinage'),
                    'M' => __('messages.visitor.marie'),
                    'D' => __('messages.visitor.divorce'),
                    'V' => __('messages.visitor.veuve_veuf'),
                ],
                isset($visiteur) ? $visiteur->matrimonial : null,['class' => 'form-select io-select2', 'required', 'data-control' => 'select2', 'placeholder' => __('messages.visitor.select')]
            ) }}
        </div>
    </div>
    

    {{-- Contact  --}}

    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('contact', __('messages.staff.contact_no') . ':', ['class' => 'form-label required' ]) }}
            <br>
            {{ Form::tel('contact', isset($visiteur) ? $visiteur->contact : null, ['class' => 'form-control', 'placeholder' => __('messages.patient.contact_no'), 'maxlength' => '10', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57']) }}
        </div>
    </div>
    




    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('assistants.visiteurs.index') }}" type="reset"
            class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
    </div>
</div>
