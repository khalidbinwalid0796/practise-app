<?php

use App\Http\Controllers\LiberianController;
use App\Http\Controllers\PayOrderController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Edit in Authenticate, RedirectIfAuthenticated middleware
/***********
 ****auth:web-->Only authorized user can access
 ****guest:web-->Anyone can access
 ************/


Route::prefix('student')->name('student.')->group(function(){

    Route::middleware(['guest:student','PreventBackHistory'])->group(function(){
        Route::view('/register','student.register')->name('register');
        Route::post('/create',[StudentController::class,'create'])->name('create');
        Route::view('/login','student.login')->name('login');
        Route::post('/check',[StudentController::class,'check'])->name('check');
    });

    Route::middleware(['auth:student','PreventBackHistory'])->group(function(){
        Route::view('/dashboard','student.dashboard')->name('dashboard');
        Route::post('/logout',[StudentController::class,'logout'])->name('logout');
    });

});

Route::prefix('teacher')->name('teacher.')->group(function(){

    Route::middleware(['guest:teacher','PreventBackHistory'])->group(function(){
        Route::view('/login','teacher.login')->name('login');
        Route::post('/check',[TeacherController::class,'check'])->name('check');
    });

    Route::middleware(['auth:teacher','PreventBackHistory'])->group(function(){
        Route::view('/dashboard','teacher.dashboard')->name('dashboard');
        Route::post('/logout',[TeacherController::class,'logout'])->name('logout');
    });

});

Route::prefix('liberian')->name('liberian.')->group(function(){

    Route::middleware(['guest:liberian','PreventBackHistory'])->group(function(){
        Route::view('/login','liberian.login')->name('login');
        Route::post('/check',[LiberianController::class,'check'])->name('check');
    });

    Route::middleware(['auth:liberian','PreventBackHistory'])->group(function(){
        Route::view('/dashboard','liberian.dashboard')->name('dashboard');
        Route::post('logout',[LiberianController::class,'logout'])->name('logout');
    });

});

//dd(app());
Route::get('payment',[PayOrderController::class,'store']);
