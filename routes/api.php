<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\BooksController;

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

Route::get("/posts", [PostsController::class, "index"]);
Route::post('/posts/store', [PostsController::class, "store"]);
Route::get('/posts/{id?}', [PostsController::class, "show"]);
Route::post('/posts/update/{id?}', [PostsController::class, "update"]);
Route::delete('/posts/{id?}', [PostsController::class, "destroy"]);

Route::get("/post/books", [BooksController::class, "index"]);
Route::post('/post/store/books', [BooksController::class, "store"]);
Route::get('/post/books/{id?}', [BooksController::class, "show"]);
Route::post('/post/update/books/{id?}', [BooksController::class, "update"]);
Route::delete('/post/books/{id?}', [BooksController::class, "destroy"]);

// Route::get('/posts', 'PostsController@index');
// Route::post('/posts/store', 'PostsController@store');
// Route::get('/posts/{id?}', 'PostsController@show');
// Route::post('/posts/update/{id?}', 'PostsController@update');
// Route::delete('/posts/{id?}', 'PostsController@destroy');
