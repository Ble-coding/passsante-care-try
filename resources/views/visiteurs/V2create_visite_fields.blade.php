<div class="row">
    <p class="text-center mb-4 fs-5 fw-bold p-2"
        style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
        {{ __('messages.visitor.title_visit') }} </p>


    {{-- stocke un booléen indiquant si l'utilisateur connecté a le rôle de "doctor" --}}
    @role('assistant')
        {{ Form::hidden('assistantRole', getLogInUser()->hasRole('assistant'), ['id' => 'assistantRole']) }}
        {{ Form::hidden('assistant_id', getLogInUser()->assistant->id) }}
    @endrole



        <div class="col-sm-12 col-lg-6 mb-5">
            {{ Form::label('visiteur', __('messages.visitor.full_name') . ':', ['class' => 'form-label required']) }}
            {{ Form::select('visiteur_id', $data['visiteurs'], null, ['class' => 'io-select2 form-select', 'data-control' => 'select2', 'placeholder' => __('messages.visitor.full_name')]) }}
        </div>


    {{-- HORAIRES  --}}

    <div class="col-md-6 mb-5">
        {{ Form::label('heure_debut', __('messages.start') . ':', ['class' => 'form-label required']) }}
        {{ Form::time('heure_debut', isset($visite) ? $visite->heure_debut : null, ['class' => 'form-control']) }}
    </div>

    <div class="col-md-6 mb-5">
        {{ Form::label('heure_fin', __('messages.end') . ':', ['class' => 'form-label required']) }}
        {{ Form::time('heure_fin', isset($visite) ? $visite->heure_fin : null, ['class' => 'form-control']) }}
    </div>

    <p class="text-center mb-4 fs-5 fw-bold p-2"
        style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
        {{ __('messages.vulnerabilite') }}
    </p>

    {{-- Statut  --}}
    <div class="mb-5">
        {{ Form::label('statut', __('messages.status_title') . ':', ['class' => 'form-label required']) }}
        <span class="is-valid">
            <div class="mt-2">
                <input class="form-check-input" checked type="radio" name="statut" value="1" id="status_cas_1"
                    {{ !empty($visite) && $visite->statut === 1 ? 'checked' : '' }} required>
                <label class="form-label mr-3" for="status_cas_1">{{ __('messages.status_cas_1') }}</label>

                <input class="form-check-input ms-2" type="radio" name="statut" value="2" id="status_cas_2"
                    {{ !empty($visite) && $visite->statut === 2 ? 'checked' : '' }} required>
                <label class="form-label mr-3" for="status_cas_2">{{ __('messages.status_cas_2') }}</label>
            </div>
        </span>
    </div>

    {{-- VULNERABILITE --}}

    <div class="col-md-6 mb-5">
        {{-- <p class="mb-3 fs-5 fw-bold p-2 required">
            {{ __('messages.vulnerabilite_1') }}
        </p> --}}

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
                    {{ Form::checkbox('vulnerabilites[]', $key, in_array($key, $visite->vulnerabilites ?? []), ['class' => 'form-check-input mb-1', 'id' => 'vulnerabilites' . $key]) }}
                    {{ Form::label('vulnerabilites' . $key, $vulnerabilite, ['class' => 'form-check-label']) }}
                </div>
            @endforeach
        </div>
    </div>


    {{-- ENQUETE  --}}
    <p class="text-center mb-4 fs-5 fw-bold p-2"
        style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
        {{ __('messages.enquete') }}
    </p>

    {{-- type d'enquete  --}}
    <div class="mb-5">
        {{ Form::label('type', __('messages.type') . ':', ['class' => 'form-label required']) }}
        <span class="is-valid">
            <div class="mt-2">
                <input class="form-check-input" type="radio" name="type" value="1" id="type_1"
                    {{ !empty($visite) && $visite->type === 1 ? 'checked' : '' }} required>
                <label class="form-label mr-3" for="type_1">{{ __('messages.type_1') }}</label>

                <input class="form-check-input ms-2" type="radio" name="type" value="2" id="type_2"
                    {{ !empty($visite) && $visite->type === 2 ? 'checked' : '' }} required>
                <label class="form-label mr-3" for="type_2">{{ __('messages.type_2') }}</label>
            </div>
        </span>
    </div>


    {{-- motif  --}}
    <div class="col-md-6 mb-5">
        <div class="col-md-6">
            <div class="mb-5">
                {{ Form::label('motif', __('messages.motif') . ':', ['class' => 'form-label required']) }}
                <span class="is-valid">
                    <div class="mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="1" id="motif_1"
                                {{ !empty($visite) && $visite->motif === 1 ? 'checked' : '' }} required>
                            <label class="form-check-label mb-2" for="motif_1">{{ __('messages.motif_1') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="2" id="motif_2"
                                {{ !empty($visite) && $visite->motif === 2 ? 'checked' : '' }} required>
                            <label class="form-check-label mb-2" for="motif_2">{{ __('messages.motif_2') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="3" id="motif_3"
                                {{ !empty($visite) && $visite->motif === 3 ? 'checked' : '' }} required>
                            <label class="form-check-label mb-2" for="motif_3">{{ __('messages.motif_3') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="4" id="motif_4"
                                {{ !empty($visite) && $visite->motif === 4 ? 'checked' : '' }} required>
                            <label class="form-check-label mb-2" for="motif_4">{{ __('messages.motif_4') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="5" id="motif_5"
                                {{ !empty($visite) && $visite->motif === 5 ? 'checked' : '' }} required>
                            <label class="form-check-label mb-2" for="motif_5">{{ __('messages.motif_5') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="6" id="motif_6"
                                {{ !empty($visite) && $visite->motif === 6 ? 'checked' : '' }} required>
                            <label class="form-check-label mb-2" for="motif_6">{{ __('messages.motif_6') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="motif" value="7"
                                id="motif_7" {{ !empty($visite) && $visite->motif === 7 ? 'checked' : '' }}
                                required>
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
            {{ Form::label('decision', __('messages.decision') . ':', ['class' => 'form-label required']) }}
            <span class="is-valid">
                <div class="mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="decision" value="1"
                            id="decision_1" {{ !empty($visite) && $visite->decision === 1 ? 'checked' : '' }}
                            required>
                        <label class="form-check-label mb-2" for="decision_1">{{ __('messages.decision_1') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="decision" value="2"
                            id="decision_2" {{ !empty($visite) && $visite->decision === 2 ? 'checked' : '' }}
                            required>
                        <label class="form-check-label mb-2" for="decision_2">{{ __('messages.decision_2') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="decision" value="3"
                            id="decision_3" {{ !empty($visite) && $visite->decision === 3 ? 'checked' : '' }}
                            required>
                        <label class="form-check-label" for="decision_3">{{ __('messages.decision_3') }}</label>
                    </div>
                </div>
            </span>
        </div>

        {{-- etat de l'enquete  --}}
        <div class="col-md-6">
            <div class="mb-5">
                {{ Form::label('resultat_realisation', __('messages.resultat_realisation.resultat_realisation_title') . ':', ['class' => 'form-label required']) }}
                <div class="mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="resultat_realisation" value="1"
                            id="resultat_realisation_1"
                            {{ !empty($visite) && $visite->resultat_realisation === 1 ? 'checked' : '' }} required>
                        <label class="form-check-label"
                            for="resultat_realisation_1">{{ __('messages.resultat_realisation.realisee') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="resultat_realisation" value="2"
                            id="resultat_realisation_2"
                            {{ !empty($visite) && $visite->resultat_realisation === 2 ? 'checked' : '' }} required>
                        <label class="form-check-label"
                            for="resultat_realisation_2">{{ __('messages.resultat_realisation.non_realisee') }}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="resultat_realisation" value="3"
                            id="resultat_realisation_3"
                            {{ !empty($visite) && $visite->resultat_realisation === 3 ? 'checked' : '' }} required>
                        <label class="form-check-label"
                            for="resultat_realisation_3">{{ __('messages.resultat_realisation.en_cours_realisation') }}</label>
                    </div>
                </div>
            </div>

        </div>
    </div>






    {{-- SERVICE SOLLICITES  --}}
    <p class="text-center mb-4 fs-5 fw-bold p-2"
        style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
        {{ __('messages.services_sollicite') }}
    </p>

    {{-- motifs du service --}}
    <div class="col-md-6 mb-5">
        {{-- <p class="mb-3 fs-5 fw-bold p-2 required">
            {{ __('messages.motif_title') }}
        </p> --}}

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
                                {{ in_array($key, $visite->motif_service ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="motif_service_{{ $key }}">{{ $motif }}</label>
                        </div>
                    @endforeach
                    <div class="form-group mt-3" id="autre_preciser_field" style="display: none;">
                        {{ Form::label('autre_motif_service', __('messages.autre_preciser_label') . ':', ['class' => 'form-label']) }}
                        {{ Form::text('autre_motif_service', isset($visite) ? $visite->autre_motif_service : null, ['class' => 'form-control', 'placeholder' => __('messages.autre_preciser')]) }}
                    </div>
                </div>
            </span>
        </div>

    </div>


    {{-- Actions menées --}}
    <div class="col-md-6 mb-5">
        {{-- <p class="mb-3 fs-5 fw-bold p-2 required">
            {{ __('messages.action_0') }}
        </p> --}}
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
                                {{ in_array($key, $visite->activites_menees ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="activites_menees{{ $key }}">{{ $activite }}</label>
                        </div>
                    @endforeach
                    {{-- autre activité --}}
                    <div class="form-group mt-3" id="autres_activites_field" style="display: none;">
                        {{ Form::label('autres_activites', __('messages.activite_mener.22') . ':', ['class' => 'form-label']) }}
                        {{ Form::text('autres_activites', isset($visite) ? $visite->autres_activites : null, ['class' => 'form-control', 'placeholder' => __('messages.activite_mener.autres_label')]) }}
                    </div>

                </div>
            </span>
        </div>
    </div>


    {{-- delais de realisation  --}}
    <div class="col-md-6">
        <div class="mb-5 col-md-6">
            {{ Form::label('delai', __('messages.delais.delais_title') . ':', ['class' => 'form-label required']) }}
            <div class="input-group">
                {{ Form::number('delai', isset($visite) ? $visite->delai : null, ['class' => 'form-control', 'placeholder' => __('messages.delais.delais'), 'min' => 1, 'required']) }}
                <span class="input-group-text">{{ __('messages.delais.delais_libelle') }}</span>
            </div>
        </div>
    </div>




    {{-- resultat de realisation  --}}
    <div class="col-md-6">
        <div class="mb-5">
            {{ Form::label('resultat_realisation', __('messages.resultat_realisation.resultat_realisation_title') . ':', ['class' => 'form-label required']) }}
            <div class="mt-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="resultat_realisation" value="1"
                        id="resultat_realisation_1"
                        {{ !empty($visite) && $visite->resultat_realisation === 1 ? 'checked' : '' }} required>
                    <label class="form-check-label"
                        for="resultat_realisation_1">{{ __('messages.resultat_realisation.realisee') }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="resultat_realisation" value="2"
                        id="resultat_realisation_2"
                        {{ !empty($visite) && $visite->resultat_realisation === 2 ? 'checked' : '' }} required>
                    <label class="form-check-label"
                        for="resultat_realisation_2">{{ __('messages.resultat_realisation.non_realisee') }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="resultat_realisation" value="3"
                        id="resultat_realisation_3"
                        {{ !empty($visite) && $visite->resultat_realisation === 3 ? 'checked' : '' }} required>
                    <label class="form-check-label"
                        for="resultat_realisation_3">{{ __('messages.resultat_realisation.en_cours_realisation') }}</label>
                </div>
            </div>
        </div>

    </div>



    {{-- Devenir de cas  --}}

    <p class="text-center mb-4 fs-5 fw-bold p-2"
        style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
        {{ __('messages.devenir_du_cas.devenir_title') }}
    </p>
    <div class="col-md-6 mb-5">
        {{-- <p class="mb-3 fs-5 fw-bold p-2 required">
            {{ __('messages.devenir_title') }}
        </p> --}}
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
                            {{ Form::checkbox('devenir_du_cas[]', $key, in_array($key, $visite->devenir_du_cas ?? []), ['class' => 'form-check-input', 'id' => 'devenir_du_cas' . $key]) }}
                            {{ Form::label('devenir_du_cas' . $key, $option, ['class' => 'form-check-label']) }}
                        </div>
                    @endforeach
                </div>
            </span>
        </div>

    </div>
</div>

{{-- obersation  --}}
<p class="text-center mb-4 fs-5 fw-bold p-2"
    style="background-color: #e1e0ff; color: #282828; text-transform:uppercase; ">
    {{ __('messages.observation_title') }}
</p>

<div class="col-md-6">
    <div class="mb-5">
        {{ Form::label('observation', __('messages.observation_title') . ':', ['class' => 'form-label required']) }}
        <span class="is-valid">
            <div class="mt-2">
                {{ Form::textarea('observation', isset($visite) ? $visite->observation : null, ['class' => 'form-control', 'rows' => 7, 'placeholder' => __('messages.observation_placeholder')]) }}
            </div>
        </span>
    </div>
</div>



<div class="d-flex">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
    <a href="{{ route('assistants.visiteurs.index') }}" type="reset"
        class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
</div>



<script>
    // Fonction pour afficher ou masquer le champ de texte en fonction de la sélection de l'utilisateur
    document.addEventListener('DOMContentLoaded', function() {
        const autrePreciserField = document.getElementById('autre_preciser_field');
        const autrePreciserCheckbox = document.getElementById('motif_service_28');

        autrePreciserCheckbox.addEventListener('change', function() {
            autrePreciserField.style.display = autrePreciserCheckbox.checked ? 'block' : 'none';
        });

        // Assurer que le champ de texte est initialisé correctement lors de l'ouverture de la page
        autrePreciserField.style.display = autrePreciserCheckbox.checked ? 'block' : 'none';

        // Fonction pour afficher ou masquer le champ de texte en fonction de la sélection de l'utilisateur

        const autresActivitesField = document.getElementById('autres_activites_field');
        const autresActivitesCheckbox = document.getElementById('activites_menees_22');

        autresActivitesCheckbox.addEventListener('change', function() {
            autresActivitesField.style.display = autresActivitesCheckbox.checked ? 'block' : 'none';
        });

        // Assurer que le champ de texte est initialisé correctement lors de l'ouverture de la page
        autresActivitesField.style.display = autresActivitesCheckbox.checked ? 'block' : 'none';
    });
</script>
