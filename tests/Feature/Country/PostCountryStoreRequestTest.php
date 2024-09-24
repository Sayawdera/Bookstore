<?php

namespace Tests\Feature\Country;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostCountryStoreRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Country_Post_request(): void
    {
        $response = $this->Post('/');

        $response->assertStatus(200);
    }
}
