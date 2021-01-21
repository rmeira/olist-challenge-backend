<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SwaggerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSwaggerRedirectTest()
    {
        $response = $this->get('/');

        $response->assertStatus(301)
            ->assertLocation('/swagger');;
    }
}
