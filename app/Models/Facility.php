<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
        'business_id', 'name', 'slug', 'description', 'status', 'address_line',
        'city', 'province', 'latitude', 'longitude', 'credit_cost', 'capacity',
        'operating_hours',
    ];

    protected function casts(): array
    {
        return ['operating_hours' => 'array'];
    }


    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function business() { return $this->belongsTo(Business::class); }
    public function categories() { return $this->belongsToMany(FacilityCategory::class); }
    public function checkIns() { return $this->hasMany(CheckIn::class); }
}
