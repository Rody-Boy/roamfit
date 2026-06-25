# RoamFit Infrastructure Architecture

## 1. AWS Services

- ECS Fargate for API, web, worker, and scheduled jobs.
- RDS PostgreSQL Multi-AZ for transactional data.
- ElastiCache Redis for cache, rate limits, idempotency, and QR challenges.
- OpenSearch for facility discovery.
- S3 for media, verification documents, exports, and logs.
- CloudFront for CDN distribution.
- WAF for edge protections and managed rules.
- Route53 for DNS.
- SES for email and SNS for push/event fanout.
- CloudWatch, OpenTelemetry, Prometheus, Grafana, and Sentry for observability.

## 2. Environments

- `dev`: low-cost shared non-production environment.
- `staging`: production-like environment with masked data.
- `prod`: highly available, monitored, access-controlled environment.

## 3. Deployment Pattern

Blue-green ECS services receive new task definitions behind an application load balancer. Health checks, smoke tests, and error-budget gates determine promotion or rollback. Database migrations run as controlled one-off tasks with preflight backups for high-risk changes.

## 4. Observability

Every request receives a trace ID propagated through logs, OpenTelemetry spans, database calls, cache calls, and provider integrations. Business KPIs include credit utilization, conversion, visits by province, partner revenue, retention cohorts, streak engagement, reward liability, failed redemption rates, and fraud event rates.
