import { Injectable } from '@nestjs/common';

@Injectable()
export class AuthService {
  health() {
    return { domain: 'auth', status: 'ready' };
  }
}
