<?php

namespace App\Application\Payments;

use App\Domain\Orders\Order;
use App\Domain\Orders\OrderRepository;
use App\Domain\Payments\PaymentWebhookReceiptRepository;

final class HandlePaymentWebhook
{
    public function __construct(
        private readonly OrderRepository $orders,
        private readonly PaymentWebhookReceiptRepository $receipts,
    ) {
    }

    public function handle(HandlePaymentWebhookInput $input): Order
    {
        if ($this->receipts->hasProcessedEvent($input->eventId)) {
            return $this->orders->getById($input->orderId);
        }

        $order = $this->orders->getById($input->orderId);
        $order->markPaid();
        $this->orders->save($order);
        $this->receipts->markProcessed($input->eventId, $input->orderId, $input->payload);

        return $order;
    }
}
