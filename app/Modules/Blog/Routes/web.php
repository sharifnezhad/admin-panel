<?php

use App\Modules\Blog\Controllers\PostController;
use App\Modules\Blog\Controllers\PostManagerController;
use App\Modules\Blog\Controllers\CategoryManagerController;
use Illuminate\Support\Facades\Route;

Route::prefix('manager')
    ->middleware(['web', 'auth'])
    ->group(function () {
        Route::resource('post_type/post/category', CategoryManagerController::class, [
            'names' => [
                'index' => 'blog-manager-category-index',
                'create' => 'blog-manager-category-create',
                'store' => 'blog-manager-category-store',
                'edit' => 'blog-manager-category-edit',
                'show' => 'blog-manager-category-show',
                'update' => 'blog-manager-category-update',
                'destroy' => 'blog-manager-category-destroy',
            ]
        ]);
        Route::resource('post_type/post', PostManagerController::class, [
            'names' => [
                'index' => 'blog-manager-index',
                'create' => 'blog-manager-create',
                'store' => 'blog-manager-store',
                'edit' => 'blog-manager-edit',
                'show' => 'blog-manager-show',
                'update' => 'blog-manager-update',
                'destroy' => 'blog-manager-destroy',
            ]
        ]);
    });

Route::resource('post', PostController::class)->only(['index', 'show']);
