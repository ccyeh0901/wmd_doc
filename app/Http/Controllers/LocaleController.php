<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller {
	public function chooser (Request $request) {
		\Session::put('locale', $request->locale);
		return back();
	}
}