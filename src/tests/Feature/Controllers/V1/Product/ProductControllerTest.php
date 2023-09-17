<?php

namespace Tests\Feature\Controllers\Set;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_create_product()
    {

        $data = User::factory()->make()->toArray();
        $data['password'] = 123456789;
        $user = User::create($data);


        $product = Product::factory()->make()->toArray();
        $product['user_id'] = $user->id;

        $response = $this->actingAs($user, 'sanctum')
            ->postJson(route('product.store'), $product);

        $response->assertStatus(201);
        $this->assertDatabaseCount('products', 1);
    }

    public function test_user_can_get_products_list()
    {
        $data = User::factory()->make()->toArray();
        $data['password'] = 123456789;
        $user = User::create($data);


        $product = Product::factory()->make()->toArray();

        $response = $this->getJson(route('product.index'));

        $response->assertStatus(200);
    }

    public function test_user_can_delete_product()
    {

        $data = User::factory()->make()->toArray();
        $data['password'] = 123456789;
        $user = User::create($data);

        $product = Product::factory()->make()->toArray();
        $product['user_id'] = $user->id;

        $response = $this->actingAs($user, 'sanctum')
            ->postJson(route('product.store'), $product);
        $response->assertStatus(201);
        $this->assertDatabaseCount('products', 1);

        $response = $this->actingAs($user, 'sanctum')
            ->delete(route('product.destroy', json_decode($response->content())->data->id), $product);
        $response->assertStatus(204);
    }
}
