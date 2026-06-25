# RoamFit Product Requirements Document

## 1. Product Identity

RoamFit is a nationwide fitness and sports access marketplace for the Philippines. The product promise is **Train Anywhere in the Philippines**: members buy configurable credits once and redeem them at verified independent partner fitness businesses across cities and provinces.

Legacy references to FitPass PH are superseded by the RoamFit brand. All public UI, API examples, documents, payment descriptors, notification templates, and partner materials must use RoamFit.

## 2. Vision and Strategy

RoamFit gives travelers, students, OFWs, remote workers, digital nomads, beginners, and fitness enthusiasts a portable fitness routine without forcing them into one gym location or one chain. For independent fitness businesses, RoamFit is a free onboarding growth channel with no setup, listing, or monthly fees.

### Strategic pillars

1. **Fitness portability** — make credits usable wherever partner availability and fraud controls allow.
2. **Independent business growth** — increase partner utilization without fixed SaaS fees.
3. **Trust and safety** — verified businesses, verified visits, auditable redemptions, and anti-fraud controls.
4. **Beginner-friendly engagement** — simple goals, muscle tracking, consistency scoring, and rewards without medical claims.
5. **Configurable operations** — categories, packages, credit costs, rewards, milestones, levels, challenges, and scoring rules are admin-managed.

## 3. Personas

| Persona | Needs | Primary jobs |
| --- | --- | --- |
| Member | Flexible gym access, discovery, credits, progress, rewards | Register, verify, buy credits, find facilities, check in, review, track habits |
| Business Owner | Demand generation, staff tools, analytics, payouts | Register business, submit documents, manage facilities, configure services, monitor earnings |
| Staff | Fast secure access validation | Scan dynamic QR, verify identity, monitor active visitors, resolve attendance issues |
| Super Admin | Platform governance and growth | Approve businesses, manage disputes, configure rewards/pricing, monitor fraud, run payouts |

## 4. Core MVP Scope

### Member

- Account registration, verification, MFA-ready authentication, session and device management.
- Credit package browsing and purchase through payment provider abstraction.
- Facility search by location, city, province, distance, rating, equipment, amenities, facility type, credit cost, and operating hours.
- Facility profile pages with media, map, amenities, equipment inventory, services, coaches, operating hours, peak hours, capacity, cost, reviews, and ratings.
- Secure dynamic QR check-in initiation and visit history.
- Verified-visit-only reviews with moderation hooks.
- Fitness profile, muscle group prompts after verified visits, weekly muscle dashboard, consistency score, streaks, FitPoints, levels, challenges, and fitness passport.
- Favorites and notification preferences.

### Business owner

- Business registration and document submission.
- Facility, amenity, equipment, service, staff, schedule, capacity, and credit-cost management.
- Visit, revenue, payout, promotion, and facility analytics dashboards.

### Staff

- QR scanning and validation workflow.
- Identity check screen with member photo/name, token freshness, facility match, geofence status, and credit redemption status.
- Active visitor and attendance monitoring.

### Super admin

- Business approvals, suspensions, document review, user management, RBAC, disputes, payouts, promotions, rewards, challenges, settings, fraud queue, analytics, and audit logs.

## 5. Configurability Requirements

The platform must not hardcode business categories, muscle groups, fitness goals, equipment, amenities, services, credit packages, reward values, streak milestones, levels, challenge rules, scoring weights, operating calendars, or payout rules. These are stored as database records or platform settings and cached for runtime use.

## 6. Fitness Profile and Engagement

Fitness profiles store height, weight, age or birth date, sex, fitness level, and selected goals. The weekly muscle dashboard classifies configured muscle groups as trained this week, recently trained, or due for training using configurable thresholds. Guidance must be motivational and non-clinical, for example: "Consider balancing your week with a lower-body session when you feel ready."

The consistency score combines weekly visits, monthly visits, streak health, challenge completion, goal completion, and training variety. Weights are configurable in platform settings and versioned so historical scores can be explained.

## 7. Rewards

FitPoints are earned from configurable rules such as check-ins, reviews, streaks, challenges, referrals, and visiting new facilities. Levels are configured by threshold. Challenges may be monthly, seasonal, travel, exploration, or custom. The reward marketplace is modeled to support bonus credits at MVP and later vouchers, merchandise, partner rewards, and premium features without schema redesign.

## 8. Payments and Revenue

Partner onboarding is free. Revenue comes from user credit purchases. Packages define price, currency, credit quantity, validity, promotional eligibility, and availability windows. Payment providers are integrated behind a provider interface for GCash, Maya, Visa, Mastercard, and bank transfer. The ledger is the source of truth for credits, not payment provider callbacks alone.

## 9. Non-Functional Requirements

- Availability target: 99.9% for MVP, moving to 99.95% after national scale.
- API p95 latency: under 300 ms for cached reads, under 800 ms for transactional writes excluding payment provider latency.
- QR tokens rotate every 30-60 seconds and are single-use where redemption is attempted.
- Audit logging for administrative actions, financial ledger mutations, check-in validations, role changes, and fraud decisions.
- Localization-ready copy, Philippine peso currency support, WCAG 2.2 AA target, dark mode, and mobile-first UX.
