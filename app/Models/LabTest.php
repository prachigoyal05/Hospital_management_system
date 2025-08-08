<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
     protected $fillable = ['name', 'description', 'category', 'price','turnaround_time','test_requirements'];

     public function reports()
{
    return $this->hasMany(Report::class);
}
public function patient()
{
    return $this->belongsTo(Patient::class);
}

}
