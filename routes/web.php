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

use Illuminate\Support\Facades\Auth;
use App\Sale;
use App\Product;
use App\Category;
use App\User;

Auth::routes();

Route::get('/', function () {
	return redirect('/admin/dashboard');
})->middleware('auth');

Route::get('/home', function () {
	return redirect('/admin/dashboard');
})->middleware('auth');

Route::group(['prefix' => '/admin',  'middleware' => 'auth'], function()
{
	Route::get('/dashboard', function() {
		$sales = Sale::where('status_id', '=', 2)->get();
		$products = Product::all();
		$categories = Category::all();
		$users = User::all();
		return view('admin.dashboard', compact('sales', 'products', 'categories', 'users'));
	})->name('dashboard');

	Route::get('/reports', 'ReportController@index')->name('reports.index');
	Route::get('/reports/chart', function() {

		// venta total 
		$amount = DB::table('sales')
				->select(DB::raw('sum(sales.amount) total'))
				->where('sales.status_id', 2)
				->get();		
		// numero de ventas
		$quantity = DB::table('sales')
					->select(DB::raw('count(sales.receipt) total'))
					->where('sales.status_id', 2)
					->get();
		// venta promedio
		$average = DB::table('sales')
					->select(DB::raw('avg(sales.amount) total'))
					->where('sales.status_id', 2)
					->get();
		// ganancia total
		$profit = DB::table('products')
				->select(DB::raw('sum((products.sell_price - products.price) * sale_details.quantity) total'))
				->leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
				->leftJoin('sales', 'sale_details.sale_id', '=', 'sales.id')
				->where('sales.status_id', 2)
				->get();
		// $sales = array_add(['name' => $amount->total]);
									
		// $sales = [
		// 	'amount' => $amount,
		// 	'quantity' => $quantity,
		// 	'average' => $average,
		// 	'profit' => $profit
		// ];









		return $total;
	});
	// Route::get('/reports/chart', 'ReportController@chart')->name('reports.chart');
	Route::resource('/sales', 'SaleController', ['except' => ['edit', 'destroy']]);
	Route::post('/sales/{id}/add', 'SaleController@add')->name('sales.add');
	Route::post('/sales/open', 'SaleController@open')->name('sales.open');
	Route::resource('/products', 'ProductController');
	Route::resource('/categories', 'CategoryController', ['except' => ['show']]);	
	Route::resource('/photos', 'PhotoController', ['except' => ['store', 'create', 'show', 'edit', 'update']]);
	
	Route::get('/users', 'UserController@index')->name('users.index');
	Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
	Route::put('/users/{user}', 'UserController@update')->name('users.update');
});
