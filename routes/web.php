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
    return view('index');
});

Route::get('login', 'Auth\LoginController@index');
Route::post('log_me_in', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');

Route::get('signup', 'Auth\RegisterController@index');
Route::post('sign_me_up', 'Auth\RegisterController@register');

Route::resource('business', 'BusinessController');

Route::resource('business.product', 'ProductController');

Route::resource('business.category', 'CategoryController');

Route::resource('business.cart', 'CartController');

Route::resource('business.account', 'AccountController');

Route::resource('business.sale_invoice', 'SaleInvoiceController');

Route::get('/business/{business_id}/account_configuration', function($business_id){
	$business = App\Model\Business::find($business_id);
	return view('account-configuration', ['business'=>$business]);
});