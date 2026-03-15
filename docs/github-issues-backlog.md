# GitHub Issues Backlog

These are intentionally phrased so they can be turned into GitHub issues with minimal rewriting.

## High Priority

### Add Laravel application bootstrap

Create the actual Laravel 11 application structure in the repository and wire the existing project layout into framework conventions.

### Replace placeholder SQL files with Laravel migration classes

Convert the migration placeholders into proper Laravel migration classes for customers, products, orders, order lines, payment webhook receipts, and webhook deliveries.

### Implement Eloquent-backed order repository

Create an infrastructure implementation of `OrderRepository` that can load and save order aggregates while keeping workflow rules in domain code.

### Implement payment webhook receipt repository

Add persistent idempotency support for payment events by storing processed `event_id` values and raw payloads.

### Convert request placeholders into Laravel FormRequest classes

Replace documentation-only request classes with real FormRequest validation for customers, products, orders, order lines, and payment webhooks.

## Medium Priority

### Return stable JSON API resources

Replace placeholder controller arrays with consistent JSON response shapes using resource classes and documented error responses.

### Add feature tests for order lifecycle

Cover creating a draft order, adding lines, submitting it, and rejecting invalid transitions.

### Add feature tests for duplicate payment webhooks

Verify that the same external event cannot mark an order as paid twice.

### Add retry logic for outbound webhook deliveries

Persist delivery attempts, last error information, and final delivery status.

### Add CI that installs dependencies and runs tests

Replace the placeholder CI step with real Composer install and test execution.

## Lower Priority

### Add OpenAPI generation or validation

Keep the API contract in sync by validating or generating OpenAPI artifacts as part of CI.

### Add Docker-based local developer workflow

Document and refine the path for running the app, database, and Redis locally through Docker.

### Add operational filtering for webhook deliveries

Support filtering by status, order id, and time range on the delivery log endpoint.
