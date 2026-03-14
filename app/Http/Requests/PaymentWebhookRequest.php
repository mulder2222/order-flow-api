<?php

namespace App\Http\Requests;

final class PaymentWebhookRequest
{
    /**
     * Intended Laravel validation rules:
     *
     * - event_id: required|string|max:255
     * - order_id: required|uuid|exists:orders,id
     * - status: required|in:paid
     * - received_at: required|date
     * - amount: required|integer|min:1
     * - currency: required|string|size:3
     */
}
