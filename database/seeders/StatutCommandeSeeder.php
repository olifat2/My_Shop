<?php

namespace Database\Seeders;

use App\Models\StatutCommande;
use Illuminate\Database\Seeder;

class StatutCommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach (['en_attente', 'payee', 'annulee', 'livree'] as $statut) {
            StatutCommande::firstOrCreate(['nom' => $statut]);
        }
    }
}
