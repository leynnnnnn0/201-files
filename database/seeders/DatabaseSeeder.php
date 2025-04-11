<?php

namespace Database\Seeders;

use App\Models\Designation;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Position::create([
            'name' => 'Teacher'
        ]);

        Designation::create([
            'name' => 'Master Teacher I'
        ]);

        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
        ]);

        Employee::factory()->create([
            'id_number' => '1234',
            'position' => 'test',
            'office_colleges' => 'test',
            'employment_classification' => 'teaching',
            'status' => 'casual',
            'sex' => 'male',
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'phone_number' => '0926688728',
            'address' => 'here'
        ]);
    }
}
