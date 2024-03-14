<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view companies',
            'edit companies',

            'create jobs',
            'view jobs',
            'edit jobs',
            'delete jobs',

            'view job categories',
            'create job categories',
            'edit job categories',
            'delete job categories',

            'view employee',
            'edit employee',
            'create employee',
            'delete employee',

            'view blogs',
            'create blogs',
            'edit blogs',
            'delete blogs',

            'view blog categories',
            'create blog categories',
            'edit blog categories',
            'delete blog categories',

            'view pages',
            'edit pages',

            'view job application',
            'edit job application',
        ];

        // Seed permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'manager' => ['view companies', 'view jobs', 'edit companies', 'create jobs', 'edit jobs', 'delete jobs', 'view job categories', 'create job categories', 'edit job categories', 'delete job categories', 'view employee', 'edit employee', 'create employee', 'delete employee', 'view blogs', 'create blogs', 'edit blogs', 'delete blogs', 'view blog categories', 'create blog categories', 'edit blog categories', 'delete blog categories', 'view pages', 'edit pages', 'view job application', 'edit job application'],

            'editor' => ['view companies', 'view jobs', 'view blogs', 'create blogs', 'edit blogs', 'delete blogs', 'view blog categories', 'create blog categories', 'edit blog categories', 'delete blog categories', 'view pages', 'edit pages', 'view job application', 'edit job application'],
        ];

        // Seed roles and assign permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);
            foreach ($rolePermissions as $permission) {
                $role->givePermissionTo($permission);
            }
        }

    }
}
