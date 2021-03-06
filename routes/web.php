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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/promedio_movil_simple', function () {
    return Inertia\Inertia::render('PromedioMovilSimple');
})->name('promedio_movil_simple');

Route::middleware(['auth:sanctum', 'verified'])->get('/promedio_movil_ponderado', function () {
    return Inertia\Inertia::render('PromedioMovilPonderado');
})->name('promedio_movil_ponderado');

Route::middleware(['auth:sanctum', 'verified'])->get('/suavizacion', function () {
    return Inertia\Inertia::render('SuavizacionExponencial');
})->name('suavizacion');
