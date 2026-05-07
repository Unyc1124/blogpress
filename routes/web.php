<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BlogManagementController;
use App\Http\Controllers\Frontend\BlogController;


/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/',
    [HomeController::class, 'index']);



/*
|--------------------------------------------------------------------------
| BLOG DETAILS
|--------------------------------------------------------------------------
*/

Route::get('/blog/{slug}',
    [HomeController::class, 'show'])
    ->name('blog.details');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login',
    [LoginController::class, 'index'])
    ->name('login');

Route::post('/login-submit',
    [LoginController::class, 'login'])
    ->name('login.submit');

Route::get('/logout',
    [LoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/admin',
        [BlogManagementController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | BLOG MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/blogs',
        [BlogManagementController::class, 'index']);


    /*
|--------------------------------------------------------------------------
| CREATE BLOG
|--------------------------------------------------------------------------
*/

Route::get('/admin/blogs/create',
    [BlogManagementController::class, 'create'])
    ->name('blogs.create');

/*
|--------------------------------------------------------------------------
| STORE BLOG
|--------------------------------------------------------------------------
*/

Route::post('/admin/blogs/store',
    [BlogManagementController::class, 'store'])
    ->name('blogs.store');

});

/*
|--------------------------------------------------------------------------
| EDIT BLOG
|--------------------------------------------------------------------------
*/

Route::get('/admin/blogs/edit/{id}',
    [BlogManagementController::class, 'edit'])
    ->name('blogs.edit');


/*
|--------------------------------------------------------------------------
| UPDATE BLOG
|--------------------------------------------------------------------------
*/

Route::put('/admin/blogs/update/{id}',
    [BlogManagementController::class, 'update'])
    ->name('blogs.update');


/*
|--------------------------------------------------------------------------
| DELETE BLOG
|--------------------------------------------------------------------------
*/

Route::delete('/admin/blogs/delete/{id}',
    [BlogManagementController::class, 'destroy'])
    ->name('blogs.destroy');


Route::get('/search', [BlogController::class, 'search'])->name('blog.search');

Route::get('/blogs/filter', [BlogController::class, 'filter'])->name('blog.filter');