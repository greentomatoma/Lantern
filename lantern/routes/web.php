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


Auth::routes();

Route::get('/', 'RecipesController@index')->name('recipes.index');

Route::resource('/recipes', 'RecipesController')->except(['index', 'show'])->middleware('auth');
Route::resource('/recipes', 'RecipesController')->only(['show']);

Route::prefix('recipes')->name('recipes.stock')->group(function() {
  Route::put('/{recipe}/stock', 'RecipesController@stock')->middleware('auth');
  Route::delete('/{recipe}/stock', 'RecipesController@unstock')->middleware('auth');
});

Route::get('{name}', 'UserController@show')->name('users.show');
Route::get('{name}/edit-profile', 'UserController@edit')->name('users.edit')->middleware('auth');
Route::post('edit-profile', 'UserController@update')->name('users.update')->middleware('auth');