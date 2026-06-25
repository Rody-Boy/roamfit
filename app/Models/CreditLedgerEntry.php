<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditLedgerEntry extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'purchase_id', 'check_in_id', 'reason', 'delta', 'created_at'];
    protected function casts(): array { return ['created_at' => 'datetime']; }
    public function user() { return $this->belongsTo(User::class); }
}
