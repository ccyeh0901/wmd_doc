<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

// --------------------
// Backpack\Demo routes
// --------------------
Route::group([
	'prefix'     => config('backpack.base.route_prefix', 'admin'),
	'middleware' => ['admin'],
	'namespace'  => 'Admin',
], function () {
	// CRUD resources and other admin routes
	CRUD::resource('monster', 'MonsterCrudController');
	CRUD::resource('group', 'GroupCrudController')->with(function () { //加入 admin/group route

		Route::get('unique', 'GroupCrudController@test'); //額外的 admin/unique 可在這邊繼續加
	});
});

Route::get('api/article', 'Api\ArticleController@index');
Route::get('api/article/{id}', 'Api\ArticleController@show');


/*切換語系用*/
Route::post('/locale', array(
	'before' => 'csrf',
	'as' => 'language-chooser',
	'uses' => 'LocaleController@chooser'
));