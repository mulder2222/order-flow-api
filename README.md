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
- duplicate payment webhook is handled idempotently
- invalid order transitions are rejected
- outbound webhook failures are retried safely

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
