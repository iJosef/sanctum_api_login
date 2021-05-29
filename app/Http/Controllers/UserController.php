<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Responder;
use Transformation;

class UserController extends Controller
{
    // public function register(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|string|unique:users,email',
    //         'password' => 'required|string|confirmed'
    //     ]);

    //     $user = User::create([
    //         'name'  => $validated['name'],
    //         'email' => $validated['email'],
    //         'password' => bcrypt($validated['password'])
    //     ]);

    //     $token = $user->createToken('apitoken')->plainTextToken;

    //     $response = [
    //         'user' => $user,
    //         'token' => $token
    //     ];

    //     return response($response, 201);
    // }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response([
                'message' => 'Error trying to login'
            ], 401);
        }

        $token = $user->createToken('apitoken')->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token
        ];

        // return response($response, 200);

        return Responder::success($data)->respond();
    }

    // public function logout(Request $request)
    // {
    //     $request->user()->tokens()->delete();

    //     return [
    //         'message' => 'logged out successfully'
    //     ];
    // }
}
