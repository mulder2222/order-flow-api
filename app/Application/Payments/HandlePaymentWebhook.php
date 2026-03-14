<?php

namespace App\Application\Payments;

use App\Domain\Orders\Order;

final class HandlePaymentWebhook
{
    public function handle(Order $order, string $externalEventId): Order
    {
        /**
         * Real implementation should check whether the external event has
         * already been processed before mutating order state.
         */
        $order->markPaid();

        return $order;
    }
}
