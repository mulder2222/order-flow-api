<?php

namespace App\Application\Orders;

use App\Domain\Orders\Order;
use App\Domain\Orders\OrderRepository;

final class SubmitOrder
{
    public function __construct(
        private readonly OrderRepository $orders,
    ) {
    }

    public function handle(SubmitOrderInput $input): Order
    {
        $order = $this->orders->getById($input->orderId);
        $order->submit();
        $this->orders->save($order);

        return $order;
    }
}
