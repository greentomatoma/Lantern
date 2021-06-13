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

