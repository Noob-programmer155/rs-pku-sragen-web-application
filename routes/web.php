<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\{HomeController,AppointmentController,AboutusController};
use App\Http\Controllers\Department\Service\ServiceController;
use App\Http\Controllers\Department\DepartmentController;

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
Route::post('/login',[HomeController::class,'login_post']);

Route::get('/lost-password',[HomeController::class,'login']);
// Route::get('/lost-password',[HomeController::class,'login']);

Route::get('/signup',[HomeController::class,'signIn']);
Route::post('/signup',[HomeController::class,'signIn_post']);

Route::get('/pelayanan/{name}',[HomeController::class,'signIn']);

Route::get('/pelayanan-kami',[ServiceController::class,'getAllService']);

Route::get('/jam-kerja',[HomeController::class,'signIn']);

Route::get('/departemen-kami',[DepartmentController::class,'getAllDepartment']);

Route::get('/departemen/{name}',[DepartmentController::class,'getDepartment']);

Route::get('/proyek/{name}',[HomeController::class,'signIn']);

Route::get('/proyek-kami',[HomeController::class,'signIn']);

Route::get('/dokter-kami',[HomeController::class,'signIn']);

Route::get('/dokter/{name}',[HomeController::class,'signIn']);

Route::get('/tentang-kami',[AboutusController::class,'aboutUs']);

Route::get('/blog-kami',[HomeController::class,'signIn']);

Route::get('/blog/{name}',[HomeController::class,'signIn']);

Route::get('/kontak',[HomeController::class,'signIn']);

Route::get('/Tabel-jam-kerja',[HomeController::class,'signIn']);

Route::get('/buat-janji-temu',[AppointmentController::class,'getAppointment']);
Route::post('/get-janji-temu',[AppointmentController::class,'postAppointment']);
