<?php

namespace App\Application\Payments;

final class HandlePaymentWebhookInput
{
    /**
     * @param array<string, mixed> $payload
     */
    public function __construct(
        public readonly string $eventId,
        public readonly string $orderId,
        public readonly array $payload,
    ) {
    }
}
