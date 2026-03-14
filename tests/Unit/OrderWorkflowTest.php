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

    public function testDraftOrderCannotBeSubmittedWithoutLines(): void
    {
        $order = new Order(id: 'order-2');
        $failed = false;

        try {
            $order->submit();
        } catch (\Throwable $exception) {
            $failed = true;
        }

        assert($failed === true);
    }

    public function testPaidOrderCanEnterFulfillment(): void
    {
        $order = new Order(id: 'order-3');
        $order->addLine([
            'product_id' => 'product-1',
            'quantity' => 1,
            'unit_price_amount' => 1000,
        ]);
        $order->submit();
        $order->markPaid();
        $order->startFulfillment();

        assert($order->status === OrderStatus::FULFILLING);
    }
}
