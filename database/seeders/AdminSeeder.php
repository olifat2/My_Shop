<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'firstname' => 'Admin',
                'lastname' => 'Demo',
                'password' => 'password',
                'role' => 'admin',
            ]
        );

        $admin->admin()->firstOrCreate([]);
    }
}
