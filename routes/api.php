<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuizController;

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

Route::get('/', [AdminController::class, 'index']);
Route::post('admin', [AdminController::class, 'register']);
Route::post('admin/login', [AdminController::class, 'login']);

Route::get('quiz', [QuizController::class, 'index']);
Route::post('quiz', [QuizController::class, 'store']);
Route::patch('quiz/{id}', [QuizController::class, 'update']);
Route::delete('quiz/{id}', [QuizController::class, 'destroy']);