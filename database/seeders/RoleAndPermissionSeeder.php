<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'show-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);

        Role::create(['name' => 'Super Admin']);
        $adminRole = Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);

        $adminRole->givePermissionTo([
            'show-user',
            'create-user',
            'edit-user',
            'delete-user',
        ]);


        User::find(1)->assignRole('Admin');
        User::find(2)->assignRole('User');


    }
}
