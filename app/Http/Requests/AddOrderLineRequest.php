<?php

namespace App\Http\Requests;

final class AddOrderLineRequest
{
    /**
     * Intended Laravel validation rules:
     *
     * - product_id: required|uuid|exists:products,id
     * - quantity: required|integer|min:1
     */
}
