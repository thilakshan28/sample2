<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

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
    return view('welcome');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', 'PostController@index')->name('post.index');
    Route::get('/create','PostController@create')->name('post.create');
    Route::get('ajaxRequest','PostController@dropdown')->name('get.district');
    Route::post('/store','PostController@store')->name('post.store');

    Route::group(['prefix' => '{post}'], function () {
    Route::post('/comments','CommentController@store')->name('comment.store');
    Route::get('/show','PostController@show')->name('post.show');


    Route::get('/edit','PostController@edit')->name('post.edit');
    Route::patch('/','Postcontroller@update')->name('post.update');
    Route::get('/delete','PostController@delete')->name('post.delete');
    Route::delete('/','PostController@destroy')->name('post.destroy');

    });
});

Route::group(['prefix' => 'users',], function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/create','UserController@create')->name('user.create');
    Route::post('/store','UserController@store')->name('user.store');

    Route::group(['prefix' => '{user}'], function () {
    Route::get('/show','UserController@show')->name('user.show');
    Route::get('/edit','UserController@edit')->name('user.edit');
    Route::patch('/','Usercontroller@update')->name('user.update');
    Route::get('/delete','UserController@delete')->name('user.delete');
    Route::delete('/','UserController@destroy')->name('user.destroy');

    });
});

Route::group(['prefix' => 'comments',], function () {
    Route::get('/users','CommentController@uindex')->name('comment.uindex');
    Route::get('/{user?}','CommentController@aindex')->name('comment.aindex');

    Route::group(['prefix' => '{post}'], function () {
    Route::patch('/update','Commentcontroller@update')->name('comment.update');
    Route::delete('/destroy','CommentController@destroy')->name('comment.destroy');
    });
});

Route::group(['prefix' => 'reports'], function() {
    Route::get('/','ReportController@index')->name('report.index');
    Route::get('/user','ReportController@uindex')->name('report.user');
    Route::get('/{user}','ReportController@postreport')->name('post.report');
});
});
require __DIR__.'/auth.php';
