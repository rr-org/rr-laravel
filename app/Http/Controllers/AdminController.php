<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

class AdminController extends Controller
{
   public function index()
   {
        $admins = Admin::all();
        return view('welcome', compact('admins'));
   }

    public function register(AdminRequest $request) 
    {
        $data = $request->validated();

        if(Admin::where('username', $data['username']) -> count() == 1){
            throw new HttpResponseException(response([
                "errors" => [
                    "username" => [
                        "username already registered"
                    ]
                ]
            ], 400));
        }

        $admin = new Admin($data);
        $admin->password = Hash::make($data['password']);
        $admin->save();

        return response()->json((['result' => 'success for register']), 201);
    }

    public function login(AdminLoginRequest $request)
    {
        $data = $request->validated();

        $admin = Admin::where('username', $data['username'])->first();
        if(!$admin || !Hash::check($data['password'], $admin->password)) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "username or password wrong!"
                    ]
                ]
            ], 401));
        }

        $admin->token = Str::uuid()->toString();
        $admin->save();

        return response()->json((['result' => 'success for loggin']), 201);
    }

}
