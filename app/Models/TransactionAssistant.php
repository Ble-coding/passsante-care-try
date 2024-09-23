<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\TransactionAssistant
 *
 * @property int $id
 * @property int $user_id
 * @property string $transaction_id
 * @property string $appointment_id
 * @property float $amount
 * @property int $type
 * @property string $meta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 *
 * @method static Builder|TransactionAssistant newModelQuery()
 * @method static Builder|TransactionAssistant newQuery()
 * @method static Builder|TransactionAssistant query()
 * @method static Builder|TransactionAssistant whereAmount($value)
 * @method static Builder|TransactionAssistant whereAppointmentId($value)
 * @method static Builder|TransactionAssistant whereCreatedAt($value)
 * @method static Builder|TransactionAssistant whereId($value)
 * @method static Builder|TransactionAssistant whereMeta($value)
 * @method static Builder|TransactionAssistant whereTransactionId($value)
 * @method static Builder|TransactionAssistant whereType($value)
 * @method static Builder|TransactionAssistant whereUpdatedAt($value)
 * @method static Builder|TransactionAssistant whereUserId($value)
 *
 * @mixin \Eloquent
 */
class TransactionAssistant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'appointment_id',
        'amount',
        'meta',
        'type',
        'status',
        'accepted_by',
    ];

    protected $table = 'transactions_assistants';

    const SUCCESS = 1;

    const PENDING = 0;

    const PAYMENT_STATUS = [
        self::SUCCESS => 'Success',
        self::PENDING => 'Pending',
    ];

    protected $casts = [
        'meta' => 'json',
        'transaction_id' => 'string',
        'appointment_id' => 'string',
        'type' => 'integer',
        'accepted_by' => 'integer',
        'user_id' => 'integer',
        'amount' => 'float',
        'status' => 'boolean',
    ];



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointment()
    {
        return $this->hasOne(AppointmentAssistant::class, 'appointment_unique_id', 'appointment_id');
    }

    public function assistantappointment()
    {
        $doctors = Assistant::whereUserId(getLogInUserId())->first();

        return $this->hasOne(AppointmentAssistant::class, 'appointment_unique_id', 'appointment_id')->where('assistant_id',
            $doctors->id);
    }

    public function acceptedPaymentUser()
    {
        return $this->belongsTo(User::class, 'accepted_by', 'id');
    }
}
