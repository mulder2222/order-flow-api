<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderLineController;
use App\Http\Controllers\PaymentWebhookController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WebhookDeliveryController;

return [
    ['method' => 'POST', 'uri' => '/api/customers', 'action' => [CustomerController::class, 'store']],
    ['method' => 'POST', 'uri' => '/api/products', 'action' => [ProductController::class, 'store']],
    ['method' => 'POST', 'uri' => '/api/orders', 'action' => [OrderController::class, 'store']],
    ['method' => 'POST', 'uri' => '/api/orders/{order}/lines', 'action' => [OrderLineController::class, 'store']],
    ['method' => 'POST', 'uri' => '/api/orders/{order}/submit', 'action' => [OrderController::class, 'submit']],
    ['method' => 'GET', 'uri' => '/api/orders/{order}', 'action' => [OrderController::class, 'show']],
    ['method' => 'POST', 'uri' => '/api/webhooks/payments', 'action' => [PaymentWebhookController::class, 'handle']],
    ['method' => 'GET', 'uri' => '/api/webhook-deliveries', 'action' => [WebhookDeliveryController::class, 'index']],
];
