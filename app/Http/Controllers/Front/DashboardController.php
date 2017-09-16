<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

	public function index() {
		$someVar = 'Some text';
		return view('vendor.backpack.base.dashboard', compact('someVar'));
	}
}
