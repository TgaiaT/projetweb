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

    return view('home');
});

Route::get('connexion', 'ConnexionController@getForm');
/*Route::post('connexion', 'ConnexionController@connect');*/
Route::get('deconnexion', 'ConnexionController@disconnect');
Route::post('connexion', 'ConnexionController@traitement');


Route::get('connexion', function () {
    return view('connexion');
});


Route::get('deconnexion', function () {
    return view('deconnexion');
});


Route::get('inscription', function () {
    return view('inscription');
});


Route::get('boutique', function () {
    return view('boutique');
});


Route::get('event', function () {
    return view('event');
});


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
