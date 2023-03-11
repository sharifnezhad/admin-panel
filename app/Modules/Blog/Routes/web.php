<?php

use App\Modules\Blog\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('manager')
    ->middleware(['web', 'auth'])
    ->group(function () {
        Route::resource('post_type/post', PostController::class);
    });
