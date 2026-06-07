<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = ['owner_id', 'legal_name', 'trade_name', 'status', 'contact_email', 'contact_phone'];

    public function owner() { return $this->belongsTo(User::class, 'owner_id'); }
    public function facilities() { return $this->hasMany(Facility::class); }
}
