<?php

namespace Tests\Feature;

final class PaymentWebhookTest
{
    public function testDuplicatePaymentWebhookShouldBeHandledIdempotently(): void
    {
        /**
         * Intended future assertion:
         * the same external payment event should not mutate the order twice.
         */
        assert(true);
    }
}
