<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
            'position' => 'required|string|max:255',
            'url_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $nameImage=time() . '.' . $request->url_image->extension();
        $request->url_image->move(public_path('images'), $nameImage);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'position' => $request->position,
            'url_image' => $nameImage,
        ]);
        $user->save();
        return response()->json([
            'message' => 'User registered successfully',
            'user'=>$user,
    ], 200);
    }
    public function login(Request $request)
    {
        $credentials= $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Error'], 401);
        }
        $user = $request->user();
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'access_token'=>$token,
            'token_type' => 'bearer',
            'message' => 'login successfully',
            'user'=>$user,
    ], 200);
    }
    public function update(Request $request)
    {
        $user = Auth::user();
    if (!$user) {
        return response()->json([
            'message' => 'Error token',
        ], 201);
    }
    $request->validate([
        'name' => 'string|max:255',
        'email' => 'string|email|max:255|unique:users,email,' . $user->id,
        'position' => 'string|max:255',
        'url_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    $user->fill($request->all());
    if($request->urlImage!=null){
        $nameImage=time() . '.' . $request->url_image->extension();
        $request->url_image->move(public_path('images'), $nameImage);
    }
    $user->save();
    return response()->json([
        'message' => 'update successfully',
        'user' => $user,
    ], 200);
    }
    public function refresh()
    {
        $token = auth()->refresh();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }
}
