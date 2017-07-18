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

Route::resource('business', 'BusinessController', ['only'=>['index', 'create', 'store', 'show']]);

Route::resource('business.product', 'ProductController', ['only'=>['index', 'create', 'store', 'update']]);

Route::resource('business.category', 'CategoryController', ['only'=>['index']]);

Route::resource('business.cart', 'CartController', ['only'=>['index', 'create', 'store']]);

Route::resource('business.account', 'AccountController', ['only'=>['index', 'create', 'store']]);

Route::resource('business.sale_invoice', 'SaleInvoiceController', ['only'=>['index', 'store', 'show']]);

Route::resource('business.account_configuration', 'AccountConfigurationController', ['only'=>['index', 'update']]);

Route::resource('business.journal_entry', 'JournalEntryController', ['only'=>['index']]);

Route::resource('business.journal_item', 'JournalItemController', ['only'=>['index']]);

Route::resource('business.balance_sheet', 'BalanceSheetController', ['only'=>['index']]);

Route::resource('business.trial_balance', 'TrialBalanceController', ['only'=>['index']]);

Route::resource('business.profit_loss', 'ProfitLossController', ['only'=>['index']]);
