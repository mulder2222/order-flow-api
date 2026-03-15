# Endpoint Implementation Plan

## `POST /api/customers`

### Goal

Create a customer that can place orders.

### Implementation Notes

- validate `email` and `name`
- store customer in persistence layer
- return `201`

## `POST /api/products`

### Goal

Create a sellable catalog item.

### Implementation Notes

- validate `sku`, `name`, `price_amount`, `currency`
- keep product pricing immutable enough to avoid retroactively changing order history

## `POST /api/orders`

### Goal

Create a draft order for a customer.

### Implementation Notes

- require a valid `customer_id`
- create order in `draft` state
- return empty lines array and initial totals

## `POST /api/orders/{order}/lines`

### Goal

Add an item to a draft order.

### Implementation Notes

- reject if order is not `draft`
- capture `unit_price_amount` at time of addition
- recompute totals after line mutation

## `POST /api/orders/{order}/submit`

### Goal

Move a draft order into the submitted state.

### Implementation Notes

- reject empty orders
- reject non-draft orders
- write `submitted_at`
- queue outbound event if needed

## `POST /api/webhooks/payments`

### Goal

Accept payment events from an external provider.

### Implementation Notes

- store raw event payload
- reject or ignore duplicate `event_id`
- update order to `paid` only once
- enqueue outbound webhook delivery or downstream processing

## `GET /api/webhook-deliveries`

### Goal

Expose operational insight into outbound partner notifications.

### Implementation Notes

- include `status`, `attempts`, `last_error`, `delivered_at`
- support filtering later by status or order id
