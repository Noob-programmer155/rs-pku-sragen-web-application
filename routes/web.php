<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/',[HomeController::class,'home']);

Route::get('/login',[HomeController::class,'login']);
// Route::post('/login',[HomeController::class,'login_post']);

Route::get('/signup',[HomeController::class,'signIn']);

Route::get('/service/{}',[HomeController::class,'signIn']);

Route::get('/department/{}',[HomeController::class,'signIn']);

Route::get('/projects/{}',[HomeController::class,'signIn']);

Route::get('/our-doctors',[HomeController::class,'signIn']);

Route::get('/doctors/{}',[HomeController::class,'signIn']);

Route::get('/about-us',[HomeController::class,'signIn']);

Route::get('/our-blog',[HomeController::class,'signIn']);

Route::get('/blog/{}',[HomeController::class,'signIn']);

Route::get('/contact',[HomeController::class,'signIn']);

Route::get('/make-appointment',[HomeController::class,'signIn']);
