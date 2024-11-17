<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Membuat role
        $adminRole = Role::create(['name' => 'admin']);
        $organizerRole = Role::create(['name' => 'event organizer']);
        $userRole = Role::create(['name' => 'registered user']);

        // Membuat permission
        $permissions = [
            'manage events',
            'manage tickets',
            'manage users',
            'view reports',
            'book tickets',
            'view bookings',
            'cancel bookings'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Menetapkan permission ke role
        $adminRole->givePermissionTo(Permission::all());
        $organizerRole->givePermissionTo(['manage events', 'view bookings']);
        $userRole->givePermissionTo(['book tickets', 'view bookings', 'cancel bookings']);
    }
}

