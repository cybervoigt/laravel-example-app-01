<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\VerifyCsrfToken;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/helloworld', function() {
    return "Hello World...";
});

Route::get('/hellouser', function() {
    dd(auth()->user()->activities);
    return "Hello User: ". auth()->user()->name;
})->middleware(['auth', 'verified'])->name('hellouser');


Route::get('/useractivities', [ActivityController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('useractivities');

Route::get('/allactivities', [ActivityController::class, 'listAll']);

Route::resource('atividade', ActivityController::class)
    ->parameters([
        'atividade'=>'activity'
    ])
    ->except('destroy')
    ->withoutMiddleware([
        TrustProxies::class,
        VerifyCsrfToken::class
    ])
    ->middleware(['auth', 'verified']);

