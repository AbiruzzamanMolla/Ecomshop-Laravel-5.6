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

// userRoutes
Route::get('/', 'HomeController@index');

// adminRoutes
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::post('/admin-dashboard', 'AdminController@dashboard');
Route::get('/logout', 'SuperAdminController@logout');

// category routes
Route::get('/add-category', 'CategoryController@addCategory');
Route::get('/all-category', 'CategoryController@viewCategory');
Route::post('/save-category', 'CategoryController@saveCategory');
Route::get('/inactive-category/{category_id}', 'CategoryController@inactiveCategory');
Route::get('/active-category/{category_id}', 'CategoryController@activeCategory');
Route::get('/update-category/{category_id}', 'CategoryController@viewCategoryId');
Route::post('/update-category/{category_id}', 'CategoryController@updateCategory');
Route::get('/delete-category/{category_id}', 'CategoryController@deleteCategory');

// menufecture routes
Route::get('/add-manufecture', 'ManufectureController@addManufecture');
Route::post('/save-manufecture', 'ManufectureController@saveManufecture');
Route::get('/all-manufecture', 'ManufectureController@viewManufecture');
Route::get('/inactive-manufecture/{manufecture_id}', 'ManufectureController@inactiveManufecture');
Route::get('/active-manufecture/{manufecture_id}', 'ManufectureController@activeManufecture');
Route::get('/update-manufecture/{manufecture_id}', 'ManufectureController@viewManufectureId');
Route::post('/update-manufecture/{manufecture_id}', 'ManufectureController@updateManufecture');
Route::get('/delete-manufecture/{manufecture_id}', 'ManufectureController@deleteManufecture');

// product routes

Route::get('/add-product', 'ProductController@addProduct');
Route::post('/save-product', 'ProductController@saveProduct');
Route::get('/all-product', 'ProductController@viewProduct');
Route::get('/inactive-product/{product_id}', 'ProductController@inactiveProduct');
Route::get('/active-product/{product_id}', 'ProductController@activeProduct');
