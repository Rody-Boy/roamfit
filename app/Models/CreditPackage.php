<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditPackage extends Model
{
    protected $fillable = ['name', 'description', 'price_cents', 'currency', 'credits', 'validity_days', 'is_active'];
    protected function casts(): array { return ['is_active' => 'boolean']; }
}
