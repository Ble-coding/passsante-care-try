<?php

namespace App\Http\Livewire;

use App\Models\PortezAssistance;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AssistantPortezAssistanceTable extends LivewireTableComponent
{
    protected $model = PortezAssistance::class;
 
    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'portez_assistance.assistant_panel.components.add_button';

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








  

    /**
     *df
     */
    public function columns(): array
    {
        return [
            Column::make(__('messages.portez_assistance.patient'), 'patient.user.first_name')->view('portez_assistance.assistant_panel.components.patient')
                ->sortable()->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('patient.user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    } 
                ),
            Column::make(__('messages.portez_assistance.assistant'), 'patient.user.email')
                ->hideIf('patient.user.email')
                ->searchable(),
                
            Column::make(__('messages.portez_assistance.assistance_date'), 'assistance_date')->view('portez_assistance.assistant_panel.components.assisance_date')
                ->sortable(),

            Column::make(__('messages.common.action'), 'id')->view('portez_assistance.assistant_panel.components.action'),
        ];
    }



    public function builder(): Builder
    {
        return PortezAssistance::with(['patient.user', 'assistant.reviews_assistants'])->where('assistant_id', getLoginUser()->assistant->id)
            ->select('portez_assistances.*');
    }
    
}
