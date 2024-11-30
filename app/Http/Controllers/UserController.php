<?php

namespace App\Http\Controllers;

use App\Domain\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\LoginUserRequest;
use App\Trait\HttpResponses;

class UserController extends Controller
{
    use HttpResponses;

    public function __construct(
        private UserService $userService
    ) {
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return response()->json($users);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'id'=>'required|string',
            'nama'=>'required|string',
            // 'email'=>'required|string|email|unique:users,email',
            'password'=>'required|min:8',
            'office_id'=>'required|integer'
        ]);
        $userData = [
            'id'=>$data['id'],
            'nama'=>$data['nama'],
            'password'=>Hash::make($data['password']),
            'office_id'=>$data['office_id']
        ];
        $user = $this->userService->createUser($userData);
        if (!$user) {
            return response()->json(['message' => 'Failed to create user'], 500);
        }
        $user->id = (int)$user['id'];
        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response,201);
    }

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return $this->error('', 'Invalid credentials', 401);
        }

        $user = User::where('id', $credentials['id'])->first();

        $user->id = (int)$user['id'];
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('my-app-token')->plainTextToken
        ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success('', 'User logged out successfully');
    }


    public function show($id)
    {
        return $this->userService->getById($id);
    }

    public function update(Request $request, $id)
    {
        return $this->userService->update($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->userService->delete($id);
    }
}
