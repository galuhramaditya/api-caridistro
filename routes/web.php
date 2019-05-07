<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'admin'], function() use ($router) {
	$router->post('getData', 'AdminController@getData');
	$router->post('login', 'AdminController@login');
	$router->post('create', 'AdminController@create');
	$router->put('update', 'AdminController@update');
	$router->delete('delete', 'AdminController@delete');
});

$router->group(['prefix' => '{provider}'], function() use ($router) {
	$router->get('redirect', 'ProviderController@redirect');
	$router->get('callback', 'ProviderController@callback');
});

$router->get('', function(Request $request) {
	return $request->path();
});
