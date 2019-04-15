<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $input = $request->all();

    $validator = Validator::make($input, [
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
    ]);

    $token = auth()->login($user);

    return $this->respondWithToken($token);
  }

  public function login(Request $request)
  {
    $credentials = $request->only(['email', 'password']);

    if (!$token = auth()->attempt($credentials)) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
  }

  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth()->factory()->getTTL() * 60
    ]);
  }
}
