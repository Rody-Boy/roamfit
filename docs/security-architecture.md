# RoamFit Security Architecture

## 1. Security Objectives

RoamFit protects member identity, business financial records, facility access decisions, reward balances, payment events, and administrative actions. Security design follows OWASP Top 10 controls, least privilege, defense in depth, auditable change history, and privacy-by-design.

## 2. Identity and Access

- OAuth 2.1/OIDC-compatible authentication.
- Short-lived JWT access tokens and rotating refresh tokens.
- MFA-ready flows for members and enforced MFA for owners, staff, and admins.
- RBAC with roles and permissions stored in the database.
- Device registry with trust scoring, revocation, and session binding.
- Biometric login is local-device unlock for stored refresh-token access, not server-side biometric storage.

## 3. Check-in Fraud Controls

- Rotating QR codes backed by short-lived signed challenges.
- Nonce replay prevention using Redis and durable fraud events for suspicious attempts.
- Geofencing with accuracy thresholds and risk-based fallback review.
- Staff account must be assigned to the scanned facility.
- Device fingerprint and session consistency checks.
- Velocity rules for impossible travel, excessive failed scans, repeated device sharing, and multi-account abuse.
- Audit trail for every validation decision.

## 4. Application Security

- Global validation pipes, DTO schemas, output serialization, and strict CORS.
- Helmet secure headers, CSRF protection for cookie-based web sessions, and XSS-safe rendering.
- Prisma parameterization and repository allowlists for dynamic sorting/filtering.
- Secrets stored in AWS Secrets Manager and injected at runtime.
- TLS 1.3 at public edges where supported and modern TLS policies for AWS load balancers.
- AES-256 encryption at rest through managed AWS services and field-level encryption for sensitive document metadata where required.

## 5. Payment Security

- Provider adapters verify webhook signatures, timestamps, and replay windows.
- Internal ledger transactions are idempotent and reconciled against provider references.
- No raw card data is stored by RoamFit.
- Payment state transitions are finite-state-machine validated.

## 6. Audit and Monitoring

Audit logs capture actor, target, action, before/after summary, IP, user agent, device, trace ID, risk score, and tenant/business context. High-risk audit events are streamed to alerting and retained according to compliance policy.
