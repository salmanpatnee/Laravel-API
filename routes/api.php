<?php

use App\Http\Controllers\API\FilesController;
use App\Http\Controllers\API\ProjectsController;
use App\Http\Controllers\API\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectsController::class);
    Route::apiResource('tasks', TasksController::class)->except(['index', 'show']);
    Route::post('/upload', [FilesController::class, 'store']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $user = $request->user();
    $user->tokens()->delete();
    Auth::guard('web')->logout();
    return ['message' => 'User logout.'];
});
