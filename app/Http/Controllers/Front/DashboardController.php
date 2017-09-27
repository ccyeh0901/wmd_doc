<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;

class DashboardController extends CrudController
{
    //

	public function index() {
		$someVar = 'Some text';

		$groups = Group::all()->toArray();
		return view('vendor.backpack.base.calendar', compact('groups'));
	}
}
