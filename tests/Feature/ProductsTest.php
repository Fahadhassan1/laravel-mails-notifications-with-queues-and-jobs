<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_products_index(): void
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(200);

    }

    public function test_products_create(): void
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->get('/products/create');

        $response->assertStatus(200);
        $response->assertSee('Create Product');
    }

    public function test_products_store(): void
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->post('/products', [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 100,
            'stock' => 10,
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 100,
            'stock' => 10,
        ]);
    }

    public function test_products_edit(): void
    {
        $user = \App\Models\User::factory()->create();
        $product = \App\Models\Products::factory()->create();

        $response = $this->actingAs($user)->get('/products/' . $product->id . '/edit');

        $response->assertStatus(200);
        $response->assertSee('Edit Product');
    }


    public function test_products_update(): void
    {
        $user = \App\Models\User::factory()->create();
        $product = \App\Models\Products::factory()->create();

        $response = $this->actingAs($user)->put('/products/' . $product->id, [
            'name' => 'Updated Product',
            'description' => 'Updated Description',
            'price' => 150,
            'stock' => 20,
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Updated Product',
            'description' => 'Updated Description',
            'price' => 150,
            'stock' => 20,
        ]);
    }
    public function test_products_destroy(): void
    {
        $user = \App\Models\User::factory()->create();
        $product = \App\Models\Products::factory()->create();

        $response = $this->actingAs($user)->delete('/products/' . $product->id);

        $response->assertRedirect('/products');
       
    }

}
