<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin=User::create([
            'name'=>'Admin',
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('password'),
            'phone'=>'09964588778',
            'address'=>'Mandalay',
            'gender'=>0,
            'is_active'=>0,

        ]);
        // Fetch the 'admin' role from the database
        $adminRole = Role::where('name', 'admin')->first();

        // Check if the role exists
        if ($adminRole) {
            // Sync the admin role to the user
            $admin->syncRoles([$adminRole->id]);
        }

        $admin->givePermissionTo('create user','view user','edit user','delete user','view role','create role','edit role','delete role');

    }
}
