<?php
/**
 * Created by PhpStorm.
 * User: ccyeh0901
 * Date: 16/09/2017
 * Time: 10:51 AM
 */

//團的新增編輯刪除...等操作
Route::resource('group', 'GroupController');

Route::get(config('backpack.base.route_prefix').'/dashboard', 'DashboardController@index'); //這邊客製化 dashboard 套用自己的Controller
