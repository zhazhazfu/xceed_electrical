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
Route::get('/admindash', 'AdmindashController@index')->name('admindash')->middleware('auth');


Route::get('/qdash', 'QdashController@index')->name('qdash')->middleware('auth');
Route::get('/adminqdash', 'AdminqdashController@index')->name('adminqdash')->middleware('auth');
Route::get('/adminqsetting', 'AdminqsettingController@index')->name('adminqsetting')->middleware('auth');

Route::get('/customers', 'CustomerController@index')->name('customers')->middleware('auth');
Route::get('/customers', 'CustomerController@edit')->name('customers')->middleware('auth');
Route::resource('customers', 'CustomerController')->middleware('auth');

Route::get('/users', 'UserController@index')->name('users')->middleware('auth');
Route::get('/users', 'UserController@edit')->name('users')->middleware('auth');
Route::resource('users', 'UserController')->middleware('auth');

Route::get('/suppliers', 'SupplierController@index')->name('suppliers')->middleware('auth');
Route::get('/suppliers', 'SupplierController@edit')->name('suppliers')->middleware('auth');
Route::resource('suppliers', 'SupplierController')->middleware('auth');

Route::get('/quoting', 'QuoteController@index')->name('quoting')->middleware('auth');
Route::resource('quoting', 'QuoteController')->middleware('auth');

Route::post('/quote_pricings', 'QuoteController@quote_pricings')->name('quote_pricings')->middleware('auth');

Route::get('/perpointquote', 'PerpointController@index')->name('perpointquote')->middleware('auth');
Route::resource('perpointquote', 'PerpointController')->middleware('auth');

Route::get('/quotesetting', 'QuotesettingController@index')->name('quotesetting')->middleware('auth');
Route::get('/quotesetting', 'QuotesettingController@edit')->name('quotesetting')->middleware('auth');
Route::resource('quotesetting', 'QuotesettingController')->middleware('auth');

Route::get('/termsconditions', 'TermsConditionsController@index')->name('termsconditions')->middleware('auth');
Route::get('/termsconditions', 'TermsConditionsController@edit')->name('termsconditions')->middleware('auth');
Route::resource('termsconditions', 'TermsConditionsController')->middleware('auth');

Route::get('/inclusions', 'InclusionsController@index')->name('inclusions')->middleware('auth');
Route::get('/inclusions', 'InclusionsController@edit')->name('inclusions')->middleware('auth');
Route::resource('inclusions', 'InclusionsController')->middleware('auth');

Route::get('/exclusions', 'ExclusionsController@index')->name('exclusions')->middleware('auth');
Route::get('/exclusions', 'ExclusionsController@edit')->name('exclusions')->middleware('auth');
Route::resource('exclusions', 'ExclusionsController')->middleware('auth');

Route::get('/prefix', 'PrefixController@index')->name('prefix')->middleware('auth');
Route::get('/prefix', 'PrefixController@edit')->name('prefix')->middleware('auth');
Route::resource('prefix', 'PrefixController')->middleware('auth');

Route::get('/materials', 'MaterialController@index')->name('materials')->middleware('auth');
Route::get('/materials', 'MaterialController@edit')->name('materials')->middleware('auth');
Route::resource('materials', 'MaterialController')->middleware('auth');

Route::get('/history', 'HistoryController@index')->name('history')->middleware('auth');
Route::get('/history/{id}/edit', 'HistoryController@edit')->middleware('auth');
Route::patch('/history/{id}/update', 'HistoryController@update')->middleware('auth');


Route::get('/draftlist', 'DraftlistController@index')->name('draftlist')->middleware('auth');

Route::get('/quoteterms', 'QuoteTermController@index')->name('quoteterms')->middleware('auth');
Route::get('/quoteterms', 'QuoteTermController@edit')->name('quoteterms')->middleware('auth');
Route::resource('quoteterms', 'QuoteTermController')->middleware('auth');

Route::get('/preview/{id}', 'PreviewController@show')->name('preview')->middleware('auth');
// Route::post('/preview/{id}', 'PreviewController@index')->name('preview')->middleware('auth');
// Route::get('/previewPDF', 'PreviewPDFController@generatePDF')->name('preview')->middleware('auth');
Route::get('/previewPDF/{id}', 'PreviewPDFController@generatePDF')->name('previewPDF')->middleware('auth');

// Route::get('session/get','SessionController@accessSessionData');
// Route::get('session/set','SessionController@storeSessionData');
// Route::get('session/remove','SessionController@deleteSessionData');

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

Route::get('/pricelist', 'PricelistDashController@index')->name('pricelist')->middleware('auth');
Route::get('/pricelists', 'ItemHasMaterialController@index')->name('pricelists')->middleware('auth');
Route::get('/addItem', 'AddItemController@index')->name('addItem')->middleware('auth');
Route::get('/pricelists/{page_id}/{id}/edit', 'ItemHasMaterialController@edit')->middleware('auth');
Route::patch('/pricelists/{page_id}/{id}/update', 'ItemHasMaterialController@update')->middleware('auth');
Route::resource('pricelists', 'ItemHasMaterialController')->middleware('auth');

Route::get('/businessdetails', 'BusinessDetailController@index')->name('businessdetails')->middleware('auth');
Route::get('/businessdetails', 'BusinessDetailController@edit')->name('businessdetails')->middleware('auth');
Route::resource('businessdetails', 'BusinessDetailController')->middleware('auth');

Route::get('/login', 'MainController@index')->name('login');
Route::post('/main/checklogin', 'MainController@checklogin');
Route::get('/main/successlogin', 'MainController@successlogin')->middleware('auth');
Route::get('/emailfornewpassword', 'EmailfornewpasswordController@index')->name('emailfornewpassword');
Route::get('/resetpassword', 'ResetpasswordController@index')->name('resetpassword');
Route::get('/main/logout', 'MainController@logout');

Route::get('/getSubcategories/{id}', 'QuoteController@getSubCategories')->name('getSubcategories')->middleware('auth');
Route::get('/getItems/{id}', 'QuoteController@getItems')->name('getItems')->middleware('auth');
Route::get('/getDescription/{id}', 'QuoteController@getDescription')->name('getDescription')->middleware('auth');
Route::get('/calculatePrice/{id}', 'QuoteController@calculatePrice')->name('calculatePrice')->middleware('auth');
