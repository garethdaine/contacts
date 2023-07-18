<?php

use Illuminate\Support\Facades\Redirect;

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

$router->get('/', function () {
    return Redirect::route('contacts.index');
});

$router->group([
    'namespace' => 'App\Http\Controllers',
], function () use ($router) {
    $router->resource('contacts', ContactController::class)->only(['index', 'create', 'store']);
});
