<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['user_id', 'credit_package_id', 'status', 'amount_cents', 'currency', 'admin_notes', 'paid_at'];
    protected function casts(): array { return ['paid_at' => 'datetime']; }
    public function user() { return $this->belongsTo(User::class); }
    public function creditPackage() { return $this->belongsTo(CreditPackage::class); }
}
