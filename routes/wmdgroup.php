<?php
/**
 * Created by PhpStorm.
 * User: ccyeh0901
 * Date: 16/09/2017
 * Time: 10:51 AM
 */

//團的新增編輯刪除...等操作
Route::resource('groups', 'GroupController');



//Route::group([
//	'prefix'     => 'group',
//	'middleware' => ['admin'],
//	'namespace'  => 'Front',
//], function () {
//	// CRUD resources and other admin routes
//	CRUD::resource('wmdgroup', 'GroupCrudController');
//});