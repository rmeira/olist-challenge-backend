<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Test Required Fields for login
     *
     * @return void
     */
    public function testRequiredFieldsForLogin()
    {
        $this->postJson('/v1/auth/login', [], ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "email" => ["O campo e-mail é obrigatório.",],
                    "password" => ["O campo senha é obrigatório."],
                ]
            ]);
    }

    /**
     * Test success login
     *
     * @return object
     */
    public function testLogin()
    {
        $response = $this->postJson(
            '/v1/auth/login',
            [
                'email' => 'admin@olistchallenge.com.br',
                'password' => 'password'
            ],
            ['Accept' => 'application/json']
        )
            ->assertStatus(200)
            ->assertJsonStructure([
                "token", "token_type", "expires_in"
            ]);

        return json_decode($response->getContent());
    }
}
