<?php

namespace Tests\Feature;

use App\Models\User;

class UserTest extends LoginTest
{

    /**
     * Test get users
     *
     * @return void
     */
    public function testGetUsers()
    {
        $tokenContent = $this->testLogin();

        $this->getJson('/v1/users', [
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
                'email',
                'created_at',
                'updated_at'
            ]]
        ])->assertStatus(200);
    }

    /**
     * Test Create user
     *
     * @return void
     */
    public function testCreateUser()
    {
        $tokenContent = $this->testLogin();

        $this->postJson('/v1/users', [], [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "name",
                    "email",
                ]
            ]);

        $user = User::factory()->make();

        $this->postJson('/v1/users', $user->toArray(), [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(200)
            ->assertSee($user->toArray());
    }

    /**
     * Test Create user
     *
     * @return void
     */
    public function testUpdateUser()
    {
        $tokenContent = $this->testLogin();

        $user = User::factory()->create();

        $this->putJson('/v1/users/' . $user->id, [], [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "name",
                    "email",
                ]
            ]);

        $this->putJson('/v1/users/' . $user->id, $user->toArray(), [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(200)
            ->assertSee($user->toArray());
    }

    /**
     * Test show user
     *
     * @return void
     */
    public function testShowUser()
    {
        $tokenContent = $this->testLogin();

        $user = User::factory()->create();

        $this->getJson('/v1/users/' . $user->id, [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'name',
                'email',
                'created_at',
                'updated_at'
            ]);
    }

    /**
     * Test delete user
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $tokenContent = $this->testLogin();

        $user = User::factory()->create();

        $this->deleteJson('/v1/users/' . $user->id, [], [
            'Accept' => 'application/json',
            'Authorization' => "{$tokenContent->token_type} {$tokenContent->token}"
        ])
            ->assertStatus(200);
    }
}
