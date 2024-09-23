<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Patient;
use App\Models\AppointmentAssistant;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AppointmentAssistantTable extends LivewireTableComponent
{
    protected $model = AppointmentAssistant::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'appointments_assistants.components.add_button';

    public bool $showFilterOnHeader = true;

    public array $FilterComponent = ['appointments_assistants.components.filter', AppointmentAssistant::PAYMENT_TYPE_ALL, AppointmentAssistant::STATUS];

    protected $listeners = [
        'refresh' => '$refresh', 'resetPage', 'changeStatusFilter', 'changePaymentTypeFilter', 'changeDateFilter',  'changePaymentStatusFilter',
    ];

    public string $paymentTypeFilter = '';

    public string $paymentStatusFilter = '';

    public string $dateFilter = '';

    public $statusFilter = AppointmentAssistant::BOOKED;

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
            'assistant.user', 'patient.user', 'services', 'transaction', 'assistant.reviews_assistants', 'assistant.user.media',
        ]);

        $query->when($this->statusFilter != '' && $this->statusFilter != AppointmentAssistant::ALL_STATUS,
            function (Builder $q) {
                if ($this->statusFilter != AppointmentAssistant::ALL) {
                    $q->where('appointment_assistants.status', '=', $this->statusFilter);
                }
            });

        $query->when($this->paymentTypeFilter != '' && $this->paymentTypeFilter != AppointmentAssistant::ALL_PAYMENT,
            function (Builder $q) {
                $q->where('payment_type', '=', $this->paymentTypeFilter);
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
            $query->whereBetween('date', [$startDate, $endDate]);
        } else {
            $timeEntryDate = explode(' - ', getWeekDate());
            $startDate = Carbon::parse($timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::parse($timeEntryDate[1])->format('Y-m-d');
            $query->whereBetween('date', [$startDate, $endDate]);
        }

        if (getLoginUser()->hasRole('patient')) {
            $query->where('patient_id', getLoginUser()->patient->id);
        }

        return $query->select('appointment_assistants.*');
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

    public function changePaymentStatusFilter($type)
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

            Column::make(__('messages.portez_assistance.assistant'), 'assistant.assistantUser.first_name')
                ->view('appointments_assistants.components.assistant_name')
                ->sortable()
                ->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('assistant.assistantUser', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ), 

            Column::make(__('messages.appointment.patient'), 'patient.patientUser.first_name')
                ->view('appointments_assistants.components.patient_name')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(User::select('first_name')->whereColumn('id', 'patients.user_id'), $direction);
                })
                ->searchable(),

            Column::make(__('messages.appointment.patient'), 'patient.patientUser.last_name')
                ->hideIf('patient.patientUser.last_name')
                ->searchable(),

            Column::make(__('messages.appointment.patient'), 'patient.patientUser.email')
                ->hideIf('patient.patientUser.email')
                ->searchable(),

            Column::make(__('messages.appointment.appointment_at'),
                'date')->view('appointments_assistants.components.appointment_at')
                ->sortable()->searchable(),
                
            Column::make(__('messages.common.action'), 'id')->view('appointments_assistants.components.action'),
        ];
    }
}
