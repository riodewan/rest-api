<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\StudentController;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', [StudentController::class, 'createToken']);
Route::get('/students', [StudentController::class, 'index']);
Route::post('/students/store', [StudentController::class, 'store']);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::patch('/students/update/{id}', [StudentController::class, 'update']);
Route::delete('/students/delete/{id}', [StudentController::class, 'destroy']);

Route::get('/rentals', [RentalController::class, 'index']);
Route::post('/rentals/store', [RentalController::class, 'store']);
Route::get('/rentals/{id}', [RentalController::class, 'show']);
Route::patch('/rentals/update/{id}', [RentalController::class, 'update']);
Route::delete('/rentals/delete/{id}', [RentalController::class, 'destroy']);

Route::get('/images', [ImageController::class, 'index']);
Route::post('/images/store', [ImageController::class, 'store']);

Route::get('/albums', [AlbumController::class, 'index']);
Route::post('/albums/store', [AlbumController::class, 'store']);
