# RoamFit API Specification

## 1. Standards

- Protocol: REST over HTTPS.
- Base path: `/api/v1`.
- Serialization: JSON UTF-8.
- Documentation: Swagger/OpenAPI generated from NestJS decorators.
- Authentication: OAuth 2.1/OIDC-compatible flows, JWT access tokens, refresh token rotation.
- Idempotency: required for payment initiation, checkout confirmation, QR redemption, reward redemption, and payout operations.
- Pagination: cursor-first pagination with `limit`, `cursor`, `sort`, and `direction`.
- Filtering: explicit allowlisted query fields per endpoint.
- Error envelope: `{ "error": { "code", "message", "details", "traceId" } }`.

## 2. Endpoint Map

| Domain | Method and path | Purpose |
| --- | --- | --- |
| Auth | `POST /auth/register` | Register member, owner, staff invite, or admin-created user |
| Auth | `POST /auth/login` | Issue access and refresh tokens |
| Auth | `POST /auth/refresh` | Rotate refresh token |
| Auth | `POST /auth/mfa/challenge` | Create MFA challenge |
| Users | `GET /me` | Current account, roles, profile, credit summary |
| Users | `PATCH /me/profile` | Update user profile |
| Fitness | `PUT /me/fitness-profile` | Upsert fitness profile |
| Fitness | `GET /me/muscle-dashboard` | Weekly trained, due, and recent muscle groups |
| Fitness | `POST /check-ins/{id}/training-log` | Record trained muscle groups after verified visit |
| Facilities | `GET /facilities` | Search facilities with filters and geospatial options |
| Facilities | `GET /facilities/{id}` | Facility profile |
| Facilities | `POST /owner/facilities` | Create facility |
| Facilities | `PATCH /owner/facilities/{id}` | Update facility |
| Facilities | `PUT /owner/facilities/{id}/equipment` | Replace facility equipment inventory |
| Credits | `GET /credit-packages` | List purchasable packages |
| Payments | `POST /purchases` | Create purchase intent |
| Payments | `POST /payments/webhooks/{provider}` | Provider webhook |
| Check-ins | `POST /facilities/{id}/check-in-token` | Generate rotating QR token |
| Check-ins | `POST /staff/check-ins/redeem` | Staff scan and redeem QR token |
| Reviews | `POST /facilities/{id}/reviews` | Create verified-visit review |
| Reviews | `POST /reviews/{id}/flags` | Flag review for moderation |
| Rewards | `GET /me/rewards` | FitPoints, level, streaks, challenges, rewards |
| Rewards | `POST /rewards/{id}/redeem` | Redeem marketplace reward |
| Passport | `GET /me/passport` | Cities, provinces, and facilities visited |
| Notifications | `GET /notifications` | In-app notifications |
| Admin | `GET /admin/fraud-events` | Fraud queue |
| Admin | `POST /admin/businesses/{id}/approve` | Approve partner business |
| Admin | `POST /admin/payouts/{id}/approve` | Approve payout |
| Admin | `PUT /admin/settings/{key}` | Versioned platform settings |

## 3. Sample DTOs

### Facility search query

```json
{
  "q": "boxing",
  "city": "Cebu City",
  "province": "Cebu",
  "lat": 10.3157,
  "lng": 123.8854,
  "radiusKm": 8,
  "amenityIds": ["uuid"],
  "equipmentIds": ["uuid"],
  "categoryIds": ["uuid"],
  "maxCreditCost": 4,
  "openNow": true,
  "minRating": 4,
  "limit": 20,
  "cursor": "opaque"
}
```

### Standard error

```json
{
  "error": {
    "code": "CHECKIN_TOKEN_EXPIRED",
    "message": "This check-in QR code has expired. Please refresh and try again.",
    "details": { "retryable": true },
    "traceId": "01JTRACE"
  }
}
```

## 4. Rate Limits

- Anonymous auth endpoints: strict IP and device limits.
- Token generation: per member, per device, per facility, and per geofence confidence.
- Staff redemption: per staff account, device, facility, and business.
- Webhooks: signature validation plus provider-specific replay windows.
