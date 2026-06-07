<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckInToken extends Model
{
    protected $fillable = ['user_id', 'facility_id', 'code_hash', 'status', 'expires_at', 'redeemed_at'];
    protected function casts(): array { return ['expires_at' => 'datetime', 'redeemed_at' => 'datetime']; }
    public function user() { return $this->belongsTo(User::class); }
    public function facility() { return $this->belongsTo(Facility::class); }
}
