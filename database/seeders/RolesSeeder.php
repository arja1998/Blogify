<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'author', 'user'] as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
