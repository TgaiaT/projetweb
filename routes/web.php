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

Route::get('/', 'IndexController@index');

/*
 * Connection routes - Connection controller
 */
Route::get('connexion', 'ConnexionController@getConnectionForm');
Route::post('connexion', 'ConnexionController@connect');
Route::get('deconnexion', 'ConnexionController@getDisconnectionForm');
Route::get('inscription', 'ConnexionController@getSigninForm');
Route::post('inscription', 'ConnexionController@signin');


Route::get('boutique', 'ProductsController@showShop');
Route::post('boutique', 'ProductsController@addToBasket');


Route::get('event', 'EventsController@showEvents');
Route::post('event', 'EventsController@comment');


Route::get('contact', function () {
    return view('contact');
});


Route::get('idee', function () {
    return view('idee');
});


Route::get('personnel', function () {
    return view('personnel');
});


Route::get('panier', function () {
    return view('panier');
});
