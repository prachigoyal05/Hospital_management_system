<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $patients = \App\Models\Patient::factory(50)->create();
    $staff = \App\Models\User::role('staff')->get();

    $testTypes = [
        'Complete Blood Count',
        'Basic Metabolic Panel',
        'Lipid Panel',
        'Liver Panel',
        'Thyroid Stimulating Hormone',
        'Hemoglobin A1C',
        'Urinalysis',
        'Culture'
    ];

    foreach ($patients as $patient) {
        \App\Models\Sample::factory(rand(1, 5))->create([
            'patient_id' => $patient->id,
            'test_type' => $testTypes[array_rand($testTypes)],
            'collected_by' => $staff->random()->id,
            'status' => rand(0, 1) ? 'completed' : 'pending'
        ]);
    }
}
}
