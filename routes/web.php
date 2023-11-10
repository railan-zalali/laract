<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TempatController;
use App\Http\Controllers\TicketsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use function Termwind\render;

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

// oute::get('/data', ');
// Route::get('/', [TempatController::class, 'index'])->middleware('auth', 'verified');
Route::get('/', [TempatController::class, "home"])->name('home');
Route::get('/tiket', [TempatController::class, 'index'])->middleware('auth', 'verified')->name('tiket');

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });


// Route::get('/login', function () {
//     return Inertia::render('Auth/Login');
// })->middleware('guest')->name('login');
Route::post('/selectSearch', [TempatController::class, 'searchTickets'])->name('tickets');
Route::post('/keep-tickets', [TicketsController::class, 'store'])->name('keepTickets');


// Route::post('/searchTickets', function () {
//     return Inertia::render('ResultSearch');
// })->middleware(['auth', 'verified'])->name('searchTikets');
// Route::get('/register', function () {
//     return Inertia::render('Auth/Register');
// })->middleware('guest')->name('register');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cek1', function () {
    return "<h1>hai</h1>";
})->middleware('auth', 'verified');
require __DIR__ . '/auth.php';
