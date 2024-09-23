<?php

namespace App\Http\Livewire;

use App\Models\Assistant;
use App\Models\AssistantHoliday;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class HolidayAssistantTable extends LivewireTableComponent
{
    protected $model = AssistantHoliday::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'holiday_assistant.add_button'; 

    public bool $showFilterOnHeader = true;

    public array $FilterComponent = ['holiday_assistant.components.filter', []];

    protected $listeners = ['refresh' => '$refresh', 'resetPage', 'changeDateFilter'];

    public string $dateFilter = '';

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc')
            ->setQueryStringStatus(false);

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('name')) {
                return [
                    'class' => 'w-75',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.web.reason'), 'name')->view('holiday_assistant.components.reason')
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.date'), 'date')->view('holiday_assistant.components.date')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('holiday_assistant.components.action'),
        ];
    }

    public function changeDateFilter($date)
    {
        $this->dateFilter = $date;
        $this->setBuilder($this->builder());
    }

    public function builder(): Builder
    {
        $assistant = Assistant::whereUserId(getLogInUserId())->first('id');
        $assistantId = $assistant['id'];
        $query = AssistantHoliday::whereAssistantId($assistantId);

        if ($this->dateFilter != '' && $this->dateFilter != getWeekDate()) {
            $timeEntryDate = explode(' - ', $this->dateFilter);
            $startDate = Carbon::parse($timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::parse($timeEntryDate[1])->format('Y-m-d');
            $query->whereBetween('date', [$startDate, $endDate]);
        } else {
            $timeEntryDate = explode(' - ', getWeekDate());
            $startDate = Carbon::parse($timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::parse($timeEntryDate[1])->format('Y-m-d');
            $query->whereBetween('date', [$startDate, $endDate]);
        }

        return $query;
    }
}
