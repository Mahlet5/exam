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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * [Route description]  GROUPS ADMIN ROUTES
 * @var [type]
 */
Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){
    Route::get('/users',[
      'uses'=>'UsersController@index',
      'as'=>'users'
    ]);

    Route::get('/roles',[
      'uses'=>'RolesController@index',
      'as'=>'roles'
    ]);

    Route::get('/site/settings',[
      'uses'=>'SettingsController@index',
      'as'=>'site.settings'
    ]);
});

/**
 * [Route description]  GROUPS STUDENT ROUTES
 * @var [type]
 */
Route::group(['prefix'=>'student','middleware'=>['auth','student']],function(){

});

/**
 * [Route description] GROUPS TEACHER ROUTES
 * @var [type]
 */
Route::group(['prefix'=>'teacher','middleware'=>['auth','teacher']],function(){

});

Route::get('/profile',[
  'uses'=>'ProfilesController@index',
  'as'=>'profile'
]);
