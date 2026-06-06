# RoamFit

RoamFit is a production-grade fitness and sports access marketplace for the Philippines built around the promise: **Train Anywhere in the Philippines.**

This repository contains the venture-scale product blueprint and implementation scaffold for a modular monolith SaaS platform with member, business, staff, and super-admin experiences.

## Workspaces

- `apps/api` — NestJS REST API, Prisma data model, OpenAPI-ready modular monolith.
- `apps/web` — Next.js App Router web shell for member portal, business dashboard, and admin dashboard.
- `apps/mobile` — Expo React Native mobile shell for member and staff workflows.
- `packages/shared` — Shared TypeScript contracts and constants.
- `docs` — Product, architecture, security, rollout, cost, and roadmap documentation.
- `infra/terraform` — AWS Terraform skeleton for ECS Fargate, RDS, Redis, OpenSearch, S3, CloudFront, WAF, SES, SNS, and observability.

## Brand

The app name is **RoamFit**. Historical prompt references to “FitPass PH” are treated as legacy naming only.

## Quick Start

```bash
cp .env.example .env
npm install
npm run validate:repo
```

## Engineering Principles

- Configurable taxonomy, pricing, rewards, scoring, and credit rules; no hardcoded business categories or package values.
- Security-first architecture with short-lived QR tokens, fraud eventing, audit logs, RBAC, rate limits, and payment abstraction.
- Modular monolith boundaries aligned to future microservice extraction.
- Beginner-friendly fitness guidance without medical claims.
