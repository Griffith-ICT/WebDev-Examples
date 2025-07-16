<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Manufacturer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_products()
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('products.index');
        $response->assertViewHas('products', function ($viewProducts) use ($products) {
            return $viewProducts->count() === $products->count();
        });
    }

    public function test_show_displays_product_details()
    {
        $product = Product::factory()->create();

        $response = $this->get("/product/{$product->id}");

        $response->assertStatus(200);
        $response->assertViewIs('products.show');
        $response->assertViewHas('product', $product);
    }

    public function test_create_form_requires_authentication()
    {
        $response = $this->get('/product/create');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_create_form()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/product/create');

        $response->assertStatus(200);
        $response->assertViewIs('products.create_form');
        $response->assertViewHas('manufacturers');
    }

    public function test_guest_cannot_store_product()
    {
        $manufacturer = Manufacturer::factory()->create();

        $response = $this->post('/product', [
            'name' => 'Unauthorized Product',
            'price' => 100,
            'manufacturer' => $manufacturer->id,
        ]);

        $response->assertRedirect('/login');
    }

    public function test_store_validates_and_creates_product()
    {
        $user = User::factory()->create();
        $manufacturer = Manufacturer::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/product', [
            'name' => 'Test Product',
            'price' => 99.99,
            'manufacturer' => $manufacturer->id,
        ]);

        $response->assertRedirectContains('/product/');
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 99.99,
            'manufacturer_id' => $manufacturer->id,
        ]);
    }

    public function test_guest_cannot_access_edit_form()
    {
        $product = Product::factory()->create();

        $response = $this->get("/product/{$product->id}/edit");
        $response->assertRedirect('/login');
    }


    public function test_edit_form_displays_correct_data()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user);

        $response = $this->get("/product/{$product->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('products.edit_form');
        $response->assertViewHas('product', $product);
        $response->assertViewHas('manufacturers');
    }

    public function test_guest_cannot_update_product()
    {
        $product = Product::factory()->create();
        $manufacturer = Manufacturer::factory()->create();

        $response = $this->patch("/product/{$product->id}", [
            'name' => 'Hacked Name',
            'price' => 999,
            'manufacturer' => $manufacturer->id,
        ]);

        $response->assertRedirect('/login');
    }

    public function test_update_modifies_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $manufacturer = Manufacturer::factory()->create();

        $this->actingAs($user);

        $response = $this->patch("/product/{$product->id}", [
            'name' => 'Updated Name',
            'price' => 150.00,
            'manufacturer' => $manufacturer->id,
        ]);

        $response->assertRedirect("/product/{$product->id}");
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Name',
            'price' => 150.00,
            'manufacturer_id' => $manufacturer->id,
        ]);
    }

    public function test_guest_cannot_delete_product()
    {
        $product = Product::factory()->create();

        $response = $this->delete("/product/{$product->id}");

        $response->assertRedirect('/login');
    }

    public function test_destroy_deletes_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user);

        $response = $this->delete("/product/{$product->id}");

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

}
