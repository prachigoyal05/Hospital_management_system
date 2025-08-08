<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
   protected $fillable = ['name', 'email', 'phone', 'dob', 'address' , 'is_active' ];

   public function reports()
{
    return $this->hasMany(Report::class);
}


public function scopeActive($query)
{
    return $query->where('is_active', true);
}
}
