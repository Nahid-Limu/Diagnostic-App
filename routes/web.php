<?php
use App\User;
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

    if ( User::count()>0 ) {
        return view('auth.login');
    }
    return view('firstRegistation');
});
Route::get('/test', function () {
    return view('firstRegistation');
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
    
    //--test--//
    Route::get('/testSetting', 'TestController@testSetting')->name('testSetting');
    Route::post('/addTest', 'TestController@addTest')->name('addTest');
    Route::get('/editTest/{id}', 'TestController@editTest')->name('editTest');
    Route::post('/updateTest', 'TestController@updateTest')->name('updateTest');
    Route::get('/deleteTest/{id}', 'TestController@deleteTest')->name('deleteTest');

    //--user--//
    Route::get('/userSetting', 'UserController@userSetting')->name('userSetting');
    Route::post('/addUser', 'UserController@addUser')->name('addUser');
    Route::get('/editUser/{id}', 'UserController@editUser')->name('editUser');

    //--expense--//
    Route::get('/expenseSetting', 'ExpenseController@expenseSetting')->name('expenseSetting');
    Route::post('/addExpense', 'ExpenseController@addExpense')->name('addExpense');
    Route::get('/editExpense/{id}', 'ExpenseController@editExpense')->name('editExpense');
    Route::post('/updateExpense', 'ExpenseController@updateExpense')->name('updateExpense');
    Route::get('/deleteExpense/{id}', 'ExpenseController@deleteExpense')->name('deleteExpense');

    //--daily expense--//
    Route::get('/dailyExpense', 'DailyExpenseController@dailyExpense')->name('dailyExpense');
    Route::post('/addDailyExpense', 'DailyExpenseController@addDailyExpense')->name('addDailyExpense');
    Route::get('/editDailyExpense/{id}', 'DailyExpenseController@editDailyExpense')->name('editDailyExpense');
    Route::post('/updateDailyExpense', 'DailyExpenseController@updateDailyExpense')->name('updateDailyExpense');
    Route::get('/deleteDailyExpense/{id}', 'DailyExpenseController@deleteDailyExpense')->name('deleteDailyExpense');

    //--expense History--//
    Route::get('/expenseHistory', 'ExpenseHistoryController@expenseHistory')->name('expenseHistory');

    //--report--//
    Route::get('/report', 'ReportController@report')->name('report');
    
});



