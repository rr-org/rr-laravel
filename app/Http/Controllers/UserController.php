<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateAvatarUsername;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request) 
    {
        
        $data = $request->validated();

        if(User::where('email', $data['email']) -> count() == 1){
            return response([
                'message' => 'Login Success!'
            ], 200)->cookie('token', Str::uuid()->toString());
        }

        $user = new User();
        $user->email = $data['email'];
        $user->username = $data['username'] ?? null;
        $user->avatar = $data['avatar'] ?? null;
        $user->diamond = $data['diamond'] ?? null;
        $user->score = $data['score'] ?? null;
        $user->save();

        return response()->json([
            'message' => 'Register Success!'
        ], 201)->cookie('token', Str::uuid()->toString());
    }

    public function logout()
    {
        return response()->json([
            'message' => 'Logout Success!'
        ], 200)->withCookie(Cookie::forget('token'));
    }

    public function updateAvatarUsername(UserUpdateAvatarUsername $request): UserResource
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();
        $user->username = $data['username'];
        $user->avatar = $data['avatar'];
        $user->update();
        return new UserResource($user);
    }
}
