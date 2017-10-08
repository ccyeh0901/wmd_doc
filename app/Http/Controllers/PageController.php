<?php

namespace App\Http\Controllers;

use Backpack\MenuCRUD\app\Models\MenuItem;
use Backpack\PageManager\app\Models\Page;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
	public function index($slug)
	{
		$page = Page::findBySlug($slug);

		if (!$page)
		{
			abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
		}

		$this->data['title'] = $page->title;
		$this->data['page'] = $page->withFakes();
		$this->data['menu_items'] = MenuItem::getTree();

		return view('pages.'.$page->template, $this->data);
	}
}