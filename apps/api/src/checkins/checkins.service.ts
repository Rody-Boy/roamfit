import { Injectable } from '@nestjs/common';

@Injectable()
export class CheckInsService {
  health() {
    return { domain: 'check-ins', status: 'ready' };
  }

  getValidationPolicy() {
    return {
      tokenTtlSeconds: Number(process.env.QR_TOKEN_TTL_SECONDS ?? 45),
      controls: ['credit_balance', 'geofence', 'device_trust', 'staff_assignment', 'nonce_replay', 'facility_status'],
    };
  }
}
