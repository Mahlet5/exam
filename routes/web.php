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
    return view('auth.login');
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

      Route::get('user/delete/{id}',[
        'uses'=>'UsersController@destroy',
        'as'=>'user.delete'
      ]);

      Route::get('user/create',[
        'uses'=>'UsersController@create',
        'as'=>'user.create'
      ]);

      Route::post('user/store',[
        'uses'=>'UsersController@store',
        'as'=>'user.store'
      ]);

      Route::get('/roles',[
        'uses'=>'RolesController@index',
        'as'=>'roles'
      ]);

      Route::post('role/store',[
        'uses'=>'RolesController@store',
        'as'=>'role.store'
      ]);

      Route::get('/site/settings',[
        'uses'=>'SettingsController@index',
        'as'=>'site.settings'
      ]);

      Route::post('/settings/update',[
        'uses'=>'SettingsController@update',
        'as'=>'settings.update'
      ]);

      Route::get('/courses',[
        'uses'=>'CourseController@index',
        'as'=>'courses'
      ]);

      Route::post('/course/store',[
        'uses'=>'CourseController@store',
        'as'=>'course.store'
      ]);

      Route::get('/course/delete/{id}',[
        'uses'=>'CourseController@destroy',
        'as'=>'course.delete'
      ]);

      Route::get('/course/assignments',[
        'uses'=>'CourseUserController@index',
        'as'=>'course.assignments'
      ]);

      Route::post('/course/assign',[
        'uses'=>'CourseUserController@store',
        'as'=>'course.assign'
      ]);

      Route::get('/assignment/delete/{id}',[
        'uses'=>'CourseUserController@destroy',
        'as'=>'assignment.delete'
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

Route::post('/user/profile/update',[
    'uses'=>'ProfilesController@update',
    'as'=>'user.profile.update'
]);
