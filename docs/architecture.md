# Architecture Notes

## Goal

Keep business workflow logic explicit and testable.

## Layer Responsibilities

### HTTP

- validate requests
- translate HTTP input into use-case input
- return API-friendly responses

### Application

- orchestrate use cases
- open and commit transactions where needed
- dispatch jobs and side effects

### Domain

- define workflow states
- guard transitions
- enforce business rules

### Infrastructure

- persistence implementation
- outbound webhook clients
- queue delivery behavior

## Main Workflow

1. Order starts as `draft`
2. Lines are added or removed while draft
3. Order is submitted
4. Payment webhook confirms payment
5. Fulfillment status progresses
6. Outbound notifications are recorded and retried when needed

## Important Rules

- only draft orders can be edited
- submitted orders cannot be resubmitted
- duplicate payment webhooks must be idempotent
- outbound delivery attempts must be traceable
