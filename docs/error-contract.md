# Error Contract

This API should return stable, machine-readable error responses instead of raw framework exceptions.

## Shape

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

## Validation Errors

Status: `422 Unprocessable Entity`

Example:

```json
{
  "error": {
    "code": "validation_failed",
    "message": "The given data was invalid.",
    "details": {
      "customer_id": [
        "The customer id field is required."
      ]
    }
  }
}
```

## Domain Errors

Status: `409 Conflict` or `422 Unprocessable Entity`, depending on the failure.

Examples:

- `order_invalid_transition`
- `payment_event_already_processed`
- `order_not_editable`

## Rules

- use predictable `code` values
- do not leak stack traces
- include actionable `details` only when they help clients recover
- keep framework exception text out of public API responses
