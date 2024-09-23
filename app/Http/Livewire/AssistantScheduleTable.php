<?php

namespace App\Http\Livewire;

use App\Models\AssistantSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AssistantScheduleTable extends LivewireTableComponent
{
    protected $model = AssistantSession::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'assistants_sessions.components.add_button';

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
            Column::make(__('messages.assistant.assistant'),
                'assistant.user.first_name')->view('assistants_sessions.components.assistant_name')
                ->sortable(
                    //                    function (Builder $query, $direction) {
                    //                        return $query->whereHas('assistant.user', function (Builder $q) use ($direction) {
                    //                            $q->orderBy(User::select('first_name')->whereColumn('users.id', 'user_id'), $direction);
                    //                        });
                    //                    }
                )->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('assistant.user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),
            Column::make(__('messages.assistant_session.session_meeting_time'),
                'session_meeting_time')->view('assistants_sessions.components.schedule_meeting_time')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('assistants_sessions.components.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = AssistantSession::with(['assistant.user', 'assistant.reviews_assistants'])->select('assistant_sessions.*');

        if (getLoginUser()->hasRole('assistant')) {
            $query->where('assistant_id', getLoginUser()->assistant->id);
        }

        return $query;
    }
}
