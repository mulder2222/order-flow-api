<?php

return <<<'SQL'
CREATE TABLE payment_webhook_receipts (
    id UUID PRIMARY KEY,
    external_event_id VARCHAR(255) NOT NULL UNIQUE,
    order_id UUID NOT NULL,
    payload JSON NOT NULL,
    processed_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
SQL;
