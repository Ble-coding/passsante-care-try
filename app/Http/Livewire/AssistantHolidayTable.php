<?php

namespace App\Http\Livewire;

use App\Models\AssistantHoliday;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AssistantHolidayTable extends LivewireTableComponent
{
    protected $model = AssistantHoliday::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'assistant_holiday.components.add_button';

    public bool $showFilterOnHeader = true;

    public array $FilterComponent = ['assistant_holiday.components.filter', []];

    protected $listeners = ['refresh' => '$refresh', 'resetPage', 'changeDateFilter'];

    public string $dateFilter = '';

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    /**
     * @var string[]
     */
    public function changeDateFilter($date)
    {
        $this->dateFilter = $date;
        $this->setBuilder($this->builder());
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.portez_assistance.assistant'), 'assistant.assistantUser.first_name')
                ->view('assistant_holiday.components.assistant')
                ->sortable()
                ->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('assistant.assistantUser', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),
            Column::make(__('messages.visit.assistant'), 'assistant.assistantUser.email')
                ->hideIf('assistant.assistantUser.email')
                ->searchable(),
            Column::make(__('messages.web.reason'), 'name')->view('assistant_holiday.components.reason')
                ->sortable(),
            Column::make(__('messages.holiday.holiday_date'), 'date')->view('assistant_holiday.components.holiday_date')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('assistant_holiday.components.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = AssistantHoliday::with('assistant')->select('assistant_holidays.*');
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
