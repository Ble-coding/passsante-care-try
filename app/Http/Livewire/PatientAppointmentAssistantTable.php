<?php

namespace App\Http\Livewire;

use App\Models\AppointmentAssistant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PatientAppointmentAssistantTable extends LivewireTableComponent
{
    public $assistantId;

    protected $model = AppointmentAssistant::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'patients.appointments_assistants.add_button';

    public bool $showFilterOnHeader = true;

    public array $FilterComponent = [
        'patients.appointments_assistants.components.filter', AppointmentAssistant::PAYMENT_TYPE_ALL, AppointmentAssistant::STATUS,
    ];

    protected $listeners = [
        'refresh' => '$refresh', 'resetPage', 'changeStatusFilter', 'changeDateFilter', 'changePaymentTypeFilter',
        'changePaymentStatusFilter',
    ];

    public int $statusFilter = AppointmentAssistant::BOOKED;

    public string $paymentTypeFilter = '';

    public string $paymentStatusFilter = '';

    public string $dateFilter = '';

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
        $query = AppointmentAssistant::with([
            'assistant.user', 'services', 'transaction', 'assistant.reviews_assistants',
        ])->where('patient_id', getLoginUser()->patient->id)->select('appointment_assistants.*');

        $query->when($this->statusFilter != '' && $this->statusFilter != AppointmentAssistant::ALL_STATUS,
            function (Builder $q) {
                if ($this->statusFilter != AppointmentAssistant::ALL) {
                    $q->where('appointment_assistants.status', '=', $this->statusFilter);
                }
            });

        $query->when($this->paymentTypeFilter != '' && $this->paymentTypeFilter != AppointmentAssistant::ALL_PAYMENT,
            function (Builder $q) {
                $q->where('appointments.payment_type', '=', $this->paymentTypeFilter);
            });

        $query->when($this->paymentStatusFilter != '',
            function (Builder $q) {
                if ($this->paymentStatusFilter != AppointmentAssistant::ALL_PAYMENT) {
                    if ($this->paymentStatusFilter == AppointmentAssistant::PENDING) {
                        $q->has('transaction', '=', null);
                    } elseif ($this->paymentStatusFilter == AppointmentAssistant::PAID) {
                        $q->has('transaction', '!=', null);
                    }
                }
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
            Column::make(__('messages.assistant.assistant'),
                'assistant.user.first_name')->view('patients.appointments_assistants.components.assistant')
                ->sortable()
                ->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('assistant.user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),
            Column::make(__('messages.patient.name'), 'assistant.user.email')
                ->hideIf('assistant.user.email')
                ->searchable(),
            Column::make(__('messages.appointment.appointment_at'),
                'date')->view('patients.appointments_assistants.components.appointment_at')
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.service_charge'),
                'services.charges')->view('patients.appointments_assistants.components.service_charge')
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.payment'), 'payment_type')
                ->format(function ($value, $row) {
                    return view('patients.appointments_assistants.components.payment')
                        ->with([
                            'row' => $row,
                            'paid' => AppointmentAssistant::PAID,
                            'pending' => AppointmentAssistant::PENDING,
                        ]);
                }),
            Column::make(__('messages.appointment.status'), 'status')->view('patients.appointments_assistants.components.status'),
            Column::make(__('messages.common.action'), 'id')
                ->format(function ($value, $row) {
                    return view('patients.appointments_assistants.components.action')
                        ->with([
                            'row' => $row,
                            'checkOut' => AppointmentAssistant::CHECK_OUT,
                            'cancel' => AppointmentAssistant::CANCELLED,
                        ]);
                }),
        ];
    }
}
