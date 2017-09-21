<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ScheduleRequest as StoreRequest;
use App\Http\Requests\ScheduleRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation

class ScheduleCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Schedule');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/schedule');
        $this->crud->setEntityNameStrings('schedule', 'schedules');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

//        $this->crud->setFromDb();
	    $this->crud->addField([   // 行程規劃
		    'name'          => 'schedule',
		    'label'         => '行程規劃',
		    'type'          => 'schedule_menu',
		    // optional
		    'store_as_json' => true,
	    ]);
	    $this->crud->addColumn('schedule'); // add a single column, at the end of the stack


	    $this->crud->setListView('backpack::crud.schedule_list', $this->data); //用setListView 改成不同的view
	    $this->crud->setEditView('backpack::crud.schedule_edit', $this->data);
	    $this->crud->setCreateView('backpack::crud.schedule_create', $this->data);




        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
	    $this->crud->hasAccessOrFail('update');

	    // fallback to global request instance
	    if (is_null($request)) {
		    $request = \Request::instance();
	    }

	    // replace empty values with NULL, so that it will work with MySQL strict mode on
	    foreach ($request->input() as $key => $value) {
		    if (empty($value) && $value !== '0') {
			    $request->request->set($key, null);
		    }
	    }

	    // update the row in the db 更新在資料庫的資料

	    //json 第一層（行程1) 第二層(清晨、早餐、上午、下午）不需要變動

	    $tmp = json_decode($request->get('schedule'), true);

	    foreach ($tmp as &$it)
	    {
		    foreach($it as $k => &$v){
			    $v['value'] = null; //重置該時段所有行程

		    	switch($v['name']) {
				    case 'dawn':
						/*將使用者填寫的內容 一個一個塞進去*/
				    	foreach($request->get('dawn') as $i){
				    		$tobe_inserted['name'] = $i;
						    $tobe_inserted['checked'] = false;
				    		$v['value'][] = $tobe_inserted;
					    }
				    	break;
				    case 'breakfast':
					    foreach($request->get('breakfast') as $i){
						    $tobe_inserted['name'] = $i;
						    $tobe_inserted['checked'] = false;
						    $v['value'][] = $tobe_inserted;
					    }
				    	break;
				    case 'morning':
					    foreach($request->get('morning') as $i){
						    $tobe_inserted['name'] = $i;
						    $tobe_inserted['checked'] = false;
						    $v['value'][] = $tobe_inserted;
					    }

					    break;
				    case 'afternoon':
					    foreach($request->get('afternoon') as $i){
						    $tobe_inserted['name'] = $i;
						    $tobe_inserted['checked'] = false;
						    $v['value'][] = $tobe_inserted;
					    }
					    break;
				    default:
			    }
		    }
		}

		/*現在$tmp就是我們要的東西了*/

//		$request->set('schedule', json_encode($tmp));

	    $request['schedule'] = json_encode($tmp);

	    /*回傳的 $item 是一個 Schedule model*/
	    $item = $this->crud->update($request->get($this->crud->model->getKeyName()), $request->except('save_action', '_token', '_method'));
	    $this->data['entry'] = $this->crud->entry = $item;

	    // show a success message
	    \Alert::success(trans('backpack::crud.update_success'))->flash(); //秀出存檔成功的訊息

	    // save the redirect choice for next time
	    $this->setSaveAction();  //將此次的save動作記起來 以便下次可以沿用～

	    return $this->performSaveAction($item->getKey()); // performSaveAction 判斷save action 是什麼，然後導向到相關的連結去


    }



	public function index()
	{


		// your additional operations before save here
		$redirect_location = parent::index();

		// your additional operations after save here
		// use $this->data['entry'] or $this->crud->entry



//		$sch_array = $this->data['entries']->first()->schedule;

		//todo: 做出行程的列表出來將 schedule 裡頭僅有一筆的紀錄撈出來即可，分析 裡頭的json 然後把各個行程套餐撈出來～


		return $redirect_location;
	}
}
