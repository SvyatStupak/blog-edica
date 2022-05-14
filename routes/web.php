<?php

use App\Http\Controllers\Admin\Category\CreateController;
use App\Http\Controllers\Admin\Category\DeleteController;
use App\Http\Controllers\Admin\Category\EditController;
use App\Http\Controllers\Admin\Category\IndexController as AdminCategoryIndexController;
use App\Http\Controllers\Admin\Category\ShowController;
use App\Http\Controllers\Admin\Category\StoreController;
use App\Http\Controllers\Admin\Category\UpdateController;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Admin\Main\IndexController as AdminMainIndexController;
use App\Http\Controllers\Admin\Tag\CreateController as AdminTagCreateController;
use App\Http\Controllers\Admin\Tag\StoreController as AdminTagStoreController;
use App\Http\Controllers\Admin\Tag\ShowController as AdminTagShowController;
use App\Http\Controllers\Admin\Tag\EditController as AdminTagEditController;
use App\Http\Controllers\Admin\Tag\UpdateController as AdminTagUpdateController;
use App\Http\Controllers\Admin\Tag\DeleteController as AdminTagDeleteController;
use App\Http\Controllers\Admin\Tag\IndexController as AdminTagIndexController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::group(['namespace' => 'App\Http\Controllers\Main'], function () {
    Route::get('/', IndexController::class);
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin'], function () {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', AdminMainIndexController::class);
    });

    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
        Route::get('/', AdminCategoryIndexController::class)->name('admin.category.index');
        Route::get('/create', CreateController::class)->name('admin.category.create');
        Route::post('/', StoreController::class)->name('admin.category.store');
        Route::get('/{category}', ShowController::class)->name('admin.category.show');
        Route::get('/{category}/edit', EditController::class)->name('admin.category.edit');
        Route::patch('/{category}', UpdateController::class)->name('admin.category.update');
        Route::delete('/{category}', DeleteController::class)->name('admin.category.delete');
    });

    Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function () {
        Route::get('/', AdminTagIndexController::class)->name('admin.tag.index');
        Route::get('/create', AdminTagCreateController::class)->name('admin.tag.create');
        Route::post('/', AdminTagStoreController::class)->name('admin.tag.store');
        Route::get('/{tag}', AdminTagShowController::class)->name('admin.tag.show');
        Route::get('/{tag}/edit', AdminTagEditController::class)->name('admin.tag.edit');
        Route::patch('/{tag}', AdminTagUpdateController::class)->name('admin.tag.update');
        Route::delete('/{tag}', AdminTagDeleteController::class)->name('admin.tag.delete');
    });
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
