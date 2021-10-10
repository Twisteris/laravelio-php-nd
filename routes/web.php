<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//verivication
//Auth::routes(['verify' =>true]);

//home
Route::get("/", [HomeController::class, "index"])->name("home");
//apie
Route::get("/apie", function (){
    return view("apie");
})->name("apie");
//POSTS
Route::get("/posts", [PostsController::class, "index"])->name("posts");
Route::post("/posts", [PostsController::class, "store"])->name("posts");
//SPECIFIC POST
Route::get("/post/{post}", [PostController::class, "index"])->name("post");
Route::post("/post/{post}", [PostController::class, "store"])->name("post.create");
Route::delete("/post/{post}", [PostController::class, "destroy"])->name("post.destroy");
Route::get("/post/edit/{post}", [PostController::class, "updateView"])->name("post.update");
Route::patch("/post/edit/{post}", [PostController::class, "update"])->name("post.update");
Route::delete("/post/{guest}/{post}", [PostController::class, "removeGuest"])->name("post.destroy.guest");
//auth
Route::get('/verify', [RegisterController::class, "verifyUser"])->name('verify.user');

Route::get("/login", [LoginController::class, "index"])->name("login");
Route::post("/login", [LoginController::class, "store"]);

Route::get("/register", [RegisterController::class, "index"])->name("register");
Route::post("/register", [RegisterController::class, "store"]);

Route::post("/logout", [LogoutController::class, "store"])->name("logout");


