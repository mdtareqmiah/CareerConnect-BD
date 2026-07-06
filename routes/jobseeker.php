<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('jobseeker')
    ->name('jobseeker.')
    ->group(function () {

        Route::get('/dashboard', function () {

            return view('jobseeker.dashboard');

        })->name('dashboard');

    });