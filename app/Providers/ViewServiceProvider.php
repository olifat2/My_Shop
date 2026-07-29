<?php

namespace App\Providers;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $newOrdersCount = Commande::whereHas('statut', function ($query) {
            $query->where('nom', 'en_attente');
        })->count();

        // Nouveaux clients (par exemple créés dans les derniers 7 jours)
        $newClientsCount = User::where('role', 'client')
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        // Partage global
        View::share([
            'newOrdersCount' => $newOrdersCount,
            'newClientsCount' => $newClientsCount,
        ]);
    }
}
