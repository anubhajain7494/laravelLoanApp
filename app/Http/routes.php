<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Loans;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
Route::post('login', 'Auth\AuthController@login');
Route::post('logout', 'Auth\AuthController@logout');

Route::group(['middleware' => 'auth:api'], function() {
	Route::get('loans', 'LoansController@index');
	Route::get('loans/{loan}', 'LoansController@show');
	Route::post('loans', 'LoansController@store');
	Route::put('loans/{loan}', 'LoansController@update');
	Route::delete('loans/{loan}', 'LoansController@delete');
});