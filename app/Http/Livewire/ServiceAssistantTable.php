<?php

namespace App\Http\Livewire;

use App\Models\ServiceAssistant;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ServiceAssistantTable extends LivewireTableComponent
{
    protected $model = ServiceAssistant::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'services_assistants.components.add_button';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

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
            if (in_array($column->getField(), ['charges', 'status'], true)) {
                return [
                    'class' => 'text-end',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.front_service.icon'), 'category_id')->view('services_assistants.components.icon'),
            Column::make(__('messages.common.name'), 'name')->view('services_assistants.components.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.service.category'), 'serviceCategory.name')->view('services_assistants.components.category')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.appointment.service_charge'), 'charges')->view('services_assistants.components.service_charge')
                ->sortable()->searchable(),
            Column::make(__('messages.assistant.status'), 'status')->view('services_assistants.components.status')->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('services_assistants.components.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = ServiceAssistant::with(['serviceCategory', 'media'])->select('services.*');

        $query->when($this->statusFilter !== '' && $this->statusFilter != ServiceAssistant::ALL,
            function (Builder $query) {
                $query->where('status', $this->statusFilter);
            });

        return $query;
    }
}
