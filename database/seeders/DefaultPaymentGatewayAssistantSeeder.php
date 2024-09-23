<?php

namespace Database\Seeders;


use App\Models\AppointmentAssistant;
use App\Models\PaymentGateway;
use App\Models\PaymentGatewayAssistant;
use Illuminate\Database\Seeder;

class DefaultPaymentGatewayAssistantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentGateways = [
            [
                'payment_gateway_id' => AppointmentAssistant::MANUALLY,
                'payment_gateway' => AppointmentAssistant::PAYMENT_METHOD[1],
            ],
            [
                'payment_gateway_id' => AppointmentAssistant::STRIPE,
                'payment_gateway' => AppointmentAssistant::PAYMENT_METHOD[2],
            ],
            [
                'payment_gateway_id' => AppointmentAssistant::PAYSTACK,
                'payment_gateway' => AppointmentAssistant::PAYMENT_METHOD[3],
            ],
            [
                'payment_gateway_id' => AppointmentAssistant::PAYPAL,
                'payment_gateway' => AppointmentAssistant::PAYMENT_METHOD[4],
            ],
            [
                'payment_gateway_id' => AppointmentAssistant::RAZORPAY,
                'payment_gateway' => AppointmentAssistant::PAYMENT_METHOD[5],
            ],
            [
                'payment_gateway_id' => AppointmentAssistant::AUTHORIZE,
                'payment_gateway' => AppointmentAssistant::PAYMENT_METHOD[6],
            ],
            [
                'payment_gateway_id' => AppointmentAssistant::PAYTM,
                'payment_gateway' => AppointmentAssistant::PAYMENT_METHOD[7],
            ],
        ];

        foreach ($paymentGateways as $paymentGateway) {
            PaymentGatewayAssistant::create($paymentGateway);
        }
    }
}
