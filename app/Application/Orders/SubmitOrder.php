<?php

namespace App\Application\Orders;

use App\Domain\Orders\Order;

final class SubmitOrder
{
    public function handle(Order $order): Order
    {
        $order->submit();

        return $order;
    }
}
