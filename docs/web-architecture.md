# RoamFit Web Architecture

The web applications use Next.js App Router, React, TypeScript, Tailwind CSS, shadcn/ui-compatible components, TanStack Query, React Hook Form, Zod, Framer Motion, and Mapbox.

## Applications

- Member portal: account, credits, visits, rewards, passport, reviews, favorites.
- Business dashboard: onboarding, facilities, staff, services, schedules, analytics, payouts, promotions.
- Admin dashboard: approvals, users, RBAC, rewards, settings, fraud, disputes, payouts, audit logs.

Server components are used for authenticated shell and SEO-safe public facility pages. Client components own interactive maps, forms, dashboards, and QR scanner interfaces.
