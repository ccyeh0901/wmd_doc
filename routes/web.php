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
		Route::get('group/create/child', 'GroupCrudController@create'); //額外的 admin/unique 可在這邊繼續加
	});

	CRUD::resource('schedule', 'ScheduleCrudController');
	CRUD::resource('member', 'MemberCrudController');
});


Route::group([ //給前臺用的，ex: 報名者
	'prefix'     => 'front',
	'middleware' => ['admin'],
	'namespace'  => 'Admin',
], function () {
	// CRUD resources and other admin routes
	CRUD::resource('member', 'MemberCrudController');
});

Route::get('api/article', 'Api\ArticleController@index');
Route::get('api/article/{id}', 'Api\ArticleController@show');


/*切換語系用*/
Route::post('/locale', array(
	'before' => 'csrf',
	'as' => 'language-chooser',
	'uses' => 'LocaleController@chooser'
));


/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}/{subs?}', ['uses' => 'PageController@index'])
	->where(['page' => '^((?!admin).)*$', 'subs' => '.*']);


