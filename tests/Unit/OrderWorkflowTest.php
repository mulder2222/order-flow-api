<?php

namespace Tests\Unit;

use App\Domain\Orders\Order;
use App\Domain\Orders\OrderStatus;

final class OrderWorkflowTest
{
    public function testDraftOrderCanBeSubmittedAfterAddingALine(): void
    {
        $order = new Order(id: 'order-1');
        $order->addLine([
            'product_id' => 'product-1',
            'quantity' => 1,
            'unit_price_amount' => 1000,
        ]);

        $order->submit();

        assert($order->status === OrderStatus::SUBMITTED);
    }
}
