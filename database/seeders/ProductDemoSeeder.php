<?php

namespace Database\Seeders;

use App\Models\Effets;
use App\Models\Meche_Extension;
use App\Models\Nature_Actions;
use App\Models\Product;
use App\Models\Produit_Capillaire;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Technique_Pose;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDemoSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();

        DB::transaction(function () use ($admin) {
            $techniquePose = Technique_Pose::firstOrCreate(['nom' => 'TRESSE']);
            $effet = Effets::firstOrCreate(['nom' => 'HYDRATANT']);
            $natureAction = Nature_Actions::firstOrCreate(['nom' => 'SOIN']);

            $meche = Product::firstOrCreate(
                ['categorie' => 'meche_extension', 'prix_unitaire' => 15000],
                ['poids' => 1.20]
            );

            Meche_Extension::firstOrCreate(
                ['product_id' => $meche->id],
                [
                    'nature' => 'NATURELLE',
                    'marque' => 'DEMO HAIR',
                    'style' => 'BOUCLES',
                    'height' => 18,
                    'pcs' => '3',
                    'technique_pose_id' => $techniquePose->id,
                ]
            );

            $this->seedStock($meche, 12, $admin?->id);

            $produitCapillaire = Product::firstOrCreate(
                ['categorie' => 'produit_capillaire', 'prix_unitaire' => 5000],
                ['poids' => 0.50]
            );

            Produit_Capillaire::firstOrCreate(
                ['product_id' => $produitCapillaire->id],
                [
                    'nom' => 'HUILE DEMO',
                    'volume' => 250,
                    'effet_id' => $effet->id,
                    'nature_action_id' => $natureAction->id,
                ]
            );

            $this->seedStock($produitCapillaire, 8, $admin?->id);
        });
    }

    private function seedStock(Product $product, int $quantity, ?int $adminId): void
    {
        Stock::updateOrCreate(
            ['product_id' => $product->id],
            ['quantite' => $quantity]
        );

        StockMovement::firstOrCreate(
            [
                'product_id' => $product->id,
                'type' => 'initial',
            ],
            [
                'user_id' => $adminId,
                'quantity_change' => $quantity,
                'before_quantity' => 0,
                'after_quantity' => $quantity,
                'note' => 'Stock initial de démonstration',
            ]
        );
    }
}
