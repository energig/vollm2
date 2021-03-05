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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

//Authentication routes
Auth::routes(['register' => false]);
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('authregister')->middleware('can:manage-users');
//Route::post('register', 'Auth\RegisterController@register')->middleware('can:manage-users');

//Costumer routes
//temp admin route here
Route::get('/costumers/createalldocuments', 'CostumersController@createAllDocuments')->name('costumers.createAllDocuments')->middleware('can:manage-users');

Route::resource('/costumers', 'CostumersController');
Route::get('/costumers/signabfr/{urlstr}', 'CostumersController@guestEdit')->name('costumers.signabfr');
Route::get('/costumers/signvertr/{urlstr}', 'CostumersController@guestEditVertr')->name('costumers.signvertr');
Route::put('/costumers/updabfr/{costumer}', 'CostumersController@guestUpdate')->name('costumers.guestUpdate');
Route::put('/costumers/updvertr/{costumer}', 'CostumersController@guestUpdateVertr')->name('costumers.guestUpdateVertr');
Route::get('/costumers/sendabfrvm/{costumer}', 'CostumersController@sendAbfragevollmacht')->name('costumers.sendabfrvm');
Route::get('/costumers/sendvertrvm/{costumer}', 'CostumersController@sendVertretungsvollmacht')->name('costumers.sendvertrvm');
Route::get('/costumers/download/{costumer}/{document}', 'CostumersController@downloadDocument')->name('costumers.downloadDocument');

// OdooAbrechnung routes
Route::resource('/abrechnungen', 'OdooAbrechnungController')->except([
    'create', 'store'
])->middleware('can:manage-users');

//Admin routes
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
	Route::resource('/users', 'UsersController',['except' => ['show']]);
});

//Additional admin routes
Route::get('/admin/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:cache');
    //Artisan::call('optimize');

    return;
})->middleware('can:manage-users');

Route::get('/admin/migrate', function(){
    Artisan::call('migrate');
})->middleware('can:manage-users');


