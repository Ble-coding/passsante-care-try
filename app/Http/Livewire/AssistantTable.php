<?php

namespace App\Http\Livewire;

use App\Models\Assistant;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AssistantTable extends LivewireTableComponent
{
    protected $model = Assistant::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'assistants.components.add_button';

    public bool $showFilterOnHeader = true;

    public array $FilterComponent = ['assistants.components.status_filter', User::STATUS];

    protected $listeners = ['refresh' => '$refresh', 'resetPage', 'changeStatusFilter'];

    public string $statusFilter = '';

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
        $query = Assistant::with(['user', 'occupations', 'reviews_assistants'])->select('assistants.*');

        $query->when($this->statusFilter != '' && $this->statusFilter != User::ALL,
            function (Builder $query) {
                return $query->whereHas('user', function (Builder $q) {
                    $q->where('status', $this->statusFilter);
                });
            });

        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.assistant.assistant'), 'user.first_name')->view('assistants.components.assistant_name')
                ->sortable()
                ->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),
            Column::make(__('messages.portez_assistance.assistance'), 'user.email')
                ->hideIf('user.email')
                ->searchable(),

            Column::make(__('messages.doctor.status'), 'user.status')->view('assistants.components.status')->sortable(),

            Column::make(__('messages.common.email_verified'), 'user.email_verified_at')->view('assistants.components.email_verified')
                ->sortable(),

            Column::make(__('messages.common.impersonate'), 'user.status')->view('assistants.components.impersonate'),

            Column::make(__('messages.patient.registered_on'), 'created_at')->view('assistants.components.registered_on')->sortable(),
            
            Column::make(__('messages.common.action'), 'id')->view('assistants.components.action'),
        ];
    }

    public function changeStatusFilter($value): void
    {
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
    }
}
