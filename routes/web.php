<?php

use App\Http\Controllers\EditorController;
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

Route::get('/',  [EditorController::class, 'index'])->name('home');
Route::get('/local',  [EditorController::class, 'localExample'])->name('local-home');

Route::post('/create', [EditorController::class, 'store'])->name('create');
Route::post('/delete/{todo}', [EditorController::class, 'destroy'])->name('delete');