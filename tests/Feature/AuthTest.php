<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     * Test registration
     */

     public function testRegister()
     {
        //User's data
        $user = [
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => 'secret1234'
        ];

        //Send post request
        $response = $this->post('/api/register', $user);

        //Assert it was successful
        $response->assertStatus(200);

        //Assert we received a token
        $this->assertArrayHasKey('access_token', $response->json());
     }
}
