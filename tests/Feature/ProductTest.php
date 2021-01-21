<?php

namespace Tests\Feature;

use App\Models\Product;

class ProductTest extends LoginTest
{

    /**
     * Test get products
     *
     * @return void
     */
    public function testGetProducts()
    {
        $tokenContent = $this->testLogin();

        $this->getJson('/v1/products', [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])->assertJsonStructure([
            'current_page',
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total',
            'data' => ['*' => [
                'name',
                'type_id',
                'value',
                'created_at',
                'updated_at'
            ]]
        ])->assertStatus(200);
    }

    /**
     * Test Create product
     *
     * @return void
     */
    public function testCreateProduct()
    {
        $tokenContent = $this->testLogin();

        $this->postJson('/v1/products', [], [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "name",
                    "type_id",
                    "value"
                ]
            ]);

        $product = Product::factory()->make();

        $this->postJson('/v1/products', $product->toArray(), [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(200)
            ->assertSee($product->toArray());
    }

    /**
     * Test Create product
     *
     * @return void
     */
    public function testUpdateProduct()
    {
        $tokenContent = $this->testLogin();

        $product = Product::factory()->create();

        $this->putJson('/v1/products/' . $product->id, [], [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "name",
                    "type_id",
                    "value"
                ]
            ]);

        $this->putJson('/v1/products/' . $product->id, $product->toArray(), [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(200)
            ->assertSee($product->toArray());
    }

    /**
     * Test show product
     *
     * @return void
     */
    public function testShowProduct()
    {
        $tokenContent = $this->testLogin();

        $product = Product::factory()->create();

        $this->getJson('/v1/products/' . $product->id, [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                "name",
                "type_id",
                "value",
                'created_at',
                'updated_at'
            ]);
    }

    /**
     * Test delete product
     *
     * @return void
     */
    public function testDeleteProduct()
    {
        $tokenContent = $this->testLogin();

        $product = Product::factory()->create();

        $this->deleteJson('/v1/products/' . $product->id, [], [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(200);
    }
}
