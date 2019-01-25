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
Route::get('deconnexion', 'ConnexionController@disconnect');
Route::get('inscription', 'ConnexionController@getSigninForm');
Route::post('inscription', 'ConnexionController@signin');

/*
 * Shop
 */
Route::get('boutique', 'ProductsController@showShop');
Route::post('boutique', 'ProductsController@addToBasket');

/*
 * Events
 */
Route::get('event', 'EventsController@showEvents');
Route::post('event', 'EventsController@comment');
Route::get('event/create', 'EventsController@showCreateForm');
Route::post('event/create', 'EventsController@createEvent');

/*
 * Contact
 */
Route::get('contact', function () {
    return view('contact');
});

/*
 * Ideas box
 */
Route::get('idees', 'ActivitiesController@showActivities');
Route::post('idees/create', 'ActivitiesController@createActivity');
Route::post('idees/update', 'ActivitiesController@updateActivity');

/*
 * Personal space
 */
Route::get('personnel', function () {
    return view('personnel');
});

/*
 * Basket
 */
Route::get('panier', function () {
    return view('panier');
});
