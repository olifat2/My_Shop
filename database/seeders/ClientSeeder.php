<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $client = User::updateOrCreate(
            ['email' => 'client@example.com'],
            [
                'firstname' => 'Client',
                'lastname' => 'Demo',
                'password' => 'password',
                'role' => 'client',
            ]
        );

        $client->client()->firstOrCreate([]);
    }
}
