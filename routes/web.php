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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/goal', [App\Http\Controllers\GoalController::class, 'index'])->name('goal');
// Route::get('/goal/edit', [App\Http\Controllers\GoalController::class, 'edit'])->name('goal');
Route::get('/goal/regist', [App\Http\Controllers\GoalController::class, 'regist'])->name('goal');
Route::get('/goal/update', [App\Http\Controllers\GoalController::class, 'update'])->name('goal');
Route::get('/goal/insert', [App\Http\Controllers\GoalController::class, 'insert'])->name('goal');
Route::get('/goal/count', [App\Http\Controllers\GoalController::class, 'count'])->name('goal');
