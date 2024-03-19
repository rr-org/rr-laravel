<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\CloudController

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
Route::get('admin', [AdminController::class, 'index']);
Route::post('admin', [AdminController::class, 'register']);
Route::post('admin/login', [AdminController::class, 'login']);
Route::delete('admin/logout', [AdminController::class, 'logout']);

// Avatar
Route::get('avatar', [AvatarController::class, 'index']);
Route::post('avatar', [AvatarController::class, 'create']);
Route::patch('avatar/{id}', [AvatarController::class, 'update']);
Route::delete('avatar/{id}', [AvatarController::class, 'destroy']);

// Quiz
Route::get('quiz', [QuizController::class, 'index']);
Route::post('quiz', [QuizController::class, 'store']);
Route::patch('quiz/{id}', [QuizController::class, 'update']);
Route::delete('quiz/{id}', [QuizController::class, 'destroy']);

// User
Route::post('register', [UserController::class, 'register']);
Route::delete('logout', [UserController::class, 'logout']);
Route::patch('user/first', [UserController::class, 'updateFirst']);
Route::patch('user/avatar/{id}', [UserController::class, 'editAvatar']);
Route::patch('user/score/{id}', [UserController::class, 'editScore']);
Route::patch('user/reset/{id}', [UserController::class, 'resetScore']);
Route::patch('user/winner/{id}', [UserController::class, 'winner']);

