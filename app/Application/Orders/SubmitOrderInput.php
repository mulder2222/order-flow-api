<?php

namespace App\Application\Orders;

final class SubmitOrderInput
{
    public function __construct(
        public readonly string $orderId,
    ) {
    }
}
