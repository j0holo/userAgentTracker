<?php

use App\Http\Controllers\UserAgentController;
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

Route::get('/', [UserAgentController::class, 'get'])->name('home');

Route::get('/summary', [UserAgentController::class, 'summary'])->name('summary');

Route::get('/about', function () {
    return view('about');
})->name('about');

