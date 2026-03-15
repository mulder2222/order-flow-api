# ADR 0002: Payment Webhooks Must Be Idempotent

## Status

Accepted

## Context

Payment providers routinely retry webhook deliveries. If the application processes the same event twice, order state can become inconsistent and downstream side effects can fire more than once.

## Decision

Every payment webhook event will be recorded by `event_id`. If an event has already been processed, the application will return a safe response without mutating the order again.

## Consequences

Positive:

- protects order state
- avoids duplicate downstream notifications
- simplifies operational reasoning

Negative:

- requires persistent event receipt storage
- requires careful uniqueness guarantees

This is worth the complexity because payment workflows are high-risk and should be predictable.
