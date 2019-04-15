<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Rating;
use App\Http\Resources\RatingResource;
use Validator;

class RatingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request, Book $book)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

    	$rating = Rating::firstOrCreate(
    		[
    			'user_id' => $request->user()->id,
    			'book_id' => $book->id,
    		],
    		['rating' => $request->rating]
    	);

    	return new RatingResource($rating);
    }

    public function destroy(Rating $ratings)
    {
        $user_id = auth()->id();
        if ($user_id !== $ratings->user_id) {
            return response()->json(['error' => 'You can only delete your own ratings.'], 403);
        }

        $ratings->delete();

        return response()->json('Deleted Successfully', 200);
    }
}
