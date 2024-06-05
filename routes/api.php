<?php

use App\Http\Controllers\Api\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LeadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/projects', [PageController::class, 'index']);
Route::get('/types', [PageController::class, 'getTypes']);
Route::get('/technologies', [PageController::class, 'getTechnologies']);
Route::get('/project-by-slug/{slug}', [PageController::class, 'getProjectBySlug']);
Route::get('/project-by-technology/{slug}', [PageController::class, 'getProjectByTechnology']);
Route::get('/project-by-type/{slug}', [PageController::class, 'getProjectByType']);
Route::post('/send-email', [LeadController::class, 'store']);
