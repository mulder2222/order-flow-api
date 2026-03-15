# Initial Backlog

## Milestone 1: Project Skeleton

- add Laravel application
- wire route definitions into framework router
- add base migrations
- add CI workflow

## Milestone 2: Orders

- create customer, product, order, and order line models
- implement draft order creation
- implement add line to order
- implement submit order use case

## Milestone 3: Payments

- implement payment webhook endpoint
- store webhook receipts
- add idempotency guard

## Milestone 4: Fulfillment And Notifications

- add fulfillment status tracking
- dispatch outbound webhook jobs
- add retry strategy and delivery logs

## Milestone 5: Quality

- add feature tests
- add unit tests for transition rules
- add integration tests for webhook delivery
- add GitHub Actions workflow

## Milestone 6: Delivery Readiness

- add Docker compose bootstrap
- add `.env.example`
- define error contract
- document architecture decisions
- add endpoint implementation notes
