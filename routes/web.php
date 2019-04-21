<?php

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

Auth::routes();

Route::get('/', 'ProductController@index')->name('home');
Route::get('/changepassword', 'UserController@showChangePasswordForm');
Route::post('/changepassword', 'UserController@changePassword')->name('changePassword');
Route::prefix('product')->group(function () {
    Route::get('create', 'ProductController@create')->name('product.create');
    Route::post('store', 'ProductController@store')->name('product.store');
    Route::post('delete', 'ProductController@destroy')->name('product.destroy');
    Route::post('search', 'ProductController@search')->name('product.search');
    Route::get('edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::put('update/{id}', 'ProductController@update')->name('product.update');
    Route::post('publish', 'ProductController@publish')->name('product.publish');
    Route::post('addlove', 'ProductController@addLove')->name('product.addLove');
    Route::post('addcomment', 'CommentController@store')->name('comment.store');
    Route::post('editcomment', 'CommentController@update')->name('comment.update');
    Route::post('addreply', 'CommentController@addReply')->name('comment.storereply');
    Route::post('deletecomment', 'CommentController@destroy')->name('comment.delete');
});
Route::prefix('category')->group(function () {
    Route::get('{slug}', 'CategoryController@show')->name('category.show');
    Route::post('delete', 'CategoryController@destroy')->name('category.delete');
    Route::post('store', 'CategoryController@store')->name('category.store');
});

Route::get('/product/{slug}', 'ProductController@show')->name('product.show');
Route::prefix('user')->group(function () {
    Route::get('{slug}', 'UserController@show')->name('user.show');
    Route::get('edit/{id}', 'UserController@edit')->name('user.edit');
    Route::put('update/{id}', 'UserController@update')->name('user.update');
    Route::post('delete', 'UserController@destroy')->name('user.delete');
});

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('user', 'AdminController@viewUser')->name('admin.user');

    Route::prefix('category')->group(function () {
        Route::get('create', 'CategoryController@create')->name('category.create');
        Route::get('edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::put('update/{id}', 'CategoryController@update')->name('category.update');
        Route::get('/', 'AdminController@viewCategory')->name('admin.category');
    });
    Route::prefix('user')->group(function () {
        Route::get('create', 'UserController@adminCreate')->name('user.admin.create');
        Route::post('store', 'UserController@adminStore')->name('user.admin.store');
        Route::get('edit/{id}', 'UserController@adminEdit')->name('user.admin.edit');
        Route::put('update/{id}', 'UserController@adminUpdate')->name('user.admin.update');
    });
    Route::prefix('product')->group(function () {
        Route::get('/', 'AdminController@viewProduct')->name('admin.product');
        Route::get('create', 'ProductController@adminCreate')->name('product.admin.create');
        Route::post('store', 'ProductController@adminStore')->name('product.admin.store');
        Route::get('edit/{id}', 'ProductController@adminEdit')->name('product.admin.edit');
        Route::put('update/{id}', 'ProductController@adminUpdate')->name('product.admin.update');
    });
    Route::prefix('role')->group(function () {
        Route::get('/', 'AdminController@viewRole')->name('admin.role');
        Route::get('create', 'RoleController@create')->name('role.admin.create');
        Route::post('store', 'RoleController@store')->name('role.admin.store');
        Route::get('edit/{id}', 'RoleController@edit')->name('role.admin.edit');
        Route::post('update', 'RoleController@update')->name('role.admin.update');
    });
});
