<?php

namespace Tests\Feature;

use App\Models\Type;

class TypeTest extends LoginTest
{

    /**
     * Test get types
     *
     * @return void
     */
    public function testGetTypes()
    {
        $tokenContent = $this->testLogin();

        $this->getJson('/v1/types', [
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
    public function testCreateType()
    {
        $tokenContent = $this->testLogin();

        $this->postJson('/v1/types', [], [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "name"
                ]
            ]);

        $product = Type::factory()->make();

        $this->postJson('/v1/types', $product->toArray(), [
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
    public function testUpdateType()
    {
        $tokenContent = $this->testLogin();

        $product = Type::factory()->create();

        $this->putJson('/v1/types/' . $product->id, [], [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "name"
                ]
            ]);

        $this->putJson('/v1/types/' . $product->id, $product->toArray(), [
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
    public function testShowType()
    {
        $tokenContent = $this->testLogin();

        $product = Type::factory()->create();

        $this->getJson('/v1/types/' . $product->id, [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                "name",
                'created_at',
                'updated_at'
            ]);
    }

    /**
     * Test delete product
     *
     * @return void
     */
    public function testDeleteType()
    {
        $tokenContent = $this->testLogin();

        $product = Type::factory()->create();

        $this->deleteJson('/v1/types/' . $product->id, [], [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(200);
    }
}
