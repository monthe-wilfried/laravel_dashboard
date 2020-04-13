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

//Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
    Route::get('media', ['as' => 'pages.media', 'uses' => 'PageController@media']);
    Route::delete('media/delete', ['as' => 'media.delete', 'uses' => 'PageController@delete']);
    Route::delete('media/destroy', ['as' => 'media.destroy', 'uses' => 'PageController@destroy']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController');
	Route::put('update', ['as'=>'user.userUpdate', 'uses'=>'UserController@userUpdate']);
    Route::delete('user/delete', ['as'=>'user.delete', 'uses'=>'UserController@delete']);
    Route::resource('professorships', 'ProfessorshipController');
    Route::delete('professorship/delete', ['as'=>'professorship.delete', 'uses'=>'ProfessorshipController@delete']);
    Route::resource('publications', 'PublicationController');
    Route::get('publication/trash', ['as'=>'publication.trash', 'uses'=>'PublicationController@trash']);
    Route::delete('publication/process', ['as'=>'publication.process', 'uses'=>'PublicationController@trash_process']);
    Route::delete('publication/delete', ['as'=>'publication.delete', 'uses'=>'PublicationController@delete']);
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

