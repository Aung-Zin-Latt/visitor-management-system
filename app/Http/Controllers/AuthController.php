<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($request->password);

        $find_user = User::where('email', $request->email)->first();
        if ($find_user) {
            return response()->json('Email is already exist');
        }
        $user = User::create($validatedData);

        $registered_data = new UserResource($user);

        return response()->json([
            'data' => $registered_data,
            'message' => 'Successfully Registered',
        ], 200);
    }

    public function login(Request $request)
    {
        $credential = $request->only(['email', 'password']);
        if (!auth()->attempt($credential)) {
            return response()->json(['User name and password does not match.'], 401);
        }

        $user = User::find(auth()->user()->id);
        $token = $user->createToken('vms')->plainTextToken;
        return response()->json([
            'token' => $token,
            'message' => 'Login successfully'
        ], 200);
    }
}
