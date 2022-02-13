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
define('PAGINATION_COUNT',10);
Route::group(['namespace' => 'admin', 'middleware' => 'auth:admin'], function(){
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    ########################### Begin Languages Route ####################
    Route::group(['prefix' => 'languages'], function(){
        Route::get('/', 'LangController@index')->name('admin.languages');
        Route::get('create', 'LangController@create')->name('admin.languages.create');
        Route::post('store', 'LangController@store')->name('admin.languages.store');
        Route::get('edit/{id}', 'LangController@edit')->name('admin.languages.edit');
        Route::post('update/{id}', 'LangController@update')->name('admin.languages.update');
        Route::get('delete/{id}', 'LangController@destroy')->name('admin.languages.delete');
    });
    ########################### End Languages Route #################### 
    ########################### Begin Maincategories Route ####################
    Route::group(['prefix' => 'main_categories'], function(){
        Route::get('/', 'MainCategoryController@index')->name('admin.maincategories');
        Route::get('create', 'MainCategoryController@create')->name('admin.maincategories.create');
        Route::post('store', 'MainCategoryController@store')->name('admin.maincategories.store');
        Route::get('edit/{id}', 'MainCategoryController@edit')->name('admin.maincategories.edit');
        Route::post('update/{id}', 'MainCategoryController@update')->name('admin.maincategories.update');
        Route::get('delete/{id}', 'MainCategoryController@destroy')->name('admin.maincategories.delete');
        Route::get('active/{id}', 'MainCategoryController@changestatus')->name('admin.maincategories.changestatus');
    });
    ########################### End Maincategories Route #################### 
        ########################### Begin vendors Route ####################
    Route::group(['prefix' => 'vendors'], function(){
        Route::get('/', 'VendorsController@index')->name('admin.vendors');
        Route::get('create', 'VendorsController@create')->name('admin.vendors.create');
        Route::post('store', 'VendorsController@store')->name('admin.vendors.store');
        Route::get('edit/{id}', 'VendorsController@edit')->name('admin.vendors.edit');
        Route::post('update/{id}', 'VendorsController@update')->name('admin.vendors.update');
        Route::get('delete/{id}', 'VendorsController@destroy')->name('admin.vendors.delete');
        Route::get('active/{id}', 'VendorsController@changestatus')->name('admin.vendors.changestatus');

    });
    ########################### End vendors Route #################### 

});

Route::group(['namespace' => 'admin', 'middleware' => 'guest:admin'], function(){
    Route::get('login', 'LoginController@getLogin')->name('get.admin.login');
    Route::post('login', 'LoginController@login')->name('admin.login');
});

