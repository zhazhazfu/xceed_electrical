<?php

use App\EmployeeCost;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;

use function App\Http\Controllers\index;

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

Route::get('/', 'MainController@index')->name('login');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');

Route::get('/customers', 'CustomerController@index')->name('customers')->middleware('auth');
Route::get('/customers', 'CustomerController@edit')->name('customers')->middleware('auth');
Route::resource('customers', 'CustomerController')->middleware('auth');

Route::get('/users', 'UserController@index')->name('users')->middleware('auth');
Route::resource('users', 'UserController')->middleware('auth');

Route::get('/suppliers', 'SupplierController@index')->name('suppliers')->middleware('auth');
Route::get('/suppliers', 'SupplierController@edit')->name('suppliers')->middleware('auth');
Route::resource('suppliers', 'SupplierController')->middleware('auth');

Route::get('/materials', 'MaterialController@index')->name('materials')->middleware('auth');
Route::get('/materials', 'MaterialController@edit')->name('materials')->middleware('auth');
Route::resource('materials', 'MaterialController')->middleware('auth');

Route::get('/quoting', 'QuoteController@index')->name('quoting')->middleware('auth');
Route::get('/quoting', 'QuoteController@edit')->name('quoting')->middleware('auth');
Route::resource('quoting', 'QuoteController')->middleware('auth');

Route::get('/quoteterms', 'QuoteTermController@index')->name('quoteterms')->middleware('auth');
Route::get('/quoteterms', 'QuoteTermController@edit')->name('quoteterms')->middleware('auth');
Route::resource('quoteterms', 'QuoteTermController')->middleware('auth');

Route::get('/grossmargin', 'GrossMarginController@index')->name('grossmargin')->middleware('auth');
Route::get('/grossmargin', 'GrossMarginController@edit')->name('grossmargin')->middleware('auth');
Route::resource('grossmargin', 'GrossMarginController')->middleware('auth');

Route::get('/employeecosts', 'EmployeeCostController@index')->name('employeecosts')->middleware('auth');
Route::get('/employeecosts', 'EmployeeCostController@edit')->name('employeecosts')->middleware('auth');
Route::resource('employeecosts', 'EmployeeCostController')->middleware('auth');

Route::get('/discounts', 'DiscountController@index')->name('discounts')->middleware('auth');
Route::get('/discounts', 'DiscountController@edit')->name('discounts')->middleware('auth');
Route::resource('discounts', 'DiscountController')->middleware('auth');

Route::get('/totalcosts', 'CompanyCostController@totalCosts')->name('totalcosts')->middleware('auth');
Route::get('/companycosts', 'CompanyCostController@index')->name('companycosts')->middleware('auth');
Route::get('/companycosts', 'CompanyCostController@edit')->name('companycosts')->middleware('auth');
Route::resource('companycosts', 'CompanyCostController')->middleware('auth');

Route::get('/categories', 'CategoryController@index')->name('categories')->middleware('auth');
Route::get('/categories', 'CategoryController@edit')->name('categories')->middleware('auth');
Route::resource('categories', 'CategoryController')->middleware('auth');

Route::get('/subcategories', 'SubCategoryController@index')->name('subcategories')->middleware('auth');
Route::get('/subcategories', 'SubCategoryController@edit')->name('subcategories')->middleware('auth');
Route::resource('subcategories', 'SubCategoryController')->middleware('auth');

Route::get('/pricelists', 'PriceListController@index')->name('pricelists')->middleware('auth');
Route::get('/pricelists/{page_id}/{id}/edit', 'PriceListController@edit')->middleware('auth');
Route::patch('/pricelists/{page_id}/{id}/update', 'PriceListController@update')->middleware('auth');
Route::resource('pricelists', 'PriceListController')->middleware('auth');

Route::get('/businessdetails', 'BusinessDetailController@index')->name('businessdetails')->middleware('auth');
Route::get('/businessdetails', 'BusinessDetailController@edit')->name('businessdetails')->middleware('auth');
Route::resource('businessdetails', 'BusinessDetailController')->middleware('auth');

Route::get('/login', 'MainController@index')->name('login');
Route::post('/main/checklogin', 'MainController@checklogin');
Route::get('/main/successlogin', 'MainController@successlogin')->middleware('auth');
Route::get('/main/logout', 'MainController@logout');