<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuth;


Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('es_admin')
    ->name('admin.index');

require __DIR__.'/auth.php';
