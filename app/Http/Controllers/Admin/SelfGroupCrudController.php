<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GroupRequest as StoreRequest;
use App\Http\Requests\GroupRequest as UpdateRequest;
use App\Models\Schedule;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Carbon\Carbon;

// VALIDATION: change the requests to match your own file names if you need form validation

class SelfGroupCrudController extends GroupCrudController
{
    public function setup()
    {

	    parent::setup();

	    $this->crud->setModel('App\Models\SelfGroup'); //指定model
	    $this->crud->setRoute(config('backpack.base.route_prefix') . '/selfgroup'); //指定路徑， admin/group

    }
}
