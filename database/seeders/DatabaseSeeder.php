<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // Create an Admin
    User::updateOrCreate(
        ['email' => 'admin@admin.com'],
        [
            'name' => 'Admin User',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]
    );

    // Create a Staff user
    User::updateOrCreate(
        ['email' => 'staff@hospital.com'],
        [
            'name' => 'Staff Member',
            'role' => 'staff',
            'password' => Hash::make('staff123'),
        ]
    );
}



}
