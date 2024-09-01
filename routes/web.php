<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::group(['middleware' => 'userAuth'], function () {
    Route::get('/', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    Route::get('/technician', function () {
        return view('pages.technician');
    })->name('technician');
    Route::get('/stb-in-out', function () {
        return view('pages.stbinout');
    })->name('stbinout');
    Route::get('/stb-stocks', function () {
        return view('pages.stb-stocks');
    })->name('stbStocks');
    Route::get('/stb-import', function () {
        return view('pages.stb-import');
    })->name('stbImport');
    Route::get('/area', function () {
        return view('pages.area');
    })->name('area');
});

// login form
Route::post('/user-login', [UserController::class, 'login'])->name('userLogin');

Route::get('/login', function () {
    // return view('login');
    if (session('login') == null) {
        return view('login');
    } else {
        return redirect(route('dashboard'));
    }
})->name('login');

// user logout
Route::get('/logout', function () {

    if (session()->has('login')) {
        session()->pull('login', null);
        return redirect(route('login'));
    }
})->name('userLogout');