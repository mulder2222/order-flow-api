<?php

namespace App\Domain\Orders;

use App\Domain\Shared\DomainException;

final class Order
{
    /**
     * @param array<int, array<string, mixed>> $lines
     */
    public function __construct(
        public readonly string $id,
        public string $status = OrderStatus::DRAFT,
        public array $lines = [],
    ) {
    }

    /**
     * @param array<string, mixed> $line
     */
    public function addLine(array $line): void
    {
        if ($this->status !== OrderStatus::DRAFT) {
            throw new DomainException('Only draft orders can be modified.');
        }

        $this->lines[] = $line;
    }

    public function submit(): void
    {
        if ($this->status !== OrderStatus::DRAFT) {
            throw new DomainException('Only draft orders can be submitted.');
        }

        if ($this->lines === []) {
            throw new DomainException('Order must contain at least one line.');
        }

        $this->status = OrderStatus::SUBMITTED;
    }

    public function markPaid(): void
    {
        if ($this->status !== OrderStatus::SUBMITTED) {
            throw new DomainException('Only submitted orders can be marked as paid.');
        }

        $this->status = OrderStatus::PAID;
    }
}
