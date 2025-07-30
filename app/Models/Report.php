<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
     protected $fillable = [
        'patient_id',
        'lab_test_id', 
        'report_date',
        'status',
        'result',
        'file_path',
        
        'notes'
    ];

// Add this accessor to properly handle null results
public function getFormattedResultAttribute()
{
    if (empty($this->result)) {
        return null;
    }
    
    return nl2br(e($this->result));
}

    public function patient()
{
    return $this->belongsTo(Patient::class);
}

public function labTest()
{
    return $this->belongsTo(LabTest::class);
}

public function getStatusAttribute()
{
    if ($this->file_path && $this->result) {
        return 'completed';
    }
    
    if ($this->file_path) {
        return 'processing';
    }
    
    return 'pending';
}
}
