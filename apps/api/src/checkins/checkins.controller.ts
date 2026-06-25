import { Controller, Get } from '@nestjs/common';
import { ApiTags } from '@nestjs/swagger';
import { CheckInsService } from './checkins.service';

@ApiTags('check-ins')
@Controller('check-ins')
export class CheckInsController {
  constructor(private readonly service: CheckInsService) {}

  @Get('health')
  health() {
    return this.service.health();
  }

  @Get('validation-policy')
  validationPolicy() {
    return this.service.getValidationPolicy();
  }
}
