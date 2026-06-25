# Deployment, Scaling, Cost, Risk, and Rollout Plan

## Deployment Strategy

1. Merge to main after CI passes.
2. Build immutable Docker images with commit SHA tags.
3. Apply Terraform plan through protected environments.
4. Run database migrations as a one-off task.
5. Deploy blue environment, run smoke tests, shift traffic gradually, monitor SLOs, and keep green ready for rollback.

## Scaling Plan

- Scale API and web ECS services by CPU, memory, request count, and p95 latency.
- Add read replicas for analytics-heavy dashboards.
- Use OpenSearch for geospatial discovery rather than transactional scans.
- Move notifications, rewards, and analytics to asynchronous workers as volume grows.
- Partition high-volume ledger, audit, and event tables by time when needed.

## Cost Projection

| Stage | Approximate monthly AWS cost | Notes |
| --- | ---: | --- |
| Private beta | USD 500-1,500 | Small ECS tasks, single-AZ non-prod, modest OpenSearch |
| City launch | USD 2,500-7,500 | Multi-AZ production RDS, WAF, CDN, observability |
| National scale | USD 10,000-35,000+ | Higher ECS capacity, OpenSearch scaling, media CDN, analytics workloads |

Payment fees, SMS/push/email, Sentry, Mapbox, CI minutes, and support tools are separate operational costs.

## Risk Assessment

| Risk | Impact | Mitigation |
| --- | --- | --- |
| QR fraud or account sharing | Revenue leakage and partner distrust | Rotating tokens, geofence, device trust, anomaly detection, audit review |
| Payment reconciliation errors | Financial loss | Idempotency, ledger source of truth, webhook signatures, daily reconciliation |
| Insufficient partner density | Weak marketplace utility | City-by-city rollout, partner success playbooks, launch incentives |
| Overly complex beginner UX | Low activation | Guided onboarding, plain-language fitness goals, progressive disclosure |
| Cloud cost growth | Margin pressure | Autoscaling, budgets, log sampling, storage lifecycle rules |

## Rollout Plan

1. Internal alpha with seed facilities and staff scanner validation.
2. Closed beta in Metro Manila with invite-only members.
3. Cebu and Davao expansion after fraud and payout operations stabilize.
4. Nationwide partner onboarding with regional playbooks.
5. Expand into sports facilities, yoga, dance, and direct booking.
