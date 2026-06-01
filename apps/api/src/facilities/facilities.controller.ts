import { Controller, Get } from '@nestjs/common';
import { ApiTags } from '@nestjs/swagger';
import { FacilitiesService } from './facilities.service';

@ApiTags('facilities')
@Controller('facilities')
export class FacilitiesController {
  constructor(private readonly service: FacilitiesService) {}

  @Get('health')
  health() {
    return this.service.health();
  }
}
