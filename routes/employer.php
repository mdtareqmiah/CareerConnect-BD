<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {

        Route::get('/dashboard', function () {

            return view('employer.dashboard');

        })->name('dashboard');

    });