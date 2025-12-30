<?php

namespace Database\Seeders;

use App\Models\StatutCommande;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatutCommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        StatutCommande::insert([
            ['nom' => 'en_attente'],
            ['nom' => 'payee'],
            ['nom' => 'annulee'],
            ['nom' => 'livree'],
        ]);
    }
}
