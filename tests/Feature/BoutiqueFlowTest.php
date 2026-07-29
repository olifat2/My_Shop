<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Effets;
use App\Models\Nature_Actions;
use App\Models\Product;
use App\Models\Produit_Capillaire;
use App\Models\StatutCommande;
use App\Models\Stock;
use App\Models\Technique_Pose;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoutiqueFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_registration_creates_a_client_account(): void
    {
        $response = $this->post('/register', [
            'firstname' => 'Awa',
            'lastname' => 'Demo',
            'email' => 'awa@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'admin',
        ]);

        $response->assertRedirect(route('client.accueil', absolute: false));

        $user = User::where('email', 'awa@example.com')->firstOrFail();

        $this->assertSame('client', $user->role);
        $this->assertDatabaseHas('clients', ['user_id' => $user->id]);
        $this->assertDatabaseMissing('admins', ['user_id' => $user->id]);
    }

    public function test_admin_can_create_a_product_with_initial_stock(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $admin->admin()->create();

        $technique = Technique_Pose::create(['nom' => 'Tresse']);

        $response = $this->actingAs($admin)->post(route('admin.products.store'), [
            'categorie' => 'meche_extension',
            'poids' => 1.2,
            'prix_unitaire' => 15000,
            'quantite' => 12,
            'nature' => 'Naturelle',
            'marque' => 'Demo Hair',
            'style' => 'Boucle',
            'height' => 18,
            'pcs' => '3',
            'technique_pose_id' => $technique->id,
        ]);

        $response->assertRedirect(route('admin.products.create', absolute: false));

        $product = Product::firstOrFail();

        $this->assertDatabaseHas('meche_extensions', [
            'product_id' => $product->id,
            'style' => 'BOUCLE',
        ]);
        $this->assertDatabaseHas('stocks', [
            'product_id' => $product->id,
            'quantite' => 12,
        ]);
        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'user_id' => $admin->id,
            'type' => 'initial',
            'quantity_change' => 12,
            'before_quantity' => 0,
            'after_quantity' => 12,
        ]);
    }

    public function test_client_order_decrements_product_stock(): void
    {
        StatutCommande::create(['nom' => 'en_attente']);

        $clientUser = User::factory()->create(['role' => 'client']);
        Client::create(['user_id' => $clientUser->id]);

        $effet = Effets::create(['nom' => 'Hydratant']);
        $nature = Nature_Actions::create(['nom' => 'Soin']);

        $product = Product::create([
            'categorie' => 'produit_capillaire',
            'poids' => 0.5,
            'prix_unitaire' => 5000,
        ]);

        Produit_Capillaire::create([
            'product_id' => $product->id,
            'nom' => 'Huile demo',
            'volume' => 250,
            'effet_id' => $effet->id,
            'nature_action_id' => $nature->id,
        ]);

        Stock::create([
            'product_id' => $product->id,
            'quantite' => 5,
        ]);

        $response = $this
            ->actingAs($clientUser)
            ->withSession([
                'cart' => [
                    $product->id => [
                        'id' => $product->id,
                        'name' => 'Huile demo',
                        'price' => 1,
                        'qty' => 2,
                        'subtotal' => 2,
                    ],
                ],
            ])
            ->post(route('client.orders.store'));

        $response->assertRedirect();

        $this->assertDatabaseHas('commandes', [
            'client_id' => $clientUser->client->id,
            'total' => 10000,
        ]);
        $this->assertDatabaseHas('stocks', [
            'product_id' => $product->id,
            'quantite' => 3,
        ]);
        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'user_id' => $clientUser->id,
            'type' => 'sale',
            'quantity_change' => -2,
            'before_quantity' => 5,
            'after_quantity' => 3,
        ]);
    }
}
