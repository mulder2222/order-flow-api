<?php

namespace App\Domain\Payments;

interface PaymentWebhookReceiptRepository
{
    public function hasProcessedEvent(string $eventId): bool;

    /**
     * @param array<string, mixed> $payload
     */
    public function markProcessed(string $eventId, string $orderId, array $payload): void;
}
