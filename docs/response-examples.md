# Response Examples

## `POST /api/customers`

### Success

```json
{
  "data": {
    "id": "9d56c68f-12c8-4eb8-b81c-37f3159a5e21",
    "email": "jane@example.com",
    "name": "Jane Doe"
  }
}
```

## `POST /api/products`

### Success

```json
{
  "data": {
    "id": "0dfe91d1-f0ff-418e-a2c2-348f37a7ecb0",
    "sku": "SKU-CHAIR-001",
    "name": "Office Chair",
    "price_amount": 12900,
    "currency": "EUR"
  }
}
```

## `POST /api/orders`

### Success

```json
{
  "data": {
    "id": "f4f4fdb6-ef25-4a0d-9718-f3af767b3a89",
    "customer_id": "9d56c68f-12c8-4eb8-b81c-37f3159a5e21",
    "status": "draft",
    "lines": [],
    "totals": {
      "subtotal_amount": 0,
      "currency": "EUR"
    }
  }
}
```

## `POST /api/orders/{order}/submit`

### Success

```json
{
  "data": {
    "id": "f4f4fdb6-ef25-4a0d-9718-f3af767b3a89",
    "status": "submitted"
  }
}
```

### Invalid Transition

```json
{
  "error": {
    "code": "order_invalid_transition",
    "message": "Only draft orders can be submitted.",
    "details": {
      "order_id": "f4f4fdb6-ef25-4a0d-9718-f3af767b3a89",
      "current_status": "submitted"
    }
  }
}
```

## `POST /api/webhooks/payments`

### Success

```json
{
  "data": {
    "event_id": "evt_01HXYZPAYMENT",
    "status": "accepted"
  }
}
```

### Duplicate Event

```json
{
  "error": {
    "code": "payment_event_already_processed",
    "message": "The payment event has already been processed.",
    "details": {
      "event_id": "evt_01HXYZPAYMENT"
    }
  }
}
```
