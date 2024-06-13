<?php

use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\InvoiceController;
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

Route::get('/dashboard/user', function () {
    return view('Dashboard.User.dashboard');
})->middleware(['auth'])->name('dashboard.user');

############################################ End Profile #################################################

Route::get('/Profile', [UserController::class, 'profile'])->middleware(['auth', 'verified'])->name('profile');
Route::post('/Profile/update', [UserController::class, 'updateProfile'])->middleware(['auth', 'verified'])->name('profile.update');

Route::get('/users', [UserController::class, 'showUsers'])->middleware(['auth', 'verified'])->name('users.index');
Route::post('/users/update', [UserController::class, 'updateUser'])->middleware(['auth', 'verified'])->name('users.update');

############################################ End Profile #################################################

############################## Start Invoices #####################################


Route::get('/invoices', [InvoiceController::class, 'index'])->middleware(['auth', 'verified'])->name('invoices.index');
Route::get('/invoices/add', [InvoiceController::class, 'add'])->middleware(['auth', 'verified'])->name('invoices.add');
Route::get('/invoices/create', [InvoiceController::class, 'create'])->middleware(['auth', 'verified'])->name('invoices.create');
Route::get('/invoices/{id}/edit', [InvoiceController::class, 'edit'])->middleware(['auth', 'verified'])->name('invoices.edit');
Route::post('/invoices/store', [InvoiceController::class, 'store'])->middleware(['auth', 'verified'])->name('invoices.store');
Route::post('/invoices/update', [InvoiceController::class, 'update'])->middleware(['auth', 'verified'])->name('invoices.update');
Route::post('/invoices/destroy', [InvoiceController::class, 'destroy'])->middleware(['auth', 'verified'])->name('invoices.destroy');

Route::get('Print_invoice/{id}', [InvoiceController::class, 'Print_invoice']);

############################## End Invoices #####################################

############################## Start Archive #####################################

Route::resource('Archive', InvoiceArchiveController::class);

############################## End Archive #####################################

require __DIR__ . '/auth.php';
