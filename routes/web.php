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
use App\Models\Route;

$app->get('/', 'RouteController@index');
$app->get('/user/create', 'UserController@form');
$app->get('/route/{routeId}', 'RouteController@single');

$app->group(['prefix' => 'ajax'], function () use ($app) {
	$app->post('/user/create', 'UserController@create');
	$app->post('/route/ticket', 'RouteController@ticket');
});