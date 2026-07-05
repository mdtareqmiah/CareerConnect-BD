<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'System Administrator',
                'status' => true,
            ],
            [
                'name' => 'Employer',
                'slug' => 'employer',
                'description' => 'Company Account',
                'status' => true,
            ],
            [
                'name' => 'Job Seeker',
                'slug' => 'job_seeker',
                'description' => 'Candidate Account',
                'status' => true,
            ],
        ]);
    }
}