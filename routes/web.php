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

Route::group(['middleware' => 'auth'], function () {

    /////////////////////////////// USER AREA ///////////////////////////////
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/autoSearch', 'HomeController@autoSearch')->name('autoSearch');
    Route::post('/getTable', 'HomeController@getTable')->name('getTable');

    Route::post('/ClintReg', 'ClintController@ClintReg')->name('ClintReg');
    Route::post('/print', 'ClintController@print')->name('print');
    Route::get('autocompleteClint', 'ClintController@autocompleteClint')->name('autocompleteClint');

    Route::get('/insert', 'HomeController@insert')->name('insert');
    Route::post('/insertPost', 'HomeController@insertPost')->name('insertPost');

    /////////////////////////////// ADMIN AREA ///////////////////////////////
    Route::get('/dashbord', 'AdminController@dashbord')->name('dashbord');
    
    Route::get('/testSetting', 'TestController@testSetting')->name('testSetting');
    Route::post('/addTest', 'TestController@addTest')->name('addTest');
    Route::get('/editTest/{id}', 'TestController@editTest')->name('editTest');
    Route::post('/updateTest', 'TestController@updateTest')->name('updateTest');
    Route::get('/deleteTest/{id}', 'TestController@deleteTest')->name('deleteTest');

    Route::get('/userSetting', 'UserController@userSetting')->name('userSetting');
    Route::post('/addUser', 'UserController@addUser')->name('addUser');
    Route::get('/editUser/{id}', 'UserController@editUser')->name('editUser');
});



