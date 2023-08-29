<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as DashboardController;
use App\Http\Controllers\Admin\PostController as PostController;
use App\Http\Controllers\Admin\TypeController as TypeController;
use App\Http\Controllers\Admin\TecnologyController as TecnologyController;

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


// middleware con autenticazione e verifica dati, 
// prefisso admin, nome rotta admin. // group funzione che contiene tutte le rotte alle quali applicare i middleware 
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // resource per definire set di rotte crud per posts.
    Route::resource('posts', PostController::class);
    Route::resource('types', TypeController::class);
    Route::resource('tecnologies', TecnologyController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
