<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GroupRequest as StoreRequest;
use App\Http\Requests\GroupRequest as UpdateRequest;
use App\Models\Schedule;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Carbon\Carbon;

// VALIDATION: change the requests to match your own file names if you need form validation

class GroupCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Group'); //指定model
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/group'); //指定路徑， admin/group
        $this->crud->setEntityNameStrings('group', 'groups'); //設定 db的表格名稱， 要複數

//        $this->crud->setListView('backpack::crud.different_list', $this->data); //用setListView 改成不同的view

//	    $this->crud->setListView('backpack::crud.schedule_list', $this->data); //用setListView 改成不同的view
//	    $this->crud->setEditView('backpack::crud.schedule_edit', $this->data);
//	    $this->crud->setCreateView('backpack::crud.schedule_create', $this->data);


//	    $this->crud->addField([
//		    // MANDATORY
//		    'name'  => 'address', // DB column name (will also be the name of the input)
//		    'label' => 'Street address', // the human-readable label for the input
//		    'type'  => 'text', // the field type (text, number, select, checkbox, etc)
//
//		    // OPTIONAL + example values
//		    'default'    => '', // default value
//		    'hint'       => '一些提示的文字', // helpful text, show up after input
//		    'attributes' => [
//			    'placeholder' => '當空的時候的文字',
//			    'class' => 'form-control some-class'
//		    ], // extra HTML attributes and values your input might need
//		    'wrapperAttributes' => [
//			    'class' => 'form-group col-md-12 rywrapper'
//		    ] // extra HTML attributes for the field wrapper - mostly for resizing fields using the bootstrap column classes
//	    ]);

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

//        $this->crud->setFromDb();



	    $this->crud->addColumn('name'); // add a text column, at the end of the stack
	    $this->crud->addColumn('type'); // add a single column, at the end of the stack
	    $this->crud->addColumn('wmd_visit_from'); // add a single column, at the end of the stack

	    $this->crud->addColumn([
		    'name' => 'verified', // The db column name
		    'label' => "是否通過審核", // Table column heading
		    'type' => 'Radio',
		    'options'     => [
			    0 => "否",
			    1 => "是"
		    ]
	    ]);



	    $this->crud->addField([
		    'name'  => 'name',
		    'label' => trans('backpack::crud.group_name'),
		    'type'  => 'text',
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);


	    $this->crud->addField([ // select_from_array  //從既有的選項（非db table）當中讓user選擇！
		    'name'        => 'type',
		    'label'       => '類型',
		    'type'        => 'select2_from_array',
		    'options'     => ['0' => '中央團', '1' => '教會團', '2' => '工作隊'],
		    'allows_null' => false,
		    'tab'   => trans('backpack::crud.main_tab')
		    // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
	    ]);


	    $this->crud->addField([ // select_from_array  //從既有的選項（非db table）當中讓user選擇！
		    'name'        => 'type',
		    'label'       => '類型',
		    'type'        => 'select2_from_array',
		    'options'     => ['0' => '中央團', '1' => '教會團', '2' => '工作隊'],
		    'allows_null' => false,
		    'tab'   => trans('backpack::crud.main_tab')
		    // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
	    ]);


	    $this->crud->addField([ // Date_range
		    'name'               => 'date_range1', // a unique name for this field
		    'start_name'         => 'arriving_date', // the db column that holds the start_date
		    'end_name'           => 'leaving_date', // the db column that holds the end_date
		    'label'              => '韓國出入境時間',
		    'type'               => 'date_range',
		    // OPTIONALS
		    'start_default'      => Carbon::now(), // default value for start_date
		    'end_default'        => Carbon::now(), // default value for end_date
		    'date_range_options' => [ // options sent to daterangepicker.js
			    'timePicker' => true,
			    'locale'     => ['format' => 'YYYY-MM-DD HH:mm'],
		    ],
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);


	    $this->crud->addField([ // Date_range
		    'name'               => 'date_range2', // a unique name for this field
		    'start_name'         => 'wmd_visit_from', // the db column that holds the start_date
		    'end_name'           => 'wmd_visit_end', // the db column that holds the end_date
		    'label'              => '月明洞停留期間',
		    'type'               => 'date_range',
		    // OPTIONALS
		    'start_default'      => Carbon::now(), // default value for start_date
		    'end_default'        => Carbon::now(), // default value for end_date
		    'date_range_options' => [ // options sent to daterangepicker.js
			    'timePicker' => true,
			    'locale'     => ['format' => 'YYYY-MM-DD HH:mm'],
		    ],
		    'attributes'       => ['id' => 'wmd_visit_period'],
		    //'wrapperAttributes' => ['class' => 'wmd_visit_range'],
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);


	    $this->crud->addField([   // Number
		    'name'  => 'estimated_number',
		    'label' => '預估人數',
		    'type'  => 'number',
		    // optionals
		    // 'attributes' => ["step" => "any"], // allow decimals
		    // 'prefix' => "$",
		    // 'suffix' => ".00",
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);


	    $this->crud->addField([
		    'name'  => 'leader_name',
		    'label' => '團長姓名',
		    'type'  => 'text',
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);


	    $this->crud->addField([ // select_from_array  //從既有的選項（非db table）當中讓user選擇！
		    'name'        => 'contact_method',
		    'label'       => '聯絡方式',
		    'type'        => 'select2_from_array',
		    'options'     => ['0' => '手機', '1' => 'Kaokaotalk', '2' => 'Line'],
		    'allows_null' => false,
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);


	    $this->crud->addField([   // 編輯器，big64
		    'name'  => 'description',
		    'label' => '訪韓團描述',
		    'type'  => 'summernote',
		    //'options' => ['height' => 150],
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);


	    $this->crud->addField([
		    'name'    => 'verified', // the name of the db column
		    'label'   => '通過審核與否', // the input label
		    'type'    => 'radio',
		    'options' => [ // the key will be stored in the db, the value will be shown as label;
			    0 => '未通過',
			    1 => '已通過',
		    ],
		    // optional
		    'inline'  => true, // show the radios all on the same line?
		    'tab'   => trans('backpack::crud.main_tab')

	    ]);


	    $this->crud->addField([   // URL
		    'name' => 'apply_url',
		    'label' => '報名網址',
		    'type' => 'url',
		    'attributes' => ['disabled' => 'disabled'],
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);


	    $this->crud->addField([ // select_from_array  //從既有的選項（非db table）當中讓user選擇！
		    'name'            => 'schedule',
		    'label'           => '行程規劃',
		    'type'            => 'schedule_select_from_array', //自訂的欄位， 裡頭 有所有的行程菜單的選項，會根據日期變動，然後調整行程選單
		    'options'         => '',  // 這邊帶入空字串，因為options需要客製！ 之後在edit 那邊帶入
		    'allows_null'     => false,
		    'tab'             => trans('backpack::crud.schedule_tab'),
//		    'attributes'       => ['class' => 'nth_day'],
		    'wrapperAttributes' => ['class' => 'sub_schedule'],
		    'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
	    ]);


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

    public function update(UpdateRequest $request) //整個替換掉！
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

	    /*
	     * 將使用者選擇的項目 做成 json 存進db
	     * 1. 先做出未選擇前的所有結果
	     * 2. 根據user選擇的把對應項目checked設成true
	     * 3. 轉成json array 存進db
	     * */

	    $datediff = strtotime($request->get('wmd_visit_end')) - strtotime($request->get('wmd_visit_from'));
	    $diffday = floor($datediff / (60 * 60 * 24))+1; // 算出待在月明洞幾天

	    $schedule = Schedule::first()->schedule; //調出菜單，算出有幾個時段
	    $sect_num = count(reset($schedule));


	    //預備空的行程菜單array, 用日期當作index
	    for($i=0; $i<$diffday; $i++) {  // 哪一天
		    $_d = strtotime("+".$i." day", strtotime($request->get('wmd_visit_from')));
		    $date_index = date("Y-m-d", $_d);
		    $tmp[$date_index] = null;

		    for($j=0; $j<$sect_num; $j++) {  //哪個時段

//			    $tmp[$date_index][] = null;
			    $tmp[$date_index][] = reset($schedule)[$j];  //從$schedul那邊複製過來


			    if (!is_null($request->get($date_index . 'sect' . $j)))  //取得user的選擇 填寫進菜單裡頭
			    {
				    foreach ($request->get($date_index . 'sect' . $j) as $item)
				    {
					    $tmp[$date_index][$j]['value'][$item]['checked'] = true;
				    }
			    }
		    }
	    }

//	    $request['schedule'] = json_encode($tmp);
	    $request['schedule'] = json_encode($tmp, JSON_UNESCAPED_SLASHES);
//	    $request['schedule'] = json_encode($tmp);

	    // update the row in the db
	    $item = $this->crud->update($request->get($this->crud->model->getKeyName()),
		    $request->except('save_action', '_token', '_method'));
	    $this->data['entry'] = $this->crud->entry = $item;

	    // show a success message
	    \Alert::success(trans('backpack::crud.update_success'))->flash();

	    // save the redirect choice for next time
	    $this->setSaveAction();

	    return $this->performSaveAction($item->getKey());
    }

	public function edit($id)
	{
		$this->crud->hasAccessOrFail('update');

		// get the info for that entry
		$this->data['entry'] = $this->crud->getEntry($id);
		$this->data['sch_menu'] = Schedule::first()->schedule; // 菜單的config 直接帶進去 options 目前暫時只用第一組菜單， 其他的先不管！
		$this->data['crud'] = $this->crud;
		$this->data['saveAction'] = $this->getSaveAction();
		$this->data['fields'] = $this->crud->getUpdateFields($id);
		$this->data['title'] = trans('backpack::crud.edit').' '.$this->crud->entity_name;

		$this->data['id'] = $id;

		// load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
		return view($this->crud->getEditView(), $this->data);
    }

	public function create()
	{
		$this->crud->hasAccessOrFail('create');

		// prepare the fields you need to show
		$this->data['crud'] = $this->crud;
		$this->data['saveAction'] = $this->getSaveAction();
		$this->data['fields'] = $this->crud->getCreateFields();
		$this->data['title'] = trans('backpack::crud.add').' '.$this->crud->entity_name;

		$this->data['sch_menu'] = Schedule::first()->schedule; // 菜單的config 直接帶進去 options 目前暫時只用第一組菜單， 其他的先不管！

		// load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
		return view($this->crud->getCreateView(), $this->data);
	}
}
