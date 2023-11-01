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
Route::get('UserC', [UserController::class, 'get']);
Route::post('UserC', [UserController::class, 'store']);
Route::put('UserC/{id}', [UserController::class, 'update']);
Route::delete('UserC/{id}', [UserController::class, 'delete']);

// Rutas para CategoriesController
Route::get('CategoriesController', [CategoriesController::class, 'get']);
Route::post('CategoriesController', [CategoriesController::class, 'store']);
Route::put('CategoriesController/{id}', [CategoriesController::class, 'update']);
Route::delete('CategoriesController/{id}', [CategoriesController::class, 'delete']);

// Rutas para CategoriesController
Route::get('CustomersController', [CustomersController::class, 'get']);
Route::post('CustomersController', [CustomersController::class, 'store']);
Route::put('CustomersController/{id}', [CustomersController::class, 'update']);
Route::delete('CustomersController/{id}', [CustomersController::class, 'delete']);


// Rutas para Customer_demographicsController
Route::get('Customer_demographicsController', [Customer_demographicsController::class, 'get']);
Route::post('Customer_demographicsController', [Customer_demographicsController::class, 'store']);
Route::put('Customer_demographicsController/{id}', [Customer_demographicsController::class, 'update']);
Route::delete('Customer_demographicsController/{id}', [Customer_demographicsController::class, 'delete']);

// Rutas para Customer_demographicsController
Route::get('EmployeesController', [EmployeesController::class, 'get']);
Route::post('EmployeesController', [EmployeesController::class, 'store']);
Route::put('EmployeesController/{id}', [EmployeesController::class, 'update']);
Route::delete('EmployeesController/{id}', [EmployeesController::class, 'delete']);

// Rutas para Employees_territoriesController
Route::get('Employees_territoriesController', [Employees_territoriesController::class, 'get']);
Route::post('Employees_territoriesController', [Employees_territoriesController::class, 'store']);
Route::put('Employees_territoriesController/{id}', [Employees_territoriesController::class, 'update']);
Route::delete('Employees_territoriesController/{id}', [Employees_territoriesController::class, 'delete']);

// Rutas para Employees_territoriesController
Route::get('TerritoriesController', [TerritoriesController::class, 'get']);
Route::post('TerritoriesController', [TerritoriesController::class, 'store']);
Route::put('TerritoriesController/{id}', [TerritoriesController::class, 'update']);
Route::delete('TerritoriesController/{id}', [TerritoriesController::class, 'delete']);



// Rutas para RegionController
Route::get('RegionController', [RegionController::class, 'get']);
Route::post('RegionController', [RegionController::class, 'store']);
Route::put('RegionController/{id}', [RegionController::class, 'update']);
Route::delete('RegionController/{id}', [RegionController::class, 'delete']);



// Rutas para ShippersController
Route::get('ShippersController', [ShippersController::class, 'get']);
Route::post('ShippersController', [ShippersController::class, 'store']);
Route::put('ShippersController/{id}', [ShippersController::class, 'update']);
Route::delete('ShippersController/{id}', [ShippersController::class, 'delete']);

// Rutas para SuppliersController
Route::get('SuppliersController', [SuppliersController::class, 'get']);
Route::post('SuppliersController', [SuppliersController::class, 'store']);
Route::put('SuppliersController/{id}', [SuppliersController::class, 'update']);
Route::delete('SuppliersController/{id}', [SuppliersController::class, 'delete']);

// Rutas para ProductsController
Route::get('ProductsController', [ProductsController::class, 'get']);
Route::post('ProductsController', [ProductsController::class, 'store']);
Route::put('ProductsController/{id}', [ProductsController::class, 'update']);
Route::delete('ProductsController/{id}', [ProductsController::class, 'delete']);


// Rutas para OrdersController
Route::get('OrdersController', [OrdersController::class, 'get']);
Route::post('OrdersController', [OrdersController::class, 'store']);
Route::put('OrdersController/{id}', [OrdersController::class, 'update']);
Route::delete('OrdersController/{id}', [OrdersController::class, 'delete']);


// Rutas para Customer_CustomerController
Route::get('Customer_CustomerController', [Customer_CustomerController::class, 'get']);
Route::post('Customer_CustomerController', [Customer_CustomerController::class, 'store']);
Route::put('Customer_CustomerController/{id}', [Customer_CustomerController::class, 'update']);
Route::delete('Customer_CustomerController/{id}', [Customer_CustomerController::class, 'delete']);

// Rutas para Orders_detailsController
Route::get('Orders_detailsController', [Orders_detailsController::class, 'get']);
Route::post('Orders_detailsController', [Orders_detailsController::class, 'store']);
Route::put('Orders_detailsController/{id}', [Orders_detailsController::class, 'update']);
Route::delete('Orders_detailsController/{id}', [Orders_detailsController::class, 'delete']);










