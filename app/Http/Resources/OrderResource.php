<?php

namespace App\Http\Resources;

use App\Domain\Orders\Order;

final class OrderResource
{
    /**
     * @return array<string, mixed>
     */
    public static function fromDomain(Order $order): array
    {
        return [
            'id' => $order->id,
            'status' => $order->status,
            'lines' => $order->lines,
        ];
    }
}
