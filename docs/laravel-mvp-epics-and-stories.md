# RoamFit Laravel MVP Epics and Stories

## 1. Product Direction

RoamFit should pivot from the current multi-application TypeScript monorepo into a single Laravel MVP application. The goal is to ship the smallest useful marketplace that validates the business: members can discover partner facilities, maintain a credit balance, and complete verified check-ins while owners and admins can manage supply and operations.

The MVP intentionally avoids Next.js, NestJS, Expo, Prisma, Terraform, OpenSearch, Redis, and mobile-app complexity. Those can return after product-market validation. The Laravel MVP should be deployable as one web application with one database, one auth system, and one admin panel.

## 2. Recommended MVP Stack

- Laravel web application at the repository root.
- Blade + Tailwind for public/member/business pages.
- Filament for internal admin and operational dashboards.
- Laravel Breeze or Fortify for authentication.
- Spatie Laravel Permission for roles and permissions.
- PostgreSQL for production; SQLite may be used for local tests.
- Eloquent models and migrations.
- Pest or PHPUnit for tests.
- Manual payment confirmation for MVP; payment gateway integration comes later.
- Responsive web first; native mobile deferred.

## 3. Phase Overview

| Phase | Theme | Goal | Exit Criteria |
| --- | --- | --- | --- |
| Phase 0 | Reset and foundation | Replace the monorepo with a clean Laravel app | App installs, boots locally, authenticates users, and passes tests |
| Phase 1 | Admin and marketplace core | Admins can configure supply and member-visible facilities | Approved facilities are browsable by members |
| Phase 2 | Credits and purchases | Members can request/buy credits and admins can confirm payments | Credit ledger balance is accurate and auditable |
| Phase 3 | Check-ins | Members can generate check-in tokens and staff can redeem them | Credits are deducted only after valid staff redemption |
| Phase 4 | Owner and staff workflows | Businesses can manage facilities and staff can operate check-ins | Owners/staff can perform core jobs without admin impersonation |
| Phase 5 | Reviews, basic fitness, and retention | Add lightweight engagement features | Verified reviews and simple fitness tracking work |
| Phase 6 | Production hardening and launch | Deploy and operate the MVP safely | Production is live with backups, logs, and launch checklist complete |

## 4. Phase 0 — Reset and Laravel Foundation

### Epic 0.1 — Repository reset

**Goal:** Remove scaffold complexity and establish Laravel as the only runtime.

#### Story 0.1.1 — Remove monorepo scaffold

As a developer, I want the NestJS, Next.js, Expo, Prisma, and Terraform scaffold removed so the repository has one obvious Laravel application path.

**Acceptance criteria:**

- `apps/api`, `apps/web`, `apps/mobile`, `packages`, and `infra/terraform` are removed or archived outside the runnable app.
- Root JavaScript workspace files that exist only for the old scaffold are removed.
- Documentation clearly states the project is now Laravel-first.

#### Story 0.1.2 — Create Laravel app at repo root

As a developer, I want a standard Laravel app at the repository root so local setup and deployment follow common Laravel conventions.

**Acceptance criteria:**

- `composer.json`, `artisan`, `app/`, `bootstrap/`, `config/`, `database/`, `resources/`, `routes/`, `storage/`, and `tests/` exist.
- `php artisan about` works locally after dependency install.
- `.env.example` contains Laravel-specific defaults.

### Epic 0.2 — Authentication and roles

#### Story 0.2.1 — Install basic authentication

As a user, I want to register, log in, and log out so I can access RoamFit securely.

**Acceptance criteria:**

- Registration, login, logout, password reset, and email verification routes exist.
- Users have a status field such as `pending`, `active`, or `suspended`.
- Tests cover registration and login.

#### Story 0.2.2 — Add roles and permissions

As an admin, I want users to have roles so members, owners, staff, and admins see only the correct features.

**Acceptance criteria:**

- Roles exist for `member`, `business_owner`, `staff`, and `admin`.
- Authorization middleware protects role-specific routes.
- A database seeder creates the initial roles and admin user.

## 5. Phase 1 — Admin and Marketplace Core

### Epic 1.1 — Configurable taxonomy

#### Story 1.1.1 — Manage facility categories

As an admin, I want configurable facility categories so RoamFit does not hardcode gym types.

**Acceptance criteria:**

- Admins can create, edit, disable, and sort categories.
- Facilities can belong to one or more categories.
- Disabled categories are not available for new facility listings.

#### Story 1.1.2 — Manage amenities, equipment, and services

As an admin, I want configurable amenities, equipment, and services so facilities can describe what they offer.

**Acceptance criteria:**

- Admin resources exist for amenities, equipment, and services.
- Facilities can attach multiple amenities, equipment items, and services.
- Equipment attachment can optionally store quantity and notes.

### Epic 1.2 — Business and facility management

#### Story 1.2.1 — Admin manages businesses

As an admin, I want to approve and suspend businesses so marketplace supply stays trusted.

**Acceptance criteria:**

- Business records include legal name, trade name, status, contact details, and owner.
- Admins can approve, reject, suspend, and reactivate businesses.
- Suspended businesses hide their facilities from member discovery.

#### Story 1.2.2 — Admin manages facilities

As an admin, I want to manage partner facilities so members can browse accurate listings.

**Acceptance criteria:**

- Facility records include name, description, address, city, province, coordinates, status, capacity, and credit cost.
- Facility media can start as URL fields or simple uploaded images.
- Only active facilities appear publicly.

### Epic 1.3 — Member discovery

#### Story 1.3.1 — Public facility list

As a member or visitor, I want to browse facilities so I can find places to train.

**Acceptance criteria:**

- Facility listing page shows active facilities.
- Users can filter by city, province, category, credit cost, and keyword.
- Listings show facility name, location, category, rating placeholder, and credit cost.

#### Story 1.3.2 — Facility detail page

As a member, I want detailed facility pages so I know what to expect before checking in.

**Acceptance criteria:**

- Detail page shows description, address, operating hours, amenities, equipment, services, and credit cost.
- Members can start check-in from an active facility detail page after login.
- Inactive or suspended facilities cannot start check-ins.

## 6. Phase 2 — Credits and Purchases

### Epic 2.1 — Credit packages

#### Story 2.1.1 — Admin manages credit packages

As an admin, I want configurable credit packages so pricing can change without code changes.

**Acceptance criteria:**

- Packages include name, price, currency, credits, validity days, and active status.
- Only active packages appear to members.
- Package values are not hardcoded in views or controllers.

#### Story 2.1.2 — Member views credit packages

As a member, I want to choose a credit package so I can add credits to my account.

**Acceptance criteria:**

- Member package page lists active packages.
- Selecting a package creates a pending purchase.
- Member sees payment instructions for manual confirmation.

### Epic 2.2 — Manual purchases and credit ledger

#### Story 2.2.1 — Admin confirms manual purchases

As an admin, I want to confirm payments manually so the MVP can sell credits before payment gateway integration.

**Acceptance criteria:**

- Purchases have statuses such as `pending`, `paid`, `rejected`, and `refunded`.
- Admin can mark a pending purchase as paid.
- Marking as paid creates a credit ledger entry exactly once.

#### Story 2.2.2 — Member sees credit balance

As a member, I want to see my current credit balance and history so I trust the system.

**Acceptance criteria:**

- Member dashboard shows current credit balance.
- Member can view credit ledger entries with reason, delta, and date.
- Balance is derived from ledger entries or kept in sync by a tested service.

## 7. Phase 3 — Check-ins

### Epic 3.1 — Check-in token generation

#### Story 3.1.1 — Member creates check-in token

As a member, I want to generate a check-in token for a facility so staff can validate my visit.

**Acceptance criteria:**

- Token includes user, facility, expiry, status, and random secure code.
- Token expires after a short configurable duration.
- Member cannot create token if credit balance is insufficient.

#### Story 3.1.2 — Member sees QR or code

As a member, I want to show a QR code or short code to staff so check-in is fast.

**Acceptance criteria:**

- Check-in page displays a scannable token representation or manual code.
- Page clearly shows expiry time.
- Expired tokens cannot be redeemed.

### Epic 3.2 — Staff redemption

#### Story 3.2.1 — Staff redeems token

As staff, I want to scan or enter a token so I can validate member access.

**Acceptance criteria:**

- Staff redemption page accepts token code.
- System validates token status, expiry, facility, user status, facility status, and credit balance.
- Successful redemption creates a check-in and deducts credits.

#### Story 3.2.2 — Prevent duplicate redemption

As the business and platform, we need token redemption to be idempotent so credits are not double-charged.

**Acceptance criteria:**

- Redeeming the same token twice does not create duplicate check-ins.
- Duplicate attempt shows the existing redemption result.
- Tests cover duplicate redemption.

## 8. Phase 4 — Business Owner and Staff Workflows

### Epic 4.1 — Owner dashboard

#### Story 4.1.1 — Owner manages business profile

As a business owner, I want to manage my business details so my listing stays accurate.

**Acceptance criteria:**

- Owners can update business contact details and description.
- Admin-only fields such as approval status remain protected.
- Owner changes are audit-friendly with timestamps.

#### Story 4.1.2 — Owner manages facilities

As a business owner, I want to manage my facilities so I can keep operating information current.

**Acceptance criteria:**

- Owners can create and edit facilities for their business.
- New owner-created facilities require admin approval before public listing.
- Owners can attach amenities, equipment, services, and schedules.

### Epic 4.2 — Staff management

#### Story 4.2.1 — Owner invites staff

As a business owner, I want to add staff users so they can validate check-ins.

**Acceptance criteria:**

- Owner can invite or assign staff to a business/facility.
- Staff users can access only assigned facility check-in tools.
- Staff assignment can be disabled.

#### Story 4.2.2 — Staff views recent check-ins

As staff, I want to see recent check-ins so I can monitor attendance.

**Acceptance criteria:**

- Staff dashboard shows recent check-ins for assigned facilities.
- List includes member name, facility, time, and credits charged.
- Staff cannot see unrelated facilities.

## 9. Phase 5 — Reviews, Basic Fitness, and Retention

### Epic 5.1 — Verified reviews

#### Story 5.1.1 — Member leaves verified review

As a member, I want to review facilities I visited so other members can choose confidently.

**Acceptance criteria:**

- Only redeemed check-ins can create reviews.
- One review per member per check-in.
- Reviews include rating and optional comment.

#### Story 5.1.2 — Admin moderates reviews

As an admin, I want to hide inappropriate reviews so the marketplace stays trustworthy.

**Acceptance criteria:**

- Admin can publish, hide, or flag reviews.
- Hidden reviews do not appear publicly.
- Facility rating updates when review visibility changes.

### Epic 5.2 — Fitness profile and training logs

#### Story 5.2.1 — Member creates fitness profile

As a member, I want a simple fitness profile so RoamFit can support consistency without medical complexity.

**Acceptance criteria:**

- Profile stores height, weight, sex, fitness level, and selected goals.
- Fitness goals are configurable records.
- UI avoids medical claims.

#### Story 5.2.2 — Member logs trained muscle groups

As a member, I want to record what I trained after a check-in so I can track consistency.

**Acceptance criteria:**

- After check-in, member can select configured muscle groups.
- Training log is linked to the check-in.
- Member dashboard shows recently trained groups.

### Epic 5.3 — Lightweight rewards

#### Story 5.3.1 — Award basic FitPoints

As a member, I want to earn FitPoints from visits so I feel rewarded for consistency.

**Acceptance criteria:**

- Configurable rule awards points for redeemed check-ins.
- FitPoint ledger records reason and delta.
- Member dashboard shows points balance.

#### Story 5.3.2 — Track simple streaks

As a member, I want to see my visit streak so I stay motivated.

**Acceptance criteria:**

- Streak updates after redeemed check-ins.
- Dashboard shows current and longest streak.
- Streak language remains motivational and non-medical.

## 10. Phase 6 — Production Hardening and Launch

### Epic 6.1 — Operational readiness

#### Story 6.1.1 — Production environment setup

As an operator, I want a stable Laravel production environment so the MVP can launch reliably.

**Acceptance criteria:**

- Production environment variables are documented.
- HTTPS, queue worker, scheduler, and storage links are configured.
- Database migrations run in production.

#### Story 6.1.2 — Backups and logs

As an operator, I want backups and logs so failures can be diagnosed and recovered.

**Acceptance criteria:**

- Database backups are scheduled.
- Application logs are retained and accessible.
- Error reporting is configured.

### Epic 6.2 — Launch checklist

#### Story 6.2.1 — Seed launch data

As an admin, I want initial platform data so the app is usable on launch day.

**Acceptance criteria:**

- Admin user exists.
- Default categories, amenities, equipment, services, and credit packages are seeded.
- Sample or real approved launch facilities are loaded.

#### Story 6.2.2 — Smoke test launch flows

As the team, we want to smoke test the full MVP so launch risk is lower.

**Acceptance criteria:**

- Member registration works.
- Admin approval works.
- Credit purchase confirmation works.
- Check-in redemption works.
- Visit history and ledger are correct.

## 11. Suggested Build Order

1. Phase 0 first, because every later story depends on the Laravel foundation.
2. Phase 1 next, because the marketplace needs facilities before credits and check-ins matter.
3. Phase 2 before Phase 3, because check-ins need a credit balance.
4. Phase 3 before owner/staff polish, because check-in redemption is the core product loop.
5. Phase 4 after core redemption works, so owners and staff can operate without admin help.
6. Phase 5 only after the marketplace and check-in loop are stable.
7. Phase 6 throughout, but complete it before real users and partners are invited.

## 12. MVP Non-Goals

These are intentionally deferred:

- Native mobile app.
- OpenSearch.
- Terraform and AWS multi-service deployment.
- Rotating QR with device fingerprinting and geofencing.
- Fully automated payments.
- Advanced analytics warehouse.
- Complex rewards marketplace.
- Push notifications.
- Public API for third-party integrations.

## 13. First Implementation Milestone

The first coding milestone should be **Phase 0 + the smallest part of Phase 1**:

- Laravel app installed.
- Auth installed.
- Roles seeded.
- Filament installed.
- Admin can log in.
- Admin can create categories and facilities.
- Public users can view an active facility list.

This milestone proves the new architecture is simpler and deployable before rebuilding the full RoamFit product surface.
