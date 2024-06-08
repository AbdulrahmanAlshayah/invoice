<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/user', function () {
    return view('Dashboard.User.dashboard');
})->middleware(['auth'])->name('dashboard.user');

############################################ End Profile #################################################

Route::get('/Profile', [UserController::class, 'profile'])->middleware(['auth', 'verified'])->name('profile');
Route::post('/Profile/update', [UserController::class, 'updateProfile'])->middleware(['auth', 'verified'])->name('profile.update');

Route::get('/users', [UserController::class, 'showUsers'])->middleware(['auth', 'verified'])->name('users.index');
Route::post('/users/update', [UserController::class, 'updateUser'])->middleware(['auth', 'verified'])->name('users.update');

############################################ End Profile #################################################


require __DIR__ . '/auth.php';
