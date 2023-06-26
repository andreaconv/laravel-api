<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;

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

Route::get('/', [PageController::class, 'index'])->name('home');


// FIXME: per farlo funzionare modificare nel file RouteServiceProvider.php (PATH->app\Providers\RouteServiceProvider.php) cambiare la riga 20 `public const HOME = '/admin';`

Route::middleware(['auth', 'verified'])
  ->name('admin.')
  ->prefix('admin')
  ->group( function(){
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::resource('project', ProjectController::class);
    Route::get('orderby/{direction}', [ProjectController::class, 'orderby'])->name('orderby');
    // FIXME:  la rotta del projectController punta alla tabella project al singolare??
    Route::resource('type', TypeController::class);
  });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
