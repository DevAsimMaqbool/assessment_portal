<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles and permissions
        $this->call(RolesAndPermissionsSeeder::class);

        // Create a super admin user
        $admin = User::factory()->create([
            'registration_number' => 'Test-298-100',
            'full_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'cnic' => '3510689641781',
            'mobile_number' => '+923068976541',
            'password' => Hash::make('Admin@123'),
        ]);

        // Assign role to the user
        $admin->assignRole('admin');
        $this->call(RolesAndPermissionsSeeder::class);
    }
}
