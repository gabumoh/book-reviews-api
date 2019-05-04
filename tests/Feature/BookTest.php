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

    public function testAll()
    {
        //Authenticate and attach book to user
        $token = $this->authenticate();

        $book = Book::create([
            'title' => 'Narnia',
            'description' => 'Do no cite deep magic to me witch I was there when it was written'
        ]);

        $this->user->books()->save($book);

        //Call route and assert status
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->get('/api/books');
        $response->assertStatus(200);

        //Rewrite assert to check for match between created book and book in the response
    }

    public function testCreate()
    {
        //Get token
        $token = $this->authenticate();

        $book = Book::create([
            'title' => 'Narnia',
            'description' => 'Do no cite deep magic to me witch I was there when it was written'
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->post('/api/books', $book->toArray());

        //Assert success status
        $response->assertStatus(201);

        //Assert response contains book with matching title
        $this->assertEquals('Narnia', $response->json()['data']['title']);

        //Assert database has created book
        $this->assertDatabaseHas('books', ['id' => $book->id, 'title' => 'Narnia', 'description' => 'Do no cite deep magic to me witch I was there when it was written']);
    }

    public function testShow()
    {
        $token = $this->authenticate();

        $book = Book::create([
            'title' => 'Narnia',
            'description' => 'Do no cite deep magic to me witch I was there when it was written'
        ]);

        $this->user->books()->save($book);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->get('/api/books/'.$book->id);

        //Assert success status
        $response->assertStatus(200);

        //Assert response contains book with matching title
        $this->assertArrayHasKey('data', $response->json());
        $this->assertEquals('Narnia', $response->json()['data']['title']);
    }

    public function testUpdate()
    {
        $token = $this->authenticate();

        $book = Book::create([
            'title' => 'Narnia',
            'description' => 'Do no cite deep magic to me witch I was there when it was written'
        ]);

        $this->user->books()->save($book);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->put('/api/books/'.$book->id, [
            'title' => 'Updated Title',
            'description' => 'Updated Description'
        ]);

        //Assert Success status
        $response->assertStatus(200);

        //Assert Database has updated values
        $this->assertDatabaseHas('books', ['id' => $book->id, 'title' => 'Updated Title', 'description' => 'Updated Description']);
    }

    public function testDelete()
    {
        $token = $this->authenticate();

        $book = Book::create([
            'title' => 'Narnia',
            'description' => 'Do no cite deep magic to me witch I was there when it was written'
        ]);

        $this->user->books()->save($book);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->delete('/api/books/'.$book->id);

        //Assert Success status
        $response->assertStatus(200);

        //Assert Success message
        $this->assertEquals('Deleted Successfully', $response->json());
    }
}
