<?php

use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashoardController;

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

Route::middleware(['auth', 'verified'])
                -> prefix('admin')
                -> name('admin.')
                -> group(function(){
                    // vengon inserte tutte le rotte protette da auth
                    Route::get('/', [DashoardController::class, 'index'])->name('home');
                    // inseriamo tutte le rotte del CRUD
                    Route::resource('projects', ProjectController::class);
                    Route::resource('technologies', TechnologyController::class)->except([
                        'create', 'edit', 'show'
                    ]);
                    Route::resource('types', TypeController::class)->except([
                        'create', 'edit', 'show'
                    ]);
                    // rotte custom
                    Route::get('technology-projects', [TechnologyController::class, 'technologyProjects'])->name('technology_projects');
                    Route::get('orderBy/{direction}/{column}', [ProjectController::class, 'orderBy'])->name('orderBy');
                });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
