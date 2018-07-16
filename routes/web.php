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

Route::get('/', function () {
   return  redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');;

Route::get('/produits', 'HomeController@liste_produits')->name('liste_produits')->middleware('auth');;
Route::get('/produits/add', 'HomeController@add_produit')->name('add_produit')->middleware('auth');;
Route::post('/produits/add/save', 'ProduitsController@save_produit')->name('save_produit')->middleware('auth');;
Route::get('/produits/update/{id}', 'ProduitsController@update_produit')->name('update_produit')->middleware('auth');;
Route::post('/produits/update/save/{id}', 'ProduitsController@update_produit_save')->name('update_produit_save')->middleware('auth');;
Route::get('/produits/delete/{id}', 'ProduitsController@delete_produit')->name('delete_produit')->middleware('auth');;

Route::get('/users', 'HomeController@liste_users')->name('liste_users')->middleware('auth');;
Route::get('/users/add', 'HomeController@add_user')->name('add_user')->middleware('auth');;
Route::post('/users/add/save', 'UsersController@save_user')->name('save_user')->middleware('auth');;
Route::get('/users/delete/{id}', 'UsersController@delete_user')->name('delete_user')->middleware('auth');;
Route::get('/users/update/{id}', 'UsersController@update_user')->name('update_user')->middleware('auth');;
Route::post('/users/update/{id}/save', 'UsersController@update_user_save')->name('update_user_save')->middleware('auth');;

Route::get('/ventes', 'HomeController@liste_ventes')->name('liste_ventes')->middleware('auth');;
Route::get('/ventes/add', 'HomeController@add_vente')->name('add_vente')->middleware('auth');;

Route::get('/abouts', 'HomeController@abouts')->name('abouts')->middleware('auth');;
