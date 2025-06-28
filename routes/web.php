<?php
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landingcontroller;
use App\Http\Controllers\BootcampController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ActivityController;

Route::get('login',[landingcontroller::class,'login'])->name('landing.login');
Route::post('/login/authenticate', [landingcontroller::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
Route::resource('/',landingcontroller::class);
Route::get('home', [DashboardController::class, 'home'])->name('home');
Route::post('/login', [landingcontroller::class, 'authenticate'])->name('login.authenticate');
Route::get('/bootcamp', [BootcampController::class, 'index'])->name('bootcamp.index');
Route::get('/bootcamp/{bootcamp}', [BootcampController::class, 'show'])->name('bootcamp.show');
Route::get('/bootcamp/search', [BootcampController::class, 'search'])->name('bootcamp.search');
Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
Route::get('/project/search', [ProjectController::class, 'search'])->name('project.search');

//Route::get('/activities', function () {
   // return 'Halaman Projects belum tersedia';
//})->name('activities.index');
Route::get('/home_nolog', function () {
    return view('landing.home_nolog');
})->name('home.nolog');
Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'submitForm'])->name('register.submit');
Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index');

Route::delete('/activity/{id}', [ActivityController::class, 'destroy'])->name('activity.destroy');
Route::get('/ajukan/{id}', [ActivityController::class, 'ajukan'])->name('activity.ajukan');
Route::get('/activity/{id}/edit', [ActivityController::class, 'edit'])->name('activity.edit');
Route::get('/activity/data/{id}', [ActivityController::class, 'getData']);
Route::put('/activity/{id}', [ActivityController::class, 'update'])->name('activity.update');
Route::get('/activity/{id}/search', [ActivityController::class, 'search'])->name('activity.search');

Route::get('/bootcamp/detail/{id}', [BootcampController::class, 'show'])->name('bootcamp.detail');
Route::get('/project/detail/{id}', [ProjectController::class, 'show'])->name('project.detail');
?>

