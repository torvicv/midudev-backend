<?php

use App\Http\Controllers\MoviesListController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/popular', [MoviesListController::class, 'popular']);
    Route::get('/top-movies', [MoviesListController::class, 'topMovies']);
    Route::get('/upcoming', [MoviesListController::class, 'upcoming']);
});

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required',
        'password' => 'required',
        // 'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $token = $user->createToken('emulator')->plainTextToken;
    return response()->json([
        'token' => $token
    ]);
    // return $user->createToken($request->device_name)->plainTextToken;
    // return $user->createToken('emulator')->plainTextToken;
});
