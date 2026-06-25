<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'is_active', 'sort_order'];

    protected function casts(): array { return ['is_active' => 'boolean']; }
    public function facilities() { return $this->belongsToMany(Facility::class); }
}
