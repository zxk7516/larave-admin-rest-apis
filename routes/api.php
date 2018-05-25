<?php

//use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->group(['prefix' => 'v1', 'namespace' => 'App\Api\V1\Controllers'], function ($api) {
        $api->group(['prefix' => 'auth'], function ($api) {
            $api->post('login', ['uses' => 'Auth\AuthController@login']);
            $api->post('logout', ['uses' => 'Auth\AuthController@logout']);
            $api->post('refresh', ['uses' => 'Auth\AuthController@refresh']);
            $api->get('me', ['uses' => 'Auth\AuthController@me']);
        });

        $api->get('/hello', ['as' => 'hello', 'uses' => 'HomeController@hello']);
    });

});
