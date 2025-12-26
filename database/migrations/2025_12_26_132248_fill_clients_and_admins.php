<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Client;
use App\Models\Admin;

return new class extends Migration {
    public function up(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            if ($user->role === 'client' && !$user->client) {
                Client::create(['user_id' => $user->id]);
            }
            if ($user->role === 'admin' && !$user->admin) {
                Admin::create(['user_id' => $user->id]);
            }
        }
    }

    public function down(): void
    {
        // Si rollback, supprime tous les clients et admins liés
        Client::truncate();
        Admin::truncate();
    }
};
