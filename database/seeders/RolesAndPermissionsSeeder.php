<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear the package's cache so new permissions are picked up
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view students', 'create students', 'edit students', 'delete students',
            'view courses', 'create courses', 'edit courses', 'delete courses',
            'view registrations', 'create registrations', 'delete registrations',
            'manage users',
            'view assigned courses',
            'view own registrations',
        ];

        // firstOrCreate: running the seeder twice never makes duplicates (Q2d)
        foreach ($permissions as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        // Administrator: everything
        $admin = Role::firstOrCreate(['name' => 'administrator', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        // Lecturer: sees assigned courses and their registered students
        $lecturer = Role::firstOrCreate(['name' => 'lecturer', 'guard_name' => 'web']);
        $lecturer->syncPermissions(['view assigned courses']);

        // Student: sees available courses and their own registrations
        $student = Role::firstOrCreate(['name' => 'student', 'guard_name' => 'web']);
        $student->syncPermissions(['view courses', 'view own registrations']);
    }
}