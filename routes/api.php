<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

foreach (range(1,1) as $key => $version) {

  Route::namespace('Api\V'.$version)->prefix('v'.$version)->name('api.v'.$version.'.')->group(function () {
  	Route::post('login', 'UsersController@login')->name('users.login');
		Route::post('register', 'UsersController@store')->name('users.register');
		Route::post('logout', 'UsersController@logout')->name('users.logout')->middleware('auth:api');
		Route::post('second_step_register', 'UsersController@second_step_register')->name('users.second_step_register')->middleware('auth:api');
		Route::post('account', 'UsersController@account')->name('users.account')->middleware('auth:api');
		Route::post('update_profile', 'UsersController@update_profile')->name('users.update_profile')->middleware('auth:api');
		Route::get('edit_subspecialties', 'UsersController@edit_subspecialties')->name('users.edit_subspecialties')->middleware('auth:api');
		Route::post('update_subspecialties', 'UsersController@update_subspecialties')->name('users.update_subspecialties')->middleware('auth:api');
		Route::post('change_avatar', 'UsersController@change_avatar')->name('users.change_avatar')->middleware('auth:api');
		Route::post('filter', 'UsersController@filter')->name('users.filter');

		Route::post('social/login', 'SocialController@login')->name('social.login');

		Route::resource('addresses', 'AddressesController')->only([
			'edit', 'update'
		])->middleware('auth:api');

		Route::post('devices', 'DevicesController@store')->name('devices')->middleware('auth:api');
		Route::post('get_token', 'DevicesController@get_token')->name('get_token')->middleware('auth:api');

		Route::resource('event_applications', 'EventApplicationsController')->only([
			'update'
		])->middleware('auth:api');
		Route::post('event_applications/approve/{event_application}', 'EventApplicationsController@approve')->name('event_applications.approve')->middleware('auth:api');
		Route::resource('event_categories', 'EventCategoriesController')->only([
			'index'
		]);
		Route::resource('events.event_logs', 'EventLogsController')->only([
			'index'
		])->middleware('auth:api');
		Route::resource('events', 'EventsController')->middleware('auth:api');

		Route::resource('notifications', 'NotificationsController')->only([
			'index'
		])->middleware('auth:api');

		Route::resource('pages', 'PagesController')->only('show');

		Route::resource('specialties', 'SpecialtiesController')->only([
			'index', 'show'
		]);

		Route::get('states', 'StatesController@index')->name('states.index');
		Route::get('states/{state}/cities', 'CitiesController@index')->name('states.cities.index');

		Route::resource('users', 'UsersController')->only([
			'show'
		]);
  });
  
}
