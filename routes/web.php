<?php

use Illuminate\Support\Facades\Route;
//use WebhooksController;

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


Route::match(['get','post'],'testEmail','Controller@testEmail');

Route::post('webhooks', WebhooksController::class);

//Route::post('webhooksCoinbase', WebhooksCoinbaseController::class);

/*Route::get('/test_coinbase', function () {
    return view('test_coinbase');
});*/

//Route::post('webhooks','WebhooksController@webhooks')->name('webhooks');

Route::get('/', ['uses' => 'Controller@viewHome']);
Route::get('home', ['uses' => 'Controller@viewHome']);
//Route::get('/', ['uses' => 'Controller@viewOffline']);

Route::get('/buscador', function () {
    return view('buscador');
});

Route::match(['get','post'],'checkout','Controller@viewCheckout')->name('viewCheckout');
Route::match(['get','post'],'gracias','Controller@gracias');

/*
Route::post('checkout', [
  'uses' => 'Controller@viewCheckout',
  'as' => 'front.view.checkout']);
*/

Route::post('enviarContacto', 'Controller@enviarContacto');
Route::post('enviarReserva', 'Controller@enviarReserva');
Route::post('enviarReservaCoinbase', 'Controller@enviarReservaCoinbase');

Route::match(['get','post'],'receive_ipn','Controller@receive_ipn')->name('receive_ipn');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::match(['get', 'post'], '/admin', 'AdminController@login');
Route::match(['get', 'post'], '/admin/login', 'AdminController@login');
Route::match(['get', 'post'], '/login', 'AdminController@login')->name('login');
  
/* ADMIN */

Route::get('/logout', 'AdminController@logout');

Route::group(['middleware' => ['auth']], function() {

	Route::match(['get', 'post'], 'admin/checkFechaNueva', 'FechaController@checkFechaNueva'); //unique fecha nueva add / edit

	Route::get('/admin/dashboard', 'AdminController@dashboard');

	//Usuarios Routes (Admin)
	Route::match(['get','post'],'/admin/add-usuario','UsuarioController@addUsuario');
	Route::match(['get','post'],'/admin/edit-usuario/{id}','UsuarioController@editUsuario');
	Route::match(['get','post'],'/admin/delete-usuario/{id}','UsuarioController@deleteUsuario');
	Route::get('/admin/view-usuarios','UsuarioController@viewUsuarios');

	Route::get('/admin/reset-pwd','AdminController@resetPassword');

	//Reservas Routes (Admin)
	Route::get('/admin/view-reservas','ReservaController@viewReservas');
	Route::match(['get','post'],'/admin/edit-reserva/{id}','ReservaController@editReserva');
	Route::match(['get','post'],'/admin/delete-reserva/{id}','ReservaController@deleteReserva');

	//Apartamentos Routes (Admin)
	Route::match(['get','post'],'/admin/add-apartamento','ApartamentoController@addApartamento');
	Route::match(['get','post'],'/admin/edit-apartamento/{id}','ApartamentoController@editApartamento');
	Route::match(['get','post'],'/admin/delete-apartamento/{id}','ApartamentoController@deleteApartamento');
	Route::get('/admin/view-apartamentos','ApartamentoController@viewApartamentos');
	Route::match(['get','post'],'/admin/view-ocupacion/{id}','ApartamentoController@viewOcupacion');

	//Fechas Routes (Admin)
	Route::match(['get','post'],'/admin/add-fecha','FechaController@addFecha');
	Route::match(['get','post'],'/admin/edit-fecha/{id}','FechaController@editFecha');
	Route::match(['get','post'],'/admin/delete-fecha/{id}','FechaController@deleteFecha');
	Route::get('/admin/view-fechas','FechaController@viewFechas');
	Route::match(['get','post'],'/admin/carga-masiva','FechaController@cargaMasiva');
	Route::match(['get','post'],'/admin/eliminar-fechas','FechaController@eliminarFechas');

	/* DATATABLES */

	Route::get('dataUsuarios', 'UsuarioController@getData')->name('dataUsuarios');
	Route::get('dataReservas', 'ReservaController@getData')->name('dataReservas');
	Route::get('dataApartamentos', 'ApartamentoController@getData')->name('dataApartamentos');
	Route::get('dataFechas', 'FechaController@getData')->name('dataFechas');

	//Config Routes (Admin)
	Route::match(['get','post'],'/admin/edit-config/{id}','ConfigController@editConfig');

	//exportar a excel reservas 
	Route::get('admin/exportarReservas', 'BackController@exportarReservas');

}) ;




