<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('Api')->group(function () {
	Route::post('updatedh','ShiperController@store');
	Route::get('updatedh','ShiperController@enull');
	
	Route::get('login','ShiperController@enull');
	Route::post('login','ShiperController@update');
	
	Route::get('donhangship','ShiperController@enull');
	Route::post('donhangship','ShiperController@donhangship');
	
	Route::post('isonlineshiper','ShiperController@isonline');
	Route::get('isonlineshiper','ShiperController@enull');
	
	Route::post('donhangfitter','ShiperController@donhangfitter');
	Route::get('donhangfitter','ShiperController@enull');
	
	Route::post('doimatkhau','ShiperController@doimatkhau');
	Route::get('doimatkhau','ShiperController@enull');
	
	Route::post('cuocgoi','ShiperController@cuocgoi');
	
	
});
