# Sequence Flows

These flows describe the intended application behavior at a level that is useful for implementation, testing, and code review.

## Submit Order Flow

1. Client calls `POST /api/orders/{order}/submit`
2. Controller validates route and request context
3. Application service loads order through `OrderRepository`
4. Domain model checks:
   - order is `draft`
   - order has at least one line
5. Order status changes to `submitted`
6. Repository persists updated order
7. Response returns updated order payload

## Payment Webhook Flow

1. Payment provider calls `POST /api/webhooks/payments`
2. Request is validated
3. Application service checks whether `event_id` already exists
4. If already processed:
   - return safe success or conflict response
   - do not mutate order
5. If not processed:
   - load order
   - mark order as `paid`
   - persist order
   - store webhook receipt
   - queue downstream processing if needed
6. Return accepted response

## Outbound Webhook Delivery Flow

1. Domain event or application action creates a delivery record
2. Delivery job attempts outbound HTTP request
3. On success:
   - set status to `delivered`
   - write `delivered_at`
4. On failure:
   - increment attempt count
   - store `last_error`
   - either retry later or mark as `failed`

## Failure Cases Worth Testing

- submit empty order
- submit already submitted order
- duplicate payment webhook
- payment webhook for non-submitted order
- outbound webhook retry after transient failure
