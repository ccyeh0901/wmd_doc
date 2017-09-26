<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;

class DashboardController extends CrudController
{
    //

	public function index() {
		$someVar = 'Some text';
		return view('vendor.backpack.base.calendar', compact('someVar'));
	}
}
