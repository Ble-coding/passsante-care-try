<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\PortezAssistance;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PortezAssistanceTable extends LivewireTableComponent
{

    
    protected $model = PortezAssistance::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'portez_assistance.components.add_button';

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
        return PortezAssistance::with(['assistant.user', 'patient.user'])->select('portez_assistances.*');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.portez_assistance.assistant'), 'assistant.user.first_name')->view('portez_assistance.components.assistant')
                ->sortable()->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('assistant.user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),

            Column::make(__('messages.portez_assistance.assistant'), 'assistant.assistantUser.email')
                ->hideIf('assistant.assistantUser.email')
                ->searchable(),

            Column::make(__('messages.portez_assistance.patient'), 'patient.patientUser.first_name')
                ->view('portez_assistance.components.patient')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(User::select('first_name')->whereColumn('id', 'patients.user_id'), $direction);
                })
                ->searchable(),

            Column::make(__('messages.portez_assistance.patient'), 'patient.patientUser.last_name')
                ->hideIf('patient.patientUser.last_name')
                ->searchable(),

            Column::make(__('messages.portez_assistance.patient'), 'patient.patientUser.email')
                ->hideIf('patient.patientUser.email')
                ->searchable(),

            Column::make(__('messages.portez_assistance.assistance_date'), 'assistance_date')->view('portez_assistance.components.assistance_date')
                ->sortable(),

            Column::make(__('messages.common.action'), 'id')->view('portez_assistance.components.action'),
        ];
    }
}
