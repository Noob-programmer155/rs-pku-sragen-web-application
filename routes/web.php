<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\{HomeController,AppointmentController,
  AboutusController,ProjectsController,DoctorController,BlogController};
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


Route::group(['middleware' => ['web']],function (){
  Route::get('/',[HomeController::class,'home']);

  Route::get('/login',[HomeController::class,'login']);
  Route::post('/login',[HomeController::class,'login_post']);

  Route::get('/lost/password',[HomeController::class,'login']);
  // Route::get('/lost-password',[HomeController::class,'login']);

  Route::get('/signup',[HomeController::class,'signIn']);
  Route::post('/post/signup',[HomeController::class,'signIn_post']);

  Route::get('/service/{name}',[ServiceController::class,'getService']);

  Route::get('/services',[ServiceController::class,'getAllService']);

  Route::get('/departments',[DepartmentController::class,'getAllDepartment']);

  Route::get('/department/{name}',[DepartmentController::class,'getDepartment']);

  Route::get('/project/{name}',[ProjectsController::class,'getProject']);

  Route::get('/projects',[ProjectsController::class,'getAllProject']);

  Route::get('/doctors',[DoctorController::class,'getDoctorAll']);

  Route::get('/doctor/{name}',[DoctorController::class,'getDoctor']);

  Route::get('/about',[AboutusController::class,'aboutUs']);

  Route::get('/blogs',[BlogController::class,'getBlogAll']);
  Route::get('/blog/item/{startDate}/{endDate}',[BlogController::class,'getDataBlog']);
  Route::get('/search/item',[BlogController::class,'getBlogInAll']);
  Route::get('/sugestion/search',[BlogController::class,'getItemDynamic']);

  Route::get('/blog/{name}',[BlogController::class,'getBlog']);
  Route::get('/blog/comments/{id}',[BlogController::class,'getBlogComments']);
  Route::post('/blog/comments/post',[BlogController::class,'postBlogComment']);

  Route::get('/contact',[HomeController::class,'ContactUs']);

  Route::get('/table-workhours',[DoctorController::class,'doctorsTableWorking']);

  Route::get('/appointment',[HomeController::class,'appointmentView']);
});
