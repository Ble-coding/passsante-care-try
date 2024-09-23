<div class="row">
    <p class="text-center mb-4 fs-5 fw-bold p-2"
    style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
    {{ __('messages.portez_assistance.information') }} </p> 

    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('assistance_date', __('messages.portez_assistance.assistance_date') . ':', ['class' => 'form-label required']) }}
            {{ Form::text('assistance_date', isset($assistance) ? $assistance['assistance_date'] : null, ['class' => 'form-control visit-date', 'id' => isset($assistance) ? 'editDate' : 'date', 'placeholder' => __('messages.portez_assistance.assistance_date')]) }}
        </div>
    </div>


    @role('assistant')
        {{ Form::hidden('assistant_id', getLoginUser()->assistant->id) }}
    @else
        <div class="col-lg-6">
            <div class="mb-5">
                {{ Form::label('Assistant', __('messages.portez_assistance.assistant') . ':', ['class' => 'form-label required']) }}
                {{ Form::select('assistant_id', $data['assistants'], isset($assistance['assistant_id']) ? $assistance['assistant_id'] : null, ['class' => 'form-select io-select2', 'data-control' => 'select2', 'id' => 'doctorId', 'placeholder' => __('messages.portez_assistance.assistant')]) }}
            </div>
        </div>
    @endrole


    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('Patient', __('messages.portez_assistance.patient') . ':', ['class' => 'form-label required']) }}
            {{ Form::select('patient_id', $data['patients'], isset($data['patientUniqueId']) ? $data['patientUniqueId'] : null, ['class' => 'form-select io-select2', 'data-control' => 'select2', 'placeholder' => __('messages.portez_assistance.patient')]) }}
        </div>
    </div>

    <div class="col-md-6 mb-5">
        {{ Form::label('heure_debut', __('messages.start') . ':', ['class' => 'form-label required']) }}
        {{ Form::time('heure_debut', isset($assistance) ? $assistance->heure_debut : null, ['class' => 'form-control']) }}
    </div>

    <div class="col-md-6 mb-5">
        {{ Form::label('heure_fin', __('messages.end') . ':', ['class' => 'form-label required']) }}
        {{ Form::time('heure_fin', isset($assistance) ? $assistance->heure_fin : null, ['class' => 'form-control']) }}
    </div>

    <p class="text-center mb-4 fs-5 fw-bold p-2"
    style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
    {{ __('messages.vulnerabilite') }}
</p>

    <div class="mb-5">
        {{ Form::label('statut', __('messages.status_title') . ':', ['class' => 'form-label required']) }}
        <span class="is-valid">
            <div class="mt-2">
                <input class="form-check-input" checked type="radio" name="statut" value="1" id="status_cas_1"
                    {{ !empty($assistance) && $assistance->statut === 1 ? 'checked' : '' }} required>
                <label class="form-label mr-3" for="status_cas_1">{{ __('messages.status_cas_1') }}</label>

                <input class="form-check-input ms-2" type="radio" name="statut" value="2" id="status_cas_2"
                    {{ !empty($assistance) && $assistance->statut === 2 ? 'checked' : '' }} required>
                <label class="form-label mr-3" for="status_cas_2">{{ __('messages.status_cas_2') }}</label>
            </div>
        </span>
    </div>

    <div class="col-md-6 mb-5">
        {{ Form::label('vulnerabilites', __('messages.vulnerabilite_1') . ':', ['class' => 'form-label required']) }}
        <?php
        $vulnerabilites = [
            '1' => 'Maltraité',
            '2' => 'Enfants Victime d\'abus sexuel',
            '3' => 'Exploité',
            '4' => 'Trafic de personne',
            '5' => 'Enfant non accompagné',
            '6' => 'Enfant soldat',
            '7' => 'Handicapé',
            '8' => 'Enfant séparé',
            '9' => 'Enfant au travail',
            '10' => 'Enfant de la rue',
            '11' => 'Enfant dans la rue',
            '12' => 'Filles mères',
            '13' => 'Personne affectées par le VIH',
            '14' => 'Personnes vivant avec le VIH',
            '15' => 'Personnes âgés',
            '16' => 'Sans domicile fixe',
            '17' => 'Femmes victime de violence sexuelle', 
            '18' => 'Femmes battus',
            '19' => 'Violences conjugales',
        ];
        ?>
        <div>
            @foreach ($vulnerabilites as $key => $vulnerabilite)
                <div>
                    {{ Form::checkbox('vulnerabilites[]', $key, in_array($key, $assistance->vulnerabilites ?? []), ['class' => 'form-check-input mb-1', 'id' => 'vulnerabilites' . $key]) }}
                    {{ Form::label('vulnerabilites' . $key, $vulnerabilite, ['class' => 'form-check-label']) }}
                </div>
            @endforeach
        </div>
    </div>

    <p class="text-center mb-4 fs-5 fw-bold p-2"
    style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
    {{ __('messages.etat_enquete.enquete_title') }}
</p>

    <div class="mb-5">
        {{ Form::label('type', __('messages.etat_enquete.type') . ':', ['class' => 'form-label required']) }}
        <span class="is-valid">
            <div class="mt-2">
                <input class="form-check-input" type="radio" name="type" value="1" id="type_1"
                    {{ !empty($assistance) && $assistance->type === 1 ? 'checked' : '' }} required>
                <label class="form-label mr-3" for="type_1">{{ __('messages.etat_enquete.type_1') }}</label>
                <input class="form-check-input ms-2" type="radio" name="type" value="2" id="type_2"
                    {{ !empty($assistance) && $assistance->type === 2 ? 'checked' : '' }} required>
                <label class="form-label mr-3" for="type_2">{{ __('messages.etat_enquete.type_2') }}</label>
            </div>
        </span>
    </div>

    <div class="col-md-6 mb-5">
        <div class="col-md-6">
            <div class="mb-5">
                {{ Form::label('motif_enquete', __('messages.etat_enquete.motif_title') . ':', ['class' => 'form-label required']) }}
                <span class="is-valid">
                    <div class="mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif_enquete" value="1"
                                id="motif_1"
                                {{ !empty($assistance) && $assistance->motif_enquete === 1 ? 'checked' : '' }}
                                required>
                            <label class="form-check-label mb-2" for="motif_1">{{ __('messages.motif_enquete.1') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif_enquete" value="2"
                                id="motif_2"
                                {{ !empty($assistance) && $assistance->motif_enquete === 2 ? 'checked' : '' }}
                                required>
                            <label class="form-check-label mb-2" for="motif_2">{{ __('messages.motif_enquete.2') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif_enquete" value="3"
                                id="motif_3"
                                {{ !empty($assistance) && $assistance->motif_enquete === 3 ? 'checked' : '' }}
                                required>
                            <label class="form-check-label mb-2" for="motif_3">{{ __('messages.motif_enquete.3') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif_enquete" value="4"
                                id="motif_4"
                                {{ !empty($assistance) && $assistance->motif_enquete === 4 ? 'checked' : '' }}
                                required>
                            <label class="form-check-label mb-2" for="motif_4">{{ __('messages.motif_enquete.4') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif_enquete" value="5"
                                id="motif_5"
                                {{ !empty($assistance) && $assistance->motif_enquete === 5 ? 'checked' : '' }}
                                required>
                            <label class="form-check-label mb-2" for="motif_5">{{ __('messages.motif_enquete.5') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif_enquete" value="6"
                                id="motif_6"
                                {{ !empty($assistance) && $assistance->motif_enquete === 6 ? 'checked' : '' }}
                                required>
                            <label class="form-check-label mb-2" for="motif_6">{{ __('messages.motif_enquete.6') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif_enquete" value="7"
                                id="motif_7"
                                {{ !empty($assistance) && $assistance->motif_enquete === 7 ? 'checked' : '' }}
                                required>
                            <label class="form-check-label" for="motif_7">{{ __('messages.motif_enquete.7') }}</label>
                        </div>
                    </div>
                </span>
            </div>

        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-5">
            {{ Form::label('decision', __('messages.decision.title') . ':', ['class' => 'form-label required']) }}
            <span class="is-valid">
                <div class="mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="decision" value="1"
                            id="decision_1" {{ !empty($assistance) && $assistance->decision === 1 ? 'checked' : '' }}
                            required>
                        <label class="form-check-label mb-2" for="decision_1">{{ __('messages.decision.1') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="decision" value="2"
                            id="decision_2" {{ !empty($assistance) && $assistance->decision === 2 ? 'checked' : '' }}
                            required>
                        <label class="form-check-label mb-2" for="decision_2">{{ __('messages.decision.2') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="decision" value="3"
                            id="decision_3" {{ !empty($assistance) && $assistance->decision === 3 ? 'checked' : '' }}
                            required>
                        <label class="form-check-label" for="decision_3">{{ __('messages.decision.3') }}</label>
                    </div>
                </div>
            </span>
        </div>

        <div class="col-md-6">
            <div class="mb-5">
                {{ Form::label('etat_enquete', __('messages.etat_enquete.enquete') . ':', ['class' => 'form-label required']) }}
                <div class="mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="etat_enquete" value="1"
                            id="etat_enquete1"
                            {{ !empty($assistance) && $assistance->etat_enquete === 1 ? 'checked' : '' }} required>
                        <label class="form-check-label"
                            for="etat_enquete1">{{ __('messages.etat_enquete.realisee') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="etat_enquete" value="2"
                            id="etat_enquete2"
                            {{ !empty($assistance) && $assistance->etat_enquete === 2 ? 'checked' : '' }} required>
                        <label class="form-check-label"
                            for="etat_enquete2">{{ __('messages.etat_enquete.non_realisee') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="etat_enquete" value="3"
                            id="etat_enquete3"
                            {{ !empty($assistance) && $assistance->etat_enquete === 3 ? 'checked' : '' }} required>
                        <label class="form-check-label"
                            for="etat_enquete3">{{ __('messages.etat_enquete.en_cours_realisation') }}</label>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <p class="text-center mb-4 fs-5 fw-bold p-2"
    style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
    {{ __('messages.services_sollicite') }}
</p>

    <div class="col-md-6 mb-5">
        <div class="mb-5">
            {{ Form::label('motif_service', __('messages.motif_title') . ':', ['class' => 'form-label required']) }}
            <span class="is-valid">
                <div class="mt-2">
                    @php
                        $motifs_service = [
                            '1' => 'Enfants Abandonnés',
                            '2' => 'Enfant Égaré',
                            '3' => 'Enfant Retrouves',
                            '4' => 'Enfant volé',
                            '5' => 'Enfant ayant fugué',
                            '6' => 'Enfants dit sorciers',
                            '7' => 'OEV en général',
                            '8' => 'O.E.V / VIH',
                            '9' => 'Enfant maltraité',
                            '10' => 'Enfant victime d\'abus sexuel',
                            '11' => 'Victimes de VEDAN (Violence, Exploitation, Discrimination, Abus et Négligence)',
                            '12' => 'Trafic d\'enfant',
                            '13' => 'Enfant non accompagné',
                            '14' => 'Enfant soldat',
                            '15' => 'Enfant handicapé',
                            '16' => 'Enfant séparé',
                            '17' => 'Enfant au travail',
                            '18' => 'Enfant de la rue',
                            '19' => 'Enfant dans la rue',
                            '20' => 'Cas Sociaux',
                            '21' => 'Prévention de la marginalisation chez les jeunes',
                            '22' => 'Insertion ou réinsertion des personnes défavorisées',
                            '23' => 'Enquêtes sociales',
                            '24' => 'Assistance aux enfants victimes de maltraitance et femmes battues',
                            '25' => 'Soutien à la scolarisation, à la formation professionnelle et à l\'insertion professionnelle',
                            '26' => 'Soutien psychosocial aux personnes vulnérables',
                            '27' => 'Prise en charge juridique des personnes vulnérables',
                            '28' => 'Autre à préciser',
                        ];
                    @endphp
                    @foreach ($motifs_service as $key => $motif)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="motif_service[]"
                                value="{{ $key }}" id="motif_service_{{ $key }}"
                                {{ in_array($key, $assistance->motif_service ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="motif_service_{{ $key }}">{{ $motif }}</label>
                        </div>
                    @endforeach
                    <div class="form-group mt-3" id="autre_preciser_field" style="display: none;">
                        {{ Form::label('autre_motif_service', __('messages.autre_preciser_label') . ':', ['class' => 'form-label']) }}
                        {{ Form::text('autre_motif_service', isset($assistance) ? $assistance->autre_motif_service : null, ['class' => 'form-control', 'placeholder' => __('messages.autre_preciser')]) }}
                    </div>
                </div>
            </span>
        </div>

    </div>

    <div class="col-md-6 mb-5">
        <div class="mb-5">
            {{ Form::label('activites_menees', __('messages.activite_mener.activite_mener_title') . ':', ['class' => 'form-label required']) }}
            <span class="is-valid">
                <div class="mt-2">
                    @php
                        $activites = [
                            '1' => 'Insertion ou réinsertion des personnes défavorisées dans le tissu social',
                            '2' => 'Soutien psychosocial aux personnes vulnérables',
                            '3' => 'Soutien juridique des personnes vulnérables',
                            '4' => 'Accompagnement pour la déclaration des naissances et l\'établissement d\'actes administratifs',
                            '5' => 'Secours scolaires',
                            '6' => 'Secours médical',
                            '7' => 'Secours financier',
                            '8' => 'Viol',
                            '9' => 'Agression physique',
                            '10' => 'Agression sexuelle',
                            '11' => 'Violence psychologique et Émotionnelle',
                            '12' => 'Déni de ressources, d\'opportunités ou de services',
                            '13' => 'Mariage forcé',
                            '14' => 'Prise en charge psychosociale des déplacés internes',
                            '15' => 'Suivi des enfants abandonnés',
                            '16' => 'Suivi des enfants égarés',
                            '17' => 'Suivi de cas de malades abandonnés',
                            '18' => 'Conseil VIH',
                            '19' => 'Soins palliatifs VIH',
                            '20' => 'Conseil Tuberculose',
                            '21' => 'PEC Tuberculose',
                            '22' => 'Autres à précisé',
                        ];
                    @endphp
                    @foreach ($activites as $key => $activite)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activites_menees[]"
                                value="{{ $key }}" id="activites_menees{{ $key }}"
                                {{ in_array($key, $assistance->activites_menees ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="activites_menees{{ $key }}">{{ $activite }}</label>
                        </div>
                    @endforeach
                    <div class="form-group mt-3" id="autres_activites_field" style="display: none;">
                        {{ Form::label('autres_activites', __('messages.activite_mener.22') . ':', ['class' => 'form-label']) }}
                        {{ Form::text('autres_activites', isset($assistance) ? $assistance->autres_activites : null, ['class' => 'form-control', 'placeholder' => __('messages.activite_mener.autres_label')]) }}
                    </div>

                </div>
            </span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-5 col-md-6">
            {{ Form::label('delai', __('messages.delais.delais_title') . ':', ['class' => 'form-label required']) }}
            <div class="input-group">
                {{ Form::number('delai', isset($assistance) ? $assistance->delai : null, ['class' => 'form-control', 'placeholder' => __('messages.delais.delais'), 'min' => 1, 'required']) }}
                <span class="input-group-text">{{ __('messages.delais.delais_libelle') }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-5">
            {{ Form::label('resultat_realisation', __('messages.resultat_realisation.resultat_realisation_title') . ':', ['class' => 'form-label required']) }}
            <div class="mt-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="resultat_realisation" value="1"
                        id="resultat_realisation_1"
                        {{ !empty($assistance) && $assistance->resultat_realisation === 1 ? 'checked' : '' }} required>
                    <label class="form-check-label"
                        for="resultat_realisation_1">{{ __('messages.resultat_realisation.realisee') }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="resultat_realisation" value="2"
                        id="resultat_realisation_2"
                        {{ !empty($assistance) && $assistance->resultat_realisation === 2 ? 'checked' : '' }} required>
                    <label class="form-check-label"
                        for="resultat_realisation_2">{{ __('messages.resultat_realisation.non_realisee') }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="resultat_realisation" value="3"
                        id="resultat_realisation_3"
                        {{ !empty($assistance) && $assistance->resultat_realisation === 3 ? 'checked' : '' }} required>
                    <label class="form-check-label"
                        for="resultat_realisation_3">{{ __('messages.resultat_realisation.en_cours_realisation') }}</label>
                </div>
            </div>
        </div>

    </div>

    <p class="text-center mb-4 fs-5 fw-bold p-2"
    style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
    {{ __('messages.devenir_du_cas.devenir_title') }}
</p>

    <div class="col-md-6 mb-5">
        <div class="mb-5">
            {{ Form::label('devenir_du_cas', __('messages.devenir_du_cas.devenir_title') . ':', ['class' => 'form-label required']) }}
            <span class="is-valid">
                <div class="mt-2">
                    @php
                        $devenir_du_cas_options = [
                            '1' => 'Réintégration en famille',
                            '2' => 'Placés en Institution après abandon',
                            '3' => 'Placés en famille après égarement',
                            '4' => 'Placés en Institution après égarement',
                            '5' => 'Placés en famille d\'orphelins',
                            '6' => 'Placés en Institution d\'orphelin',
                            '7' => 'Cas Sociaux insérés à l\'école',
                            '8' => 'OEV scolarisé',
                            '9' => 'OEV places en apprentissage',
                            '10' => 'OEV PEC sur le plan juridique',
                            '11' => 'OEV PEC sur plan nutritionnelle et Alimentaire',
                            '12' => 'OEV PEC médicale',
                            '13' => 'OEV PEC psychosocial',
                            '14' => 'Clôture du dossier',
                        ];
                    @endphp
                    @foreach ($devenir_du_cas_options as $key => $option)
                        <div class="form-check">
                            {{ Form::checkbox('devenir_du_cas[]', $key, in_array($key, $assistance->devenir_du_cas ?? []), ['class' => 'form-check-input', 'id' => 'devenir_du_cas' . $key]) }}
                            {{ Form::label('devenir_du_cas' . $key, $option, ['class' => 'form-check-label']) }}
                        </div>
                    @endforeach
                </div>
            </span>
        </div>

    </div>

    <div class="col-md-6">
        <div class="mb-5">
            {{ Form::label('observation', __('messages.observation_title') . ':', ['class' => 'form-label required']) }}
            <span class="is-valid">
                <div class="mt-2">
                    {{ Form::textarea('observation', isset($assistance) ? $assistance->observation : null, ['class' => 'form-control', 'rows' => 7, 'placeholder' => __('messages.observation_placeholder')]) }}
                </div>
            </span>
        </div>
    </div>

    <div class="d-flex">
        <button type="submit" class="btn btn-primary"
            id="btnSubmit">{{ __('messages.common.save') }}</button>&nbsp;&nbsp;&nbsp;
        <a href="{{ getLogInUser()->hasRole('assistant') ? route('assistants.assistances.index') : route('visits.index') }}"
            type="reset" class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
    </div>

</div>
