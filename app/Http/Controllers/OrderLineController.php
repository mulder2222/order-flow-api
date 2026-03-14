<?php

namespace App\Http\Controllers;

final class OrderLineController
{
    public function store(string $orderId): array
    {
        return ['message' => sprintf('Add line to order %s endpoint placeholder', $orderId)];
    }
}
