import { Injectable } from '@nestjs/common';

@Injectable()
export class FacilitiesService {
  health() {
    return { domain: 'facilities', status: 'ready' };
  }
}
