<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentGatewayAssistant
 *
 * @property int $id
 * @property int $payment_gateway_id
 * @property string $payment_gateway
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant wherePaymentGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant wherePaymentGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentGatewayAssistant whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class PaymentGatewayAssistant extends Model
{ 
    use HasFactory;

    protected $table = 'payment_gateways_assistants';

    protected $fillable = [
        'payment_gateway_id',
        'payment_gateway',
    ];

    protected $casts = [
        'payment_gateway_id' => 'integer',
        'payment_gateway' => 'string',
    ];
}
