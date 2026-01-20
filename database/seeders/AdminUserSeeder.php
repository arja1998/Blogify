<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin@123'),
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );

        $adminRole = Role::where('name', 'admin')->first();

        if ($adminRole && ! $admin->roles()->where('name', 'admin')->exists()) {
            $admin->roles()->attach($adminRole);
        }
    }
}
