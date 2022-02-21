<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@index')->name('home');
Route::get('admin', 'HomeController@admin')->name('admin');
Route::get('contato', 'HomeController@contact')->name('contact');
Route::post('contato', 'HomeController@send_contact')->name('contact');

Route::get('auth/{provider}', 'SocialController@redirect')->name('auth.redirect');
Route::get('auth/{provider}/callback', 'SocialController@callback')->name('auth.callback');

Route::resource('especialidades', 'SpecialtiesController', [
	'names' => [
		'show' => 'specialties.show'
	]
])->only([
	'show'
]);

Route::resource('especialidades.subespecialidades', 'SubspecialtiesController', [
	'names' => [
		'show' => 'subspecialties.show'
	]
])->only([
	'show'
]);

Route::resource('eventos', 'EventsController', [
	'names' => [
		'index' => 'events.index',
		'create' => 'events.create',
		'store' => 'events.store',
		'edit' => 'events.edit',
		'update' => 'events.update',
		'show' => 'events.show'
	]
])->middleware('auth');

Route::resource('eventos.inscricoes', 'EventApplicationsController', [
	'names' => [
		'index' => 'event_applications.index',
		'create' => 'event_applications.create',
		'store' => 'event_applications.store',
		'edit' => 'event_applications.edit',
		'update' => 'event_applications.update',
		'show' => 'event_applications.show'
	]
])->middleware('auth');

Route::get('inscricoes/aprovar/{event_application}', 'EventApplicationsController@approve')->name('event_applications.approve')->middleware('auth');
Route::post('inscricoes/aprovar/{event_application}', 'EventApplicationsController@update_approve')->name('event_applications.update_approve')->middleware('auth');

Route::resource('eventos.historico-do-evento', 'EventLogsController', [
	'names' => [
		'index' => 'event_logs.index'
	]
])->middleware('auth');

Route::resource('notificacoes', 'NotificationsController', [
	'names' => [
		'index' => 'notifications.index',
		'show' => 'notifications.show'
	]
])->middleware('auth');

Route::resource('horarios', 'DaysController', [
	'names' => [
		'index' => 'days.index'
	]
])->middleware('auth');

Route::post('days/update_status/{day}', 'DaysController@update_status')->name('days.update_status');
Route::get('days/hours', 'DaysController@hours')->name('days.hours');

Route::post('hours/update_status/{hour}', 'HoursController@update_status')->name('hours.update_status');

Route::get('profissionais', 'UsersController@index')->name('users.index');
Route::get('conta/dados-pessoais', 'UsersController@edit')->name('users.edit')->middleware('auth');
Route::post('conta/dados-pessoais', 'UsersController@update')->name('users.update')->middleware('auth');
Route::get('conta/finalizar-cadastro', 'UsersController@second_step_register')->name('users.second_step_register')->middleware('auth');
Route::post('conta/finalizar-cadastro', 'UsersController@update_second_step_register')->name('users.update_second_step_register')->middleware('auth');
Route::get('profissionais/{user}', 'UsersController@show')->name('users.show');
Route::get('conta/alterar-senha', 'UsersController@edit_password')->name('users.edit_password')->middleware('auth');
Route::post('conta/alterar-senha', 'UsersController@update_password')->name('users.update_password')->middleware('auth');
Route::get('conta/perfil', 'UsersController@edit_profile')->name('users.edit_profile')->middleware('auth');
Route::post('conta/perfil', 'UsersController@update_profile')->name('users.update_profile')->middleware('auth');
Route::post('users/filter', 'UsersController@filter')->name('users.filter');

Route::get('states/cities/{state}', 'StatesController@cities')->name('states.cities');

Route::get('{page}', 'PagesController@show')->name('pages.show');

// Admin

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function() {
		Route::get('home', 'HomeController@index')->name('home');

		Route::resource('info', 'InfoController')->only([
			'edit', 'update'
		]);

		Route::resource('event_categories', 'EventCategoriesController');
		Route::post('event_categories/update_status/{event_category}', 'EventCategoriesController@update_status')->name('event_categories.update_status');

		Route::resource('events', 'EventsController')->only([
			'index', 'show'
		]);

		Route::resource('pages', 'PagesController');
		Route::post('pages/update_status/{page}', 'PagesController@update_status')->name('pages.update_status');

		Route::resource('specialties', 'SpecialtiesController');
		Route::post('specialties/update_status/{specialty}', 'SpecialtiesController@update_status')->name('specialties.update_status');

		Route::resource('specialties.subspecialties', 'SubspecialtiesController');
		Route::post('subspecialties/update_status/{subspecialty}', 'SubspecialtiesController@update_status')->name('subspecialties.update_status');
		Route::post('subspecialties/update_featured/{subspecialty}', 'SubspecialtiesController@update_featured')->name('subspecialties.update_featured');

		Route::resource('roles', 'RolesController');
		Route::resource('users', 'UsersController');
});
