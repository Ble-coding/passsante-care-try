<?php

namespace App\Http\Livewire;

use App\Models\Occupation;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OccupationTable extends LivewireTableComponent
{
    protected $model = Occupation::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'occupations.components.add_button';

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

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'name')->view('occupations.components.name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('occupations.components.action'),
        ];
    }

    public function builder(): Builder
    {
        return Occupation::query();
    }
}
