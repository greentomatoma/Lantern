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

use Illuminate\Support\Facades\Route;

Auth::routes();

// トップページ
Route::get('/', function () {
  return view('top');
});

Route::get('/recipes', 'RecipesController@index')->name('recipes.index');
Route::resource('/recipes', 'RecipesController')->except(['index', 'show'])->middleware('auth');
Route::resource('/recipes', 'RecipesController')->only(['show']);

// レシピ
Route::prefix('recipes')->name('recipes.stock')->group(function() {
  Route::put('/{recipe}/stock', 'RecipesController@stock')->middleware('auth');
  Route::delete('/{recipe}/stock', 'RecipesController@unstock')->middleware('auth');
});

// マイページ
Route::prefix('users')->name('users.')->group(function() {
  Route::get('/{name}', 'UserController@show')->name('show');
  Route::get('/{name}/edit-profile', 'UserController@edit')->name('edit')->middleware('auth');
  Route::get('/{name}/my-note', 'UserController@note')->name('note')->middleware('auth');
  Route::post('/edit-profile', 'UserController@update')->name('update')->middleware('auth');
});

// タグ
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

// 検索
Route::get('/search','SearchController@index')->name('search.index');