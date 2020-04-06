<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
        Route::get('/home', 'HomeController@index')->name('home');
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
		Route::get('media', ['as' => 'pages.media', 'uses' => 'PageController@media']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController');
	Route::put('status', ['as'=>'user.status', 'uses'=>'UserController@updateStatus']);
    Route::resource('professorships', 'ProfessorshipController');
    Route::resource('publications', 'PublicationController');
    Route::resource('roles', 'RoleController');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

//Route::group(['middleware' => 'auth'], function () {
//    Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
//    Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
//    Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
//    Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
//    Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
//    Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
//    Route::get('media', ['as' => 'admin.pages.media', 'uses' => 'PageController@media']);
//});
//
//Route::group(['middleware' => 'auth'], function () {
//    Route::resource('user', 'UserController', ['except' => ['show']]);
//    Route::resource('professorships', 'ProfessorshipController');
//    Route::resource('publications', 'PublicationController');
//    Route::resource('roles', 'RoleController');
//    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
//    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
//    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
//});

