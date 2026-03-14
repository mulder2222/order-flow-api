<?php

namespace App\Infrastructure\Webhooks;

final class WebhookDeliveryStatus
{
    public const PENDING = 'pending';
    public const DELIVERED = 'delivered';
    public const FAILED = 'failed';
}
