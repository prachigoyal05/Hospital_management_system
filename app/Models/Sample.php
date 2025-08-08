<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_id',
        'sample_type',
        'test_type',
        'collection_date',
        'submission_date',
        'status',
        'collected_by',
        'results',
    ];

    protected $dates = ['collected_date', 'submission_date', 'created_at', 'updated_at'];

    public function collector()
    {
        return $this->belongsTo(User::class, 'collected_by');
    }

    // Optional: if 'test_type' should relate to another table
    public function testTypeRelation()
    {
        return $this->belongsTo(TestType::class, 'test_type');
    }
    protected $primaryKey = 'sample_id';
public $incrementing = true;
public function patient()
{
    return $this->belongsTo(\App\Models\Patient::class);
}
}
