# RoamFit Laravel MVP

RoamFit is a credit-based fitness marketplace for the Philippines. This repository has been reset from a multi-application TypeScript scaffold to a **single Laravel MVP** so the first release can ship faster with fewer deployment and dependency issues.

## MVP Goal

Ship the smallest useful product loop:

1. Members register and browse active facilities.
2. Admins configure businesses, facilities, categories, and credit packages.
3. Members buy/request credits.
4. Staff redeem member check-ins.
5. The credit ledger remains accurate and auditable.

## Stack

- Laravel 12-style application at the repository root
- Blade views with Tailwind CDN for the MVP UI
- Eloquent models and migrations
- PostgreSQL for production, SQLite for local development/tests
- Manual payment confirmation before payment gateway integration
- Responsive web first; native mobile deferred

## Local Setup

```bash
cp .env.example .env
composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Default seeded users after `php artisan migrate --seed`:

- Admin: `admin@roamfit.test` / `password`
- Owner: `owner@roamfit.test` / `password`

## Development Checks

```bash
composer test
find app bootstrap config database routes tests -name '*.php' -print0 | xargs -0 -n1 php -l
```

## Roadmap

See `docs/laravel-mvp-epics-and-stories.md` for the phased MVP plan.
