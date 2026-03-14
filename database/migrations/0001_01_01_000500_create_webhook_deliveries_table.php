<?php

return <<<'SQL'
CREATE TABLE webhook_deliveries (
    id UUID PRIMARY KEY,
    order_id UUID NOT NULL,
    target_url VARCHAR(2048) NOT NULL,
    status VARCHAR(32) NOT NULL,
    attempts INT NOT NULL DEFAULT 0,
    last_error TEXT NULL,
    delivered_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
SQL;
