<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\Customer_demographicsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\Employees_territoriesController;
use App\Http\Controllers\TerritoriesController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ShippersController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\Customer_CustomerController;
use App\Http\Controllers\Orders_detailsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para UserC
Route::get('user/get', [UserController::class, 'get']);
Route::post('user/create', [UserController::class, 'store']);
Route::put('user/update/{id}', [UserController::class, 'update']);
Route::delete('user/delete/{id}', [UserController::class, 'delete']);

// Rutas para CategoriesController
Route::get('categories/get', [CategoriesController::class, 'get']);
Route::post('categories/create', [CategoriesController::class, 'store']);
Route::put('categories/udpate/{id}', [CategoriesController::class, 'update']);
Route::delete('categories/delete/{id}', [CategoriesController::class, 'delete']);

// Rutas para CategoriesController
Route::get('customers/get', [CustomersController::class, 'get']);
Route::post('customers/create', [CustomersController::class, 'store']);
Route::put('customers/update/{id}', [CustomersController::class, 'update']);
Route::delete('customers/delete/{id}', [CustomersController::class, 'delete']);


// Rutas para Customer_demographicsController
Route::get('customer_demographics/get', [Customer_demographicsController::class, 'get']);
Route::post('customer_demographics/create', [Customer_demographicsController::class, 'store']);
Route::put('customer_demographics/update/{id}', [Customer_demographicsController::class, 'update']);
Route::delete('customer_demographics/delete/{id}', [Customer_demographicsController::class, 'delete']);

// Rutas para Customer_demographicsController
Route::get('employees/get', [EmployeesController::class, 'get']);
Route::post('employees/create', [EmployeesController::class, 'store']);
Route::put('employees/update/{id}', [EmployeesController::class, 'update']);
Route::delete('employees/delete/{id}', [EmployeesController::class, 'delete']);

// Rutas para Employees_territoriesController
Route::get('employees_territories/get', [Employees_territoriesController::class, 'get']);
Route::post('employees_territories/create', [Employees_territoriesController::class, 'store']);
Route::put('employees_territories/update/{id}', [Employees_territoriesController::class, 'update']);
Route::delete('employees_territories/delete/{id}', [Employees_territoriesController::class, 'delete']);

// Rutas para Employees_territoriesController
Route::get('territories/get', [TerritoriesController::class, 'get']);
Route::post('territories/create', [TerritoriesController::class, 'store']);
Route::put('territories/update/{id}', [TerritoriesController::class, 'update']);
Route::delete('territories/delete/{id}', [TerritoriesController::class, 'delete']);



// Rutas para RegionController
Route::get('region/get', [RegionController::class, 'get']);
Route::post('region/create', [RegionController::class, 'store']);
Route::put('region/update/{id}', [RegionController::class, 'update']);
Route::delete('region/delete/{id}', [RegionController::class, 'delete']);

// Rutas para ShippersController
Route::get('shippers/get', [ShippersController::class, 'get']);
Route::post('shippers/create', [ShippersController::class, 'store']);
Route::put('shippers/update/{id}', [ShippersController::class, 'update']);
Route::delete('shippers/delete/{id}', [ShippersController::class, 'delete']);

// Rutas para SuppliersController
Route::get('suppliers/get', [SuppliersController::class, 'get']);
Route::post('suppliers/create', [SuppliersController::class, 'store']);
Route::put('suppliers/update/{id}', [SuppliersController::class, 'update']);
Route::delete('suppliers/delete/{id}', [SuppliersController::class, 'delete']);

// Rutas para ProductsController
Route::get('products/get', [ProductsController::class, 'get']);
Route::post('products/create', [ProductsController::class, 'store']);
Route::put('products/update/{id}', [ProductsController::class, 'update']);
Route::delete('products/delete/{id}', [ProductsController::class, 'delete']);


// Rutas para OrdersController
Route::get('orders/get', [OrdersController::class, 'get']);
Route::post('orders/create', [OrdersController::class, 'store']);
Route::put('orders/update/{id}', [OrdersController::class, 'update']);
Route::delete('orders/delete/{id}', [OrdersController::class, 'delete']);


// Rutas para Customer_CustomerController
Route::get('customer_customer_demo/get', [Customer_CustomerController::class, 'get']);
Route::post('customer_customer_demo/create', [Customer_CustomerController::class, 'store']);
Route::put('customer_customer_demo/update/{id}', [Customer_CustomerController::class, 'update']);
Route::delete('customer_customer_demo/delete/{id}', [Customer_CustomerController::class, 'delete']);

// Rutas para Orders_detailsController
Route::get('orders_details/get', [Orders_detailsController::class, 'get']);
Route::post('orders_details/create', [Orders_detailsController::class, 'store']);
Route::put('orders_details/update/{id}', [Orders_detailsController::class, 'update']);
Route::delete('orders_details/delete/{id}', [Orders_detailsController::class, 'delete']);

// Route Login

Route::post('user/login', [UserController::class, 'login']);








