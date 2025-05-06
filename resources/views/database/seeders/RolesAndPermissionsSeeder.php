<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define standard resources and actions
        $resources = [
            'application',
            'program',
            'comment',
            'document',
            'education',
            'experience',
        ];

        $actions = ['add', 'edit', 'delete', 'view'];

        // Start with extra permissions
        $permissions = [
            'accept application',
            'reject application',
            'update profile',
        ];

        // Generate CRUD permissions dynamically
        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                $permissions[] = "$action $resource";
            }
        }

        // Create all permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // Define roles and their specific permissions
        $roles = [
            'admin' => [
                'view application',
                'accept application',
                'reject application',
                'add program',
                'edit program',
                'view program',
                'delete program',
                'add comment',
                'edit comment',
                'delete comment',
                'view comment',
            ],
            'user' => [
                'update profile',
                'add application',
                'edit application',
                'delete application',
                'view application',
                'add document',
                'edit document',
                'delete document',
                'view document',
                'add education',
                'edit education',
                'delete education',
                'view education',
                'add experience',
                'edit experience',
                'delete experience',
                'view experience',
                'view comment',
            ],
        ];

        // Create roles and assign permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($rolePermissions);
        }
    }
}