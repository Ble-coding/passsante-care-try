<?php

namespace App\Http\Livewire;

use App\Models\Assistance;
use App\Models\PortezAssistance;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PatientAssistanceTable extends LivewireTableComponent
{
    protected $model = PortezAssistance::class;

    protected $listeners = ['resetPage'];

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

    public function columns(): array
    {
        return [
            Column::make(__('messages.assistance.assistant'), 'assistant.user.first_name')->view('patient_assistances.components.assistant')
                ->sortable()->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('assistant.user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),

            Column::make(__('messages.assistance.assistant'), 'assistant.user.email')
                ->hideIf('assistant.user.email')
                ->searchable(),

            Column::make(__('messages.assistance.assistance_date'), 'assistance_date')->view('patient_assistances.components.assistance')
                ->sortable(),

            Column::make(__('messages.common.action'), 'id')->view('patient_assistances.components.action'),
        ];
    }

    public function builder(): Builder
    {
        return PortezAssistance::with('assistanceAssistant.user', 'assistanceAssistant.reviews_assistants')->where('patient_id', getLoginUser()->patient->id)
            ->select('portez_assistances.*');

        // return PortezAssistance::with('visitDoctor.user', 'visitDoctor.reviews')->where('patient_id', getLoginUser()->patient->id)
        //     ->select('visits.*');
    }
}
