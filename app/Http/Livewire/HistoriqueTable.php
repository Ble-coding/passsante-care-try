<?php

namespace App\Http\Livewire;

use App\Models\Historique;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class HistoriqueTable extends LivewireTableComponent
{
    protected $model = Historique::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'visits.components.add_button';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc')
            ->setQueryStringStatus(false);

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'text-center',
                ];
            }

            return [];
        });
    }

    public function builder(): Builder
    {
        return Historique::with(['assistant.user'])->select('data_visiteurs.*');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.visit.doctor'), 'assistant.user.first_name')
            // ->view('visits.components.doctor')
                ->sortable()->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('assistant.user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),

            // Column::make(__('messages.visit.doctor'), 'doctor.doctorUser.email')
            //     ->hideIf('doctor.doctorUser.email')
            //     ->searchable(),
            // Column::make(__('messages.visit.patient'), 'patient.patientUser.first_name')
            //     ->view('visits.components.patient')
            //     ->sortable(function (Builder $query, $direction) {
            //         return $query->orderBy(User::select('first_name')->whereColumn('id', 'patients.user_id'), $direction);
            //     })
            //     ->searchable(),
            // Column::make(__('messages.visit.patient'), 'patient.patientUser.last_name')
            //     ->hideIf('patient.patientUser.last_name')
            //     ->searchable(),
            // Column::make(__('messages.visit.patient'), 'patient.patientUser.email')
            //     ->hideIf('patient.patientUser.email')
            //     ->searchable(),
            // Column::make(__('messages.visit.visit_date'), 'visit_date')->view('visits.components.visit_date')
            //     ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('visits.components.action'),
        ];
    }
}








// profil du visiteur 
            //     Column::make(__('messages.visitor.visitor'), 'assistant.visiteurs.nom')
            //     ->view('appointments.components.patient_name')
            //     ->sortable(function (Builder $query, $direction) {
            //         return $query->orderBy(Visiteur::select('nom')->whereColumn('id', 'visiteurs.prenom'), $direction);
            //     })
            //     ->searchable(),

            // Column::make(__('messages.visitor.visitor'), 'assistant.visiteurs.prenom')
            //     ->hideIf('assistant.visiteurs.prennom')
            //     ->searchable(),


            

            // Column::make(__('Assistant'), 'assistant.user.first_name')
            // ->sortable()
            // ->searchable(),

            // Column::make(__('messages.assistants'), 'assistant.user.first_name')
            //     ->view('visiteurs.visites.assistant_name')
            //     ->sortable()
            //     ->searchable(
            //         function (Builder $query, $direction) {
            //             return $query->whereHas('assistant.user', function (Builder $q) use ($direction) {
            //                 $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
            //             });
            //         }
            //     ),












             // return [



        //     Column::make(__('Visiteur'), 'assistant_id')
        //         ->sortable()
        //         ->searchable(function (Builder $query, $search) {
        //             $query->whereHas('visiteur', function (Builder $q) use ($search) {
        //                 $q->where('nom', 'like', '%' . $search . '%')
        //                     ->orWhere('prenom', 'like', '%' . $search . '%');
        //             });
        //         }),

        //         Column::make(__('messages.visit.doctor'), 'assistant.assistantUser.first_name')
        //         ->view('appointments.components.doctor_name')
        //         ->sortable()
        //         ->searchable(
        //             function (Builder $query, $direction) {
        //                 return $query->whereHas('assistant.assistantUser', function (Builder $q) use ($direction) {
        //                     $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
        //                 });
        //             }
        //         ), 

        //     Column::make(__('Visiteur'), 'visiteur_id')
        //         ->sortable()
        //         ->searchable(function (Builder $query, $search) {
        //             $query->whereHas('visiteur', function (Builder $q) use ($search) {
        //                 $q->where('nom', 'like', '%' . $search . '%')
        //                     ->orWhere('prenom', 'like', '%' . $search . '%');
        //             });
        //         }),

        //     Column::make(__('Heure de début'), 'heure_debut')->sortable(),
        //     Column::make(__('Heure de fin'), 'heure_fin')->sortable(),
        //     Column::make(__('DATE'), 'created_at')->sortable(),

        //     Column::make(__('messages.common.action'), 'id')->view('visiteurs.visites.action'),

        // ];