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

use App\Http\Controllers\Admin\Post\CreateController as AdminPostCreateController;
use App\Http\Controllers\Admin\Post\StoreController as AdminPostStoreController;
use App\Http\Controllers\Admin\Post\ShowController as AdminPostShowController;
use App\Http\Controllers\Admin\Post\EditController as AdminPostEditController;
use App\Http\Controllers\Admin\Post\UpdateController as AdminPostUpdateController;
use App\Http\Controllers\Admin\Post\DeleteController as AdminPostDeleteController;
use App\Http\Controllers\Admin\Post\IndexController as AdminPostIndexController;

use App\Http\Controllers\Admin\User\CreateController as AdminUserCreateController;
use App\Http\Controllers\Admin\User\StoreController as AdminUserStoreController;
use App\Http\Controllers\Admin\User\ShowController as AdminUserShowController;
use App\Http\Controllers\Admin\User\EditController as AdminUserEditController;
use App\Http\Controllers\Admin\User\UpdateController as AdminUserUpdateController;
use App\Http\Controllers\Admin\User\DeleteController as AdminUserDeleteController;
use App\Http\Controllers\Admin\User\IndexController as AdminUserIndexController;
use App\Http\Controllers\Category\IndexController as CategoryIndexController;
use App\Http\Controllers\Category\Post\IndexController as CategoryPostIndexController;
use App\Http\Controllers\Personal\Main\IndexController as PersonalMainIndexController;
use App\Http\Controllers\Personal\Liked\IndexController as PersonalLikedIndexController;

use App\Http\Controllers\Personal\Comment\IndexController as PersonalCommentIndexController;
use App\Http\Controllers\Personal\Comment\EditController as PersonalCommentEditController;
use App\Http\Controllers\Personal\Comment\UpdateController as PersonalCommentUpdateController;
use App\Http\Controllers\Personal\Comment\DeleteController as PersonalCommentDeleteController;

use App\Http\Controllers\Personal\Liked\DeleteController as PersonalDeleteIndexController;

use App\Http\Controllers\Post\Comment\StoreController as PostCommentStoreController;
use App\Http\Controllers\Post\IndexController as PostIndexController;
use App\Http\Controllers\Post\Like\StoreController as PostLikeStoreController;
use App\Http\Controllers\Post\ShowController as PostShowController;
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
    Route::get('/', IndexController::class)->name('main.index');
});

Route::group(['namespace' => 'App\Http\Controllers\Category', 'prefix' => 'categories'], function () {
    Route::get('/', CategoryIndexController::class)->name('category.index');

    Route::group(['namespace' => 'Post', 'prefix' => '{category}/posts'], function () {
        Route::get('/', CategoryPostIndexController::class)->name('category.post.index');
    });

});

Route::group(['namespace' => 'App\Http\Controllers\Post', 'prefix' => 'posts'], function () {
    Route::get('/', PostIndexController::class)->name('post.index');
    Route::get('/{post}', PostShowController::class)->name('post.show');

    Route::group(['namespace' => 'Comment', 'prefix' => '{post}/comment'], function () {
        Route::post('/', PostCommentStoreController::class)->name('post.comment.store');
    });

    Route::group(['namespace' => 'Like', 'prefix' => '{post}/like'], function () {
        Route::post('/', PostLikeStoreController::class)->name('post.like.store');
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Personal', 'prefix' => 'personal', 'middleware' => ['auth', 'verified']], function () {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', PersonalMainIndexController::class)->name('personal.main.index');
    });

    Route::group(['namespace' => 'Liked'], function () {
        Route::get('/likeds', PersonalLikedIndexController::class)->name('personal.liked.index');
        Route::delete('/{post}', PersonalDeleteIndexController::class)->name('personal.liked.delete');
    });

    Route::group(['namespace' => 'Comment', 'prefix' => 'comments'], function () {
        Route::get('/', PersonalCommentIndexController::class)->name('personal.comment.index');
        Route::get('/{comment}/edit', PersonalCommentEditController::class)->name('personal.comment.edit');
        Route::patch('/{comment}', PersonalCommentUpdateController::class)->name('personal.comment.update');
        Route::delete('/{comment}', PersonalCommentDeleteController::class)->name('personal.comment.delete');
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => ['auth','admin', 'verified']], function () {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', AdminMainIndexController::class)->name('admin.main.index');
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

    Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
        Route::get('/', AdminPostIndexController::class)->name('admin.post.index');
        Route::get('/create', AdminPostCreateController::class)->name('admin.post.create');
        Route::post('/', AdminPostStoreController::class)->name('admin.post.store');
        Route::get('/{post}', AdminPostShowController::class)->name('admin.post.show');
        Route::get('/{post}/edit', AdminPostEditController::class)->name('admin.post.edit');
        Route::patch('/{post}', AdminPostUpdateController::class)->name('admin.post.update');
        Route::delete('/{post}', AdminPostDeleteController::class)->name('admin.post.delete');
    });

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
        Route::get('/', AdminUserIndexController::class)->name('admin.user.index');
        Route::get('/create', AdminUserCreateController::class)->name('admin.user.create');
        Route::post('/', AdminUserStoreController::class)->name('admin.user.store');
        Route::get('/{user}', AdminUserShowController::class)->name('admin.user.show');
        Route::get('/{user}/edit', AdminUserEditController::class)->name('admin.user.edit');
        Route::patch('/{user}', AdminUserUpdateController::class)->name('admin.user.update');
        Route::delete('/{user}', AdminUserDeleteController::class)->name('admin.user.delete');
    });
});

Auth::routes(['verify' => true ]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
