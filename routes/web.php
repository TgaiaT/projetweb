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
Route::get('product/create', 'ProductsController@createFormProduct');
Route::get('categories/create', 'ProductsController@createFormCategory');
Route::post('product/create', 'ProductsController@createProduct');
Route::post('product/update', 'ProductsController@addCategory');
Route::post('categories/create', 'ProductsController@createCategory');
Route::post('boutique', 'ProductsController@addToBasket');

/*
 * Events
 */
Route::get('event', 'EventsController@showEvents');
Route::post('event', 'EventsController@comment');
Route::get('event/create', 'EventsController@showCreateForm');
Route::post('event/create', 'EventsController@createEvent');
Route::post('event/register', 'ActivitiesController@register');
Route::post('event/comment', 'EventsController@comment');
Route::post('event/like', 'EventsController@like');
Route::post('event/addpicture', 'EventsController@addPicture');
Route::post('event/csv', 'EventsController@getCsv');

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
Route::post('idees/vote', 'ActivitiesController@vote');

/*
 * Personal space
 */
Route::get('personnel', 'UsersController@show');
Route::post('personnel/update', 'UsersController@update');
Route::get('personnel/zipimages', 'PicturesController@zipImages');
Route::get('personnel/cloture', 'UsersController@closeAccount');
Route::get('personnel/users', 'UsersController@getUsersJson');
Route::post('personnel/change_rank', 'UsersController@updateRank');

/*
 * Basket
 */
Route::get('panier', 'BasketController@show');
Route::post('panier/remove', 'BasketController@removeProduct');
Route::post('panier/command', 'BasketController@command');

/*
 * Ban routes
 */
Route::post('event/ban', 'EventsController@ban');
Route::post('idees/ban', 'ActivitiesController@ban');
Route::post('comments/ban', 'CommentsController@ban');
Route::post('pictures/ban', 'PicturesController@ban');
Route::post('products/ban', 'ProductsController@ban');

/*
 * Legal mentions
 */
Route::get('mentions', function () {return view('mentions');});
Route::get('/accept', 'UsersController@acceptCookie');
