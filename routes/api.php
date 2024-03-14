<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AvatarController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Admin
Route::get('/', [AdminController::class, 'index']);
Route::post('admin', [AdminController::class, 'register']);
Route::post('admin/login', [AdminController::class, 'login']);
Route::delete('admin/logout', [AdminController::class, 'logout']);

// Avatar
Route::post('avatar', [AvatarController::class, 'create']);
Route::get('avatars', [AvatarController::class, 'index']);
Route::delete('avatar/{id}', [AvatarController::class, 'destroy']);
Route::patch('avatar/{id}', [AvatarController::class, 'update']);
