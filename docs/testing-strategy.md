# RoamFit Testing Strategy

- Unit tests: domain services, scoring rules, payment state machines, QR validation policies, reward rules.
- Integration tests: Prisma repositories, Redis idempotency, OpenSearch indexing, payment webhooks, notification adapters.
- E2E tests: registration, purchase, facility search, check-in, review, reward redemption, business approval, payout approval.
- Security tests: dependency scanning, SAST, secret scanning, authz matrix tests, OWASP ZAP baseline, rate-limit tests.
- Accessibility tests: automated axe checks and manual keyboard/screen-reader passes for critical flows.
- Performance tests: k6 load tests for facility search, QR generation, QR redemption, and dashboard reads.
