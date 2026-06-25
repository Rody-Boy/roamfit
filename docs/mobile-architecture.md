# RoamFit Mobile Architecture

The mobile app uses Expo React Native with TypeScript. It is mobile-first for members and staff, supports dark mode, accessibility labels, localization-ready strings, offline-friendly cached reads, biometric unlock, push notifications, secure token storage, and QR scanner workflows.

## Navigation

- Member tabs: Discover, Map, Check In, Rewards, Profile.
- Staff mode: Scanner, Active Visitors, Attendance, Account.
- Deep links: facility profile, purchase result, challenge, notification, staff invite.

## Offline Strategy

TanStack Query caches facility previews, member profile, credit summary, rewards summary, and recent visits. Offline check-in redemption is not allowed because fraud and credit validation must be online.
