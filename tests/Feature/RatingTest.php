<?php

namespace Tests\Feature;

use App\User;
use App\Book;
use App\Rating;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class RatingTest extends TestCase
{
	use RefreshDatabase;

	protected $user;

    /**
    * Create user and get token
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

}
