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
$app->get('/user/status', 'UserController@status');
$app->get('/user/{userId}', 'UserController@userStatus');

$app->get('/route/{routeId}', 'RouteController@single');
$app->get('/admin/enable/all', 'UserController@activateAll');

$app->group(['prefix' => 'ajax'], function () use ($app) {
	$app->post('/user/create', 'UserController@create');
	$app->post('/user/status', 'UserController@getStatus');
	$app->post('/route/ticket', 'RouteController@ticket');
});