<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request) {
        
        $data = $request->validated();

        $user = new User();
        $user->email = $data['email'] ?? null;
        $user->username = $data['username'] ?? null;
        $user->avatar = $data['avatar'] ?? null;
        $user->diamond = $data['diamond'] ?? null;
        $user->score = $data['score'] ?? null;
        $user->save();

        return response()->json([
            'message' => 'Register Success!'
        ], 201)->cookie('token', Str::uuid()->toString());
    }
}
