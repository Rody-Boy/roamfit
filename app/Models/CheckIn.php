<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    protected $fillable = ['user_id', 'facility_id', 'check_in_token_id', 'staff_id', 'credits_charged', 'checked_in_at'];
    protected function casts(): array { return ['checked_in_at' => 'datetime']; }
    public function user() { return $this->belongsTo(User::class); }
    public function facility() { return $this->belongsTo(Facility::class); }
}
