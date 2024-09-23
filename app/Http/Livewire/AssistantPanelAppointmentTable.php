<?php

namespace App\Http\Livewire;

use App\Models\AppointmentAssistant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AssistantPanelAppointmentTable extends LivewireTableComponent
{
    protected $model = AppointmentAssistant::class;

    public bool $showFilterOnHeader = true;

    public bool $showButtonOnHeader = true;

    public array $FilterComponent = [
        'assistant_appointment.assistant_panel.components.filter', AppointmentAssistant::PAYMENT_TYPE_ALL, AppointmentAssistant::STATUS,
    ];

    protected $listeners = [
        'refresh' => '$refresh', 'changeStatusFilter', 'changePaymentTypeFilter', 'changeDateFilter', 'resetPage',
    ];

    public string $buttonComponent = 'assistant_appointment.assistant_panel.components.add_button';

    public string $paymentTypeFilter = '';

    public string $paymentStatusFilter = '';

    public string $dateFilter = '';

    public int $statusFilter = AppointmentAssistant::BOOKED;

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
        $query = AppointmentAssistant::with(['patient.user', 'services', 'transaction'])->where('assistant_id',
            getLoginUser()->assistant->id)->select('appointment_assistants.*');

        $query->when($this->statusFilter != '' && $this->statusFilter != AppointmentAssistant::ALL_STATUS,
            function (Builder $q) {
                if ($this->statusFilter != AppointmentAssistant::ALL) {
                    $q->where('appointment_assistants.status', '=', $this->statusFilter);
                }
            });

        $query->when($this->paymentTypeFilter != '' && $this->paymentTypeFilter != AppointmentAssistant::ALL_PAYMENT,
            function (Builder $q) {
                $q->where('appointment_assistants.payment_type', '=', $this->paymentTypeFilter);
            });

        if ($this->dateFilter != '' && $this->dateFilter != getWeekDate()) {
            $timeEntryDate = explode(' - ', $this->dateFilter);
            $startDate = Carbon::parse($timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::parse($timeEntryDate[1])->format('Y-m-d');
            $query->whereBetween('appointment_assistants.date', [$startDate, $endDate]);
        } else {
            $timeEntryDate = explode(' - ', getWeekDate());
            $startDate = Carbon::parse($timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::parse($timeEntryDate[1])->format('Y-m-d');
            $query->whereBetween('appointment_assistants.date', [$startDate, $endDate]);
        }

        return $query;
    }

    public function changeStatusFilter($status)
    {
        $this->statusFilter = $status;
        $this->setBuilder($this->builder());
    }

    public function changePaymentTypeFilter($type)
    {
        $this->paymentTypeFilter = $type;
        $this->setBuilder($this->builder());
    }

    public function changeDateFilter($date)
    {
        $this->dateFilter = $date;
        $this->setBuilder($this->builder());
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.appointment.patient'),
                'patient.user.first_name')->view('assistant_appointment.assistant_panel.components.patient')
                ->sortable()
                ->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('patient.user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),
            Column::make(__('messages.patient.name'), 'patient.user.email')
                ->hideIf('patient.user.email')
                ->searchable(),
            Column::make(__('messages.appointment.appointment_at'),
                'date')->view('assistant_appointment.assistant_panel.components.appointment_at')
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.service_charge'),
                'services.charges')->view('assistant_appointment.assistant_panel.components.service_charge')
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.payment'), 'id')
                ->format(function ($value, $row) {
                    return view('assistant_appointment.assistant_panel.components.payment')
                        ->with([
                            'row' => $row,
                            'paid' => AppointmentAssistant::PAID,
                            'pending' => AppointmentAssistant::PENDING,
                        ]);
                }),
            Column::make(__('messages.appointment.status'), 'id')
                ->format(function ($value, $row) {
                    return view('assistant_appointment.assistant_panel.components.status')
                        ->with([
                            'row' => $row,
                            'book' => AppointmentAssistant::BOOKED,
                            'checkIn' => AppointmentAssistant::CHECK_IN,
                            'checkOut' => AppointmentAssistant::CHECK_OUT,
                            'cancel' => AppointmentAssistant::CANCELLED,
                        ]);
                }),
            Column::make(__('messages.common.action'), 'id')->view('assistant_appointment.assistant_panel.components.action'),
        ];
    }
}
