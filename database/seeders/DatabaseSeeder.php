<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\CreditPackage;
use App\Models\Facility;
use App\Models\FacilityCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@roamfit.test'],
            ['name' => 'RoamFit Admin', 'password' => Hash::make('password'), 'role' => 'admin', 'status' => 'active']
        );

        $owner = User::firstOrCreate(
            ['email' => 'owner@roamfit.test'],
            ['name' => 'Demo Gym Owner', 'password' => Hash::make('password'), 'role' => 'business_owner', 'status' => 'active']
        );

        $category = FacilityCategory::firstOrCreate(
            ['slug' => 'commercial-gym'],
            ['name' => 'Commercial Gym', 'description' => 'General fitness and strength training facility.', 'is_active' => true]
        );

        $business = Business::firstOrCreate(
            ['trade_name' => 'Demo Fitness Manila'],
            ['owner_id' => $owner->id, 'legal_name' => 'Demo Fitness Manila Inc.', 'status' => 'approved']
        );

        $facility = Facility::firstOrCreate(
            ['slug' => 'demo-fitness-manila'],
            [
                'business_id' => $business->id,
                'name' => 'Demo Fitness Manila',
                'description' => 'Seed facility for RoamFit MVP development.',
                'status' => 'active',
                'address_line' => '123 Sample Street',
                'city' => 'Makati',
                'province' => 'Metro Manila',
                'credit_cost' => 3,
                'capacity' => 50,
            ]
        );
        $facility->categories()->syncWithoutDetaching([$category->id]);

        CreditPackage::firstOrCreate(
            ['name' => 'Starter 30'],
            ['description' => 'MVP starter package.', 'price_cents' => 150000, 'currency' => 'PHP', 'credits' => 30, 'validity_days' => 60, 'is_active' => true]
        );
    }
}
