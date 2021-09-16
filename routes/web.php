<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', 'ProductsController@index');
Route::get('cart', 'ProductsController@cart');
Route::get('add-to-cart/{id}', 'ProductsController@addToCart');
Route::patch('update-cart', 'ProductsController@update');
Route::delete('remove-from-cart', 'ProductsController@remove');

Route::post('/orders/submit-order', 'OrdersController@submitOrder');
Route::post('/orders/update-status', 'OrdersController@updateStatus');

Route::get('/orders/receipt/{id}', 'OrdersController@receipt');


Route::get('/customer-orders/', 'OrdersController@customerOrders');

Route::get('/admin/', 'AdminController@index');

Route::get('/admin/orders/', 'AdminController@orders');

Route::get('/admin/get-orders/', 'AdminController@getOrders');

