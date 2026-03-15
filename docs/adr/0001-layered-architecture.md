# ADR 0001: Keep Business Logic Out Of Controllers

## Status

Accepted

## Context

Laravel projects often start fast and drift toward controller-heavy application code. That becomes painful once order transitions, payment events, and fulfillment rules need to be changed safely.

## Decision

This project will keep:

- HTTP concerns in controllers and request objects
- orchestration in application services
- workflow rules in domain code
- persistence and integration details in infrastructure code

## Consequences

Positive:

- easier testing of business rules
- cleaner change boundaries
- less framework coupling across core logic

Negative:

- more files
- slightly more ceremony for simple endpoints

This tradeoff is intentional because the project is meant to model production-oriented backend design.
