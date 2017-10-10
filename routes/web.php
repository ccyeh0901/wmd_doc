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

use Backpack\MenuCRUD\app\Models\MenuItem;
use Backpack\PageManager\app\Models\Page;

Route::get('/', function () {
	$this->data['menu_items'] = MenuItem::getTree();

	$page = Page::findBySlug('/');
	$this->data['page'] = $page;

//	$this->data['page'] = new stdClass();
//	$this->data['page']->title = '訪韓行政網';
//	$this->data['page']->content = '愛與空提的黃金時代';

	return view('pages.homepage', $this->data);
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

	CRUD::resource('selfgroup', 'SelfGroupCrudController');

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

Route::get('event', function () {
	return view('index');
});

Route::resource('items', 'ItemController', ['except' => ['create', 'edit']]);//排除掉create和edit操作


/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}/{subs?}', ['uses' => 'PageController@index'])->where(['page' => '^((?!admin).)*$|^((?!tracy/bar).)*$', 'subs' => '.*']);



