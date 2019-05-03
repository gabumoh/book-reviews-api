<?php

namespace Tests\Feature;

use App\User;
use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class BookTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    /**
     * Create a user and get token
     * @return string
     */

    protected function authenticate()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => bcrypt('secret1234')
        ]);

        $this->user = $user;
        $token = JWTAuth::fromUser($user);

        return $token;
    }

    public function testCreate()
    {
        //Get token
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->post('/api/books', [
            'title' => 'Narnia',
            'description' => 'Do no cite deep magic to me witch I was there when it was written'
        ]);

        //Assert success status
        $response->assertStatus(201);
    }
}
