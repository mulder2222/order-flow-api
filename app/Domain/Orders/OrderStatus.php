<?php

namespace App\Domain\Orders;

final class OrderStatus
{
    public const DRAFT = 'draft';
    public const SUBMITTED = 'submitted';
    public const PAID = 'paid';
    public const FULFILLING = 'fulfilling';
    public const FULFILLED = 'fulfilled';
    public const CANCELLED = 'cancelled';

    /**
     * @return string[]
     */
    public static function all(): array
    {
        return [
            self::DRAFT,
            self::SUBMITTED,
            self::PAID,
            self::FULFILLING,
            self::FULFILLED,
            self::CANCELLED,
        ];
    }
}
