# RoamFit Full Implementation Roadmap

## Phase 0: Foundation

- Confirm legal entity, payment partners, privacy policy, terms, partner agreement, payout policy, and support operations.
- Set up monorepo, environments, CI/CD, Terraform state, secrets, observability, and coding standards.

## Phase 1: Marketplace MVP

- Identity, roles, member onboarding, owner onboarding, admin approvals.
- Facility CRUD, configurable categories, amenities, equipment, services, schedules, media.
- Credit packages, purchases, payment webhooks, credit ledger.
- Facility search, maps, profiles, favorites.

## Phase 2: Secure Check-ins

- Dynamic QR generation, scanner, Redis nonce store, geofence checks, credit redemption transaction, audit logs.
- Staff active visitors and attendance monitoring.
- Fraud events and admin review queue.

## Phase 3: Engagement

- Fitness profiles, muscle tracking, weekly dashboard, consistency score.
- FitPoints, streaks, levels, challenges, passport, bonus-credit rewards.
- Push/email/in-app notifications.

## Phase 4: Business Operations

- Owner analytics, payout dashboard, promotions, partner announcements.
- Admin payout approvals, disputes, moderation, advanced settings.

## Phase 5: Scale and Expansion

- Load testing, blue-green automation, analytics warehouse, improved fraud models.
- Sports facility taxonomy expansion and direct booking architecture.
