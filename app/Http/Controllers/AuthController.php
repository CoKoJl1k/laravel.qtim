<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    private UserService $newsService;

    public function __construct(UserService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $errors = $this->newsService->validateLogin($request);
        if(!empty($errors['message'])) {
            return response()->json(['status' => 'fail', 'message' => $errors['message']]);
        }

        $input = $request->only('email', 'password');
        $token = Auth::attempt($input);
        if (empty($token)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $errors = $this->newsService->validateRegister($request);
        if(!empty($errors['message'])) {
            return response()->json(['status' => 'fail', 'message' => $errors['message']]);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
