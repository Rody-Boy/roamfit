import { Injectable } from '@nestjs/common';

@Injectable()
export class RewardsService {
  health() {
    return { domain: 'rewards', status: 'ready' };
  }
}
