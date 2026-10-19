<?php

namespace Tests\Feature;

use App\Models\EcoProduct;
use Database\Seeders\EcoProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EcoProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_home_detail_and_missing_product(): void
    {
        $this->seed(EcoProductSeeder::class);
        $this->assertDatabaseCount('eco_products', 10);
        $this->get('/')->assertOk()->assertSee('BumiBaik');
        $this->get('/produk')->assertOk()->assertSee('Menampilkan 10 produk');
        $product = EcoProduct::firstOrFail();
        $this->get(route('products.show', $product))->assertOk()->assertSee($product->name)
            ->assertSee('Rp'.number_format((float) $product->price, 0, ',', '.'));
        $this->get('/produk/999999')->assertNotFound();
    }

    public function test_filters_and_empty_search_results(): void
    {
        $this->seed(EcoProductSeeder::class);
        $this->get('/produk?q=Tumbler')->assertOk()->assertSee('Tumbler Stainless')
            ->assertDontSee('Tas Belanja Kanvas');
        $this->get('/produk?q=tidak-ada-produk-ini')->assertOk()->assertSee('Produk belum ditemukan');
        $this->get('/produk?rating=5')->assertOk()->assertViewHas('products',
            fn ($products) => $products->isNotEmpty() && $products->every(fn ($p) => $p->eco_rating >= 5));
    }

    public function test_seeder_is_repeatable_and_all_images_are_local(): void
    {
        $this->seed(EcoProductSeeder::class);
        $this->seed(EcoProductSeeder::class);
        $this->assertDatabaseCount('eco_products', 10);
        foreach (EcoProduct::all() as $product) {
            $this->assertStringStartsWith('assets/images/', $product->image);
            $this->assertFileExists(public_path($product->image));
        }
    }
}
