<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Trait\HttpResponses;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return $this->error('', 'Invalid credentials', 401);
        }

        $user = User::where('email', $credentials['email'])->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken("Token of " . $user->name)->plainTextToken
        ]);
    }

    public function register(RegisterUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return $this->success([
            "user" => $user,
            "token" => $user->createToken("Token of " . $user->name)->plainTextToken
        ], "Registered!", 200);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success('', 'User logged out successfully');
    }
}
