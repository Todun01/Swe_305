<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
  Route::get('/', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
  Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
  Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
  Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

  // Route::get('/register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('register');
  // Route::post('/register', 'Admin\Auth\RegisterController@register');

  Route::post('/password/email', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.request');
  Route::post('/password/reset', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'reset'])->name('password.email');
  Route::get('/password/reset', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.reset');
  Route::get('/password/reset/{token}', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'showResetForm']);

  Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'home'])->name('admin.home');

  Route::get('/category', [App\Http\Controllers\Admin\HomeController::class,'category'])->name('admin.category');
  Route::post('/addCategory', [App\Http\Controllers\Admin\HomeController::class,'addCategory'])->name('admin.addCategory');
  Route::get('/editCategory/{id}', [App\Http\Controllers\Admin\HomeController::class,'editCategory'])->name('admin.editCategory');
  Route::put('/updateCategory', [App\Http\Controllers\Admin\HomeController::class,'updateCategory'])->name('admin.updateCategory');
  Route::delete('/deleteCategory', [App\Http\Controllers\Admin\HomeController::class,'deleteCategory'])->name('admin.deleteCategory');



  Route::get('/blogspot', [App\Http\Controllers\Admin\HomeController::class,'blogspot'])->name('admin.posts');

  Route::get('/bn', [App\Http\Controllers\Admin\HomeController::class,'bn'])->name('admin.bn');
  Route::post('/addBN', [App\Http\Controllers\Admin\HomeController::class,'addBN'])->name('admin.addBN');


  Route::get('/newsletter', [App\Http\Controllers\Admin\HomeController::class,'newsletter'])->name('admin.newsletter');

  Route::get('/users', [App\Http\Controllers\Admin\HomeController::class,'users'])->name('admin.users');
  
});


Route::group(['prefix' => 'user'], function () {
  Route::get('/', [App\Http\Controllers\User\Auth\LoginController::class, 'showLoginForm'])->name('user.login');
  Route::get('/login', [App\Http\Controllers\User\Auth\LoginController::class, 'showLoginForm'])->name('login');
  Route::post('/login', [App\Http\Controllers\User\Auth\LoginController::class, 'login']);
  Route::post('/logout', [App\Http\Controllers\User\Auth\LoginController::class, 'logout'])->name('logout');

  Route::get('/register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'Admin\Auth\RegisterController@register');

  Route::post('/password/email', [App\Http\Controllers\User\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.request');
  Route::post('/password/reset', [App\Http\Controllers\User\Auth\ResetPasswordController::class, 'reset'])->name('password.email');
  Route::get('/password/reset', [App\Http\Controllers\User\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.reset');
  Route::get('/password/reset/{token}', [App\Http\Controllers\User\Auth\ResetPasswordController::class, 'showResetForm']);
});   