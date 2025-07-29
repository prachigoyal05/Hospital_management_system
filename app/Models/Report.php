<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
     protected $fillable = [
        'patient_id',
        'lab_test_id', 
        'report_date',
        'result',
        'file_path',
        'status',
        'notes'
    ];
    
    public function patient()
{
    return $this->belongsTo(Patient::class);
}

public function labTest()
{
    return $this->belongsTo(LabTest::class);
}

}
