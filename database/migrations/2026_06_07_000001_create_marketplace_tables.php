<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('legal_name');
            $table->string('trade_name');
            $table->string('status')->default('pending')->index();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('facility_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('status')->default('draft')->index();
            $table->string('address_line');
            $table->string('city')->index();
            $table->string('province')->index();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->unsignedInteger('credit_cost')->default(1);
            $table->unsignedInteger('capacity')->nullable();
            $table->json('operating_hours')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('facility_facility_category', function (Blueprint $table) {
            $table->foreignId('facility_id')->constrained()->cascadeOnDelete();
            $table->foreignId('facility_category_id')->constrained()->cascadeOnDelete();
            $table->primary(['facility_id', 'facility_category_id'], 'facility_category_facility_pk');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facility_facility_category');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('facility_categories');
        Schema::dropIfExists('businesses');
    }
};
