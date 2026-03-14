<?php

namespace App\Http\Controllers;

final class OrderController
{
    public function store(): array
    {
        return ['message' => 'Create order endpoint placeholder'];
    }

    public function submit(string $orderId): array
    {
        return ['message' => sprintf('Submit order %s endpoint placeholder', $orderId)];
    }

    public function show(string $orderId): array
    {
        return ['message' => sprintf('Show order %s endpoint placeholder', $orderId)];
    }
}
