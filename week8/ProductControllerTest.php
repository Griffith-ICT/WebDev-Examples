<?php

namespace Tests\Feature;


use App\Models\Product;
use App\Models\Manufacturer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ProductControllerTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * Test the product index page.
     *
     * @return void
     */
    public function test_product_index_page_is_displayed(): void
    {
        Product::factory()->count(3)->create();

        $response = $this->get('/product');

        $response->assertStatus(200);
        $response->assertViewIs('products.index');
        $response->assertViewHas('products');
        $this->assertCount(3, $response->viewData('products'));
    }

    /**
     * Test the product creation page.
     *
     * @return void
     */
    public function test_product_create_page_is_displayed(): void
    {
        Manufacturer::factory()->count(2)->create();

        $response = $this->get('/product/create');

        $response->assertStatus(200);
        $response->assertViewIs('products.create_form');
        $response->assertViewHas('manufacturers');
        $this->assertCount(2, $response->viewData('manufacturers'));
    }

    /**
     * Test storing a new product.
     *
     * @return void
     */
    public function test_product_can_be_stored(): void
    {
        $manufacturer = Manufacturer::factory()->create();
        $productData = [
            'name' => 'Awesome New Gadget',
            'price' => 99.99,
            'manufacturer' => $manufacturer->id, // Note: form field is 'manufacturer'
        ];

        $response = $this->post('/product', $productData);

        $this->assertDatabaseHas('products', [
            'name' => 'Awesome New Gadget',
            'price' => 99.99,
            'manufacturer_id' => $manufacturer->id,
        ]);

        $product = Product::first(); // Get the created product
        $response->assertRedirect("/product/{$product->id}");
    }

    /**
     * Test displaying a specific product.
     *
     * @return void
     */
    public function test_product_show_page_is_displayed(): void
    {
        $product = Product::factory()->create();

        $response = $this->get("/product/{$product->id}");

        $response->assertStatus(200);
        $response->assertViewIs('products.show');
        $response->assertViewHas('product', function ($viewProduct) use ($product) {
            return $viewProduct->id === $product->id;
        });
    }

    /**
     * Test displaying product not found.
     * Note: Your current show method doesn't use findOrFail, so it might not return a 404.
     * It will pass null to the view, which might cause an error in the view or render strangely.
     * This test checks the current behavior.
     */
    public function test_product_show_page_for_non_existent_product(): void
    {
        $response = $this->get("/product/999"); // Assuming 999 doesn't exist

        // If you change your controller to use findOrFail(), this should be assertNotFound() or assertStatus(404)
        $response->assertStatus(200); // Or whatever status it currently gives
        $response->assertViewIs('products.show');
        $response->assertViewHas('product', null);
    }


    /**
     * Test the product editing page.
     *
     * @return void
     */
    public function test_product_edit_page_is_displayed(): void
    {
        $product = Product::factory()->create();
        Manufacturer::factory()->count(2)->create();

        $response = $this->get("/product/{$product->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('products.edit_form');
        $response->assertViewHas('product', function ($viewProduct) use ($product) {
            return $viewProduct->id === $product->id;
        });
        $response->assertViewHas('manufacturers');
        // +1 because the product's manufacturer is also a manufacturer
        $this->assertCount(Manufacturer::count(), $response->viewData('manufacturers'));
    }

    /**
     * Test updating an existing product.
     *
     * @return void
     */
    public function test_product_can_be_updated(): void
    {
        $product = Product::factory()->create();
        $newManufacturer = Manufacturer::factory()->create();

        $updateData = [
            'name' => 'Updated Super Gadget',
            'price' => 149.50,
            'manufacturer' => $newManufacturer->id,
        ];

        $response = $this->put("/product/{$product->id}", $updateData);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Super Gadget',
            'price' => 149.50,
            'manufacturer_id' => $newManufacturer->id,
        ]);

        $response->assertRedirect("/product/{$product->id}");
    }

    /**
     * Test deleting a product.
     *
     * @return void
     */
    public function test_product_can_be_deleted(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete("/product/{$product->id}");

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        // Or use assertSoftDeleted if using soft deletes
        // $this->assertSoftDeleted('products', ['id' => $product->id]);

        $response->assertRedirect('/product');
    }
}
