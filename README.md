# order-flow-api

Laravel API for order workflows, payment webhooks, fulfillment events, and production-minded backend design.

## Overview

`order-flow-api` is a backend-focused Laravel application for managing order lifecycles from draft creation through submission, payment confirmation, fulfillment, and outbound partner notifications.

The goal of this project is not to demonstrate generic CRUD. It is to show how business workflows can be modeled explicitly with clear domain boundaries, predictable state transitions, and testable application code.

## Problem

Many business applications start as controller-heavy CRUD and become harder to reason about once payments, fulfillment rules, webhooks, retries, and audit requirements appear.

This project is designed to show a better structure:

- explicit workflow transitions
- thin HTTP layer
- domain-driven application services
- idempotent webhook handling
- retryable outbound integrations
- audit-friendly state changes

## Stack

- PHP 8.3 target
- Laravel 11 target
- MySQL or PostgreSQL
- Redis for queueing
- Docker for local setup
- PHPUnit or Pest for tests
- GitHub Actions for CI

## Architecture

The application is split into four main layers:

- `app/Http`: request validation, controllers, API resources
- `app/Application`: use cases and orchestration
- `app/Domain`: business entities, transition rules, and domain services
- `app/Infrastructure`: persistence concerns, repositories, and outbound integrations

### Request Flow

1. An HTTP request reaches a controller.
2. The request is validated and mapped to a use case.
3. The application layer orchestrates the action.
4. Domain services enforce workflow rules.
5. Infrastructure adapters persist state and dispatch side effects.
6. The response is returned through API resources.

## Domain Boundaries

This first version is organized around:

- Orders
- Payments
- Fulfillment
- Webhooks
- Audit

The key design rule is that order workflow rules should not live inside controllers or random Eloquent model methods.

## Proposed API

### Orders

- `POST /api/customers`
- `POST /api/products`
- `POST /api/orders`
- `POST /api/orders/{order}/lines`
- `POST /api/orders/{order}/submit`
- `GET /api/orders/{order}`

### Webhooks

- `POST /api/webhooks/payments`

### Operations

- `GET /api/webhook-deliveries`

## Example Payloads

### Create customer

```json
{
  "email": "jane@example.com",
  "name": "Jane Doe"
}
```

### Create product

```json
{
  "sku": "SKU-CHAIR-001",
  "name": "Office Chair",
  "price_amount": 12900,
  "currency": "EUR"
}
```

### Create order

```json
{
  "customer_id": "9d56c68f-12c8-4eb8-b81c-37f3159a5e21"
}
```

### Add order line

```json
{
  "product_id": "0dfe91d1-f0ff-418e-a2c2-348f37a7ecb0",
  "quantity": 2
}
```

### Payment webhook

```json
{
  "event_id": "evt_01HXYZPAYMENT",
  "order_id": "f4f4fdb6-ef25-4a0d-9718-f3af767b3a89",
  "status": "paid",
  "received_at": "2026-03-14T10:15:00Z",
  "amount": 25800,
  "currency": "EUR"
}
```

## Example Response

```json
{
  "id": "f4f4fdb6-ef25-4a0d-9718-f3af767b3a89",
  "customer_id": "9d56c68f-12c8-4eb8-b81c-37f3159a5e21",
  "status": "submitted",
  "lines": [
    {
      "product_id": "0dfe91d1-f0ff-418e-a2c2-348f37a7ecb0",
      "quantity": 2,
      "unit_price_amount": 12900
    }
  ],
  "totals": {
    "subtotal_amount": 25800,
    "currency": "EUR"
  }
}
```

## Folder Structure

```text
app/
  Application/
    Orders/
    Payments/
    Fulfillment/
    Webhooks/
  Domain/
    Orders/
    Payments/
    Fulfillment/
    Shared/
    Webhooks/
  Http/
    Controllers/
    Requests/
    Resources/
  Infrastructure/
    Persistence/
    Webhooks/
config/
database/
  migrations/
docs/
routes/
tests/
  Feature/
  Integration/
  Unit/
```

## Local Setup

This repository is currently a structured starter and documentation-first scaffold. Once Laravel is installed, the intended local setup is:

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan test
```

## Testing

The intended test split is:

- `tests/Feature`: API contract and workflow tests
- `tests/Unit`: order transition rules and domain services
- `tests/Integration`: webhook delivery, retries, and persistence boundaries

High-value scenarios:

- draft order can be submitted once
- draft order cannot be submitted without lines
- duplicate payment webhook is handled idempotently
- invalid order transitions are rejected
- outbound webhook failures are retried safely

## Documentation

- API spec: [docs/openapi.yaml](C:/Users/mulde/Documents/Github/order-flow-api/docs/openapi.yaml)
- Architecture notes: [docs/architecture.md](C:/Users/mulde/Documents/Github/order-flow-api/docs/architecture.md)
- Initial backlog: [docs/backlog.md](C:/Users/mulde/Documents/Github/order-flow-api/docs/backlog.md)

## Tradeoffs

- Laravel is used for delivery speed, but business rules are kept out of controllers
- Eloquent can remain at the infrastructure boundary instead of leaking into all domain code
- Outbound integration work is modeled explicitly instead of being hidden behind fire-and-forget calls
- This project favors clarity over maximal abstraction

## Future Improvements

- OpenAPI documentation
- Docker compose for full local environment
- health checks and metrics
- authorization and internal operations views
- CI for tests and static analysis
