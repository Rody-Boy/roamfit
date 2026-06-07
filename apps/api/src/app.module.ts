import { Module } from '@nestjs/common';
import { AuthModule } from './auth/auth.module';
import { CheckInsModule } from './checkins/checkins.module';
import { FacilitiesModule } from './facilities/facilities.module';
import { PaymentsModule } from './payments/payments.module';
import { RewardsModule } from './rewards/rewards.module';
import { UsersModule } from './users/users.module';

@Module({
  imports: [AuthModule, UsersModule, FacilitiesModule, PaymentsModule, CheckInsModule, RewardsModule],
})
export class AppModule {}
