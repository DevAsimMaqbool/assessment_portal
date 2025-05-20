<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\Hash;
=======
>>>>>>> 855d8572a04eb69d9c41e722888f473b513001f8

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
         $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'department' => 'MIS',
            'employee_code' => '123456',
            'manager_id' => '1',
            'level'=>'Managerial',
            'status' => 'active',
            'password' => Hash::make('Admin@123'),
        ]);

        // Assign role to the user
        $admin->assignRole('admin');
         $user = User::factory()->create([
                'name' => 'User',
                'email' => 'user@gmail.com',
                'department' => 'MIS',
                'employee_code' => '123456',
                'manager_id' => '1',
                'level'=>'Managerial',
                'status' => 'active',
                'password' => Hash::make('User@123'),
            ]);

            // Assign user role
            $user->assignRole('user');
        $this->call(RolePermissionSeeder::class);
=======
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
>>>>>>> 855d8572a04eb69d9c41e722888f473b513001f8
    }
}
