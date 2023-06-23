<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login', 'register','refresh']]);
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->input();
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
        $validator = Validator::make($input, $rules);

        if(!empty($validator->errors()->all())) {
            return response()->json([
                'status' => 'fail',
                'message' => $validator->errors()->all()[0]
            ]);
        }
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
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
        $input = $request->input();
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ];
        $validator = Validator::make($input, $rules);
        if(!empty($validator->errors()->all())) {
            return response()->json([
                'status' => 'fail',
                'message' => $validator->errors()->all()[0]
            ]);
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
