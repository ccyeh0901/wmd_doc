<?php

namespace App\Http\Controllers\Admin;

use App\Models\Schedule;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\MemberRequest as StoreRequest;
use App\Http\Requests\MemberRequest as UpdateRequest;

class MemberCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Member');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/member');
        $this->crud->setEntityNameStrings('member', 'members');

//	    $this->crud->setCreateView('backpack::crud.calendar', $this->data);

	    $this->crud->setCreateView('backpack::crud.member_create', $this->data);

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

//        $this->crud->setFromDb();

	    $this->crud->addColumn([
		    'name' => 'id', // The db column name
		    'label' => "編號", // Table column heading
	    ]); // add a text column, at the end of the stack




	    $this->crud->addColumn([
		    'name' => 'name_tw', // The db column name
		    'label' => "中文姓名", // Table column heading
	    ]); // add a text column, at the end of the stack

	    $this->crud->addColumn([
		    'name' => 'name_en_passport', // The db column name
		    'label' => "英文姓名", // Table column heading
	    ]); // add a text column, at the end of the stack

	    $this->crud->addColumn([
		    'name' => 'name_kr', // The db column name
		    'label' => "韓文姓名", // Table column heading
	    ]); // add a text column, at the end of the stack

	    $this->crud->addColumn([
		    'name' => 'sex', // The db column name
		    'label' => "性別", // Table column heading
		    'type' => 'radio',
		    'options'     => [
			    0 => "女",
			    1 => "男",
		    ]
	    ]); // add a single column, at the end of the stack

	    $this->crud->addColumn([
		    'name' => 'birthday', // The db column name
		    'label' => "生日", // Table column heading
		    'type' => 'text'
	    ]);


	    $this->crud->addColumn([
		    // 1-n relationship
		    'label' => "參加團名稱", // Table column heading
		    'type' => "select",
		    'name' => 'group_id', // the column that contains the ID of that connected entity;
		    'entity' => 'group', // the method that defines the relationship in your Model
		    'attribute' => "name", // foreign key attribute that is shown to user
		    'model' => "App\Models\Group", // foreign key model
	    ]);



	    /* ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝ 我是分隔線 */



	    $this->crud->addField([    // SELECT2 （跟SELECT 是一樣的 只是長得比較好看而已，可以跳過！）
		    'label'     => '欲參加的團',
		    'type'      => 'select2',
		    'name'      => 'group_id',
		    'entity'    => 'group', // Member::group() //// the method that defines the relationship in your Model
		    'attribute' => 'name',
		    'model'     => "App\Models\VerifiedGroup",
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);

	    $this->crud->addField([
		    'name'  => 'name_en_passport',
		    'label' => "護照英文姓名",
		    'type'  => 'text',
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);

	    $this->crud->addField([
		    'name'  => 'name_tw',
		    'label' => "中文姓名",
		    'type'  => 'text',
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);

	    $this->crud->addField([
		    'name'  => 'name_kr',
		    'label' => "韓文姓名",
		    'type'  => 'text',
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);

	    $this->crud->addField([
		    'name'  => 'passport_no',
		    'label' => "護照號碼",
		    'type'  => 'text',
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);


	    $this->crud->addField([ // select_from_array  //從既有的選項（非db table）當中讓user選擇！
		    'name'        => 'sex',
		    'label'       => '性別',
		    'type'        => 'select2_from_array',
		    'options'     => ['0' => '女', '1' => '男'],
		    'allows_null' => false,
		    'tab'   => trans('backpack::crud.main_tab')
		    // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
	    ]);


	    $this->crud->addField([   // Date
		    'name'                => 'birthday',
		    'label'               => '生日',
		    'type'                => 'date_picker',
		    // optional:
		    'date_picker_options' => [
			    'todayBtn' => true,
			    'format'   => 'yyyy-mm-dd',
			    'language' => 'zh-TW',
		    ],
		    // 'wrapperAttributes' => ['class' => 'col-md-6'],
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);


	    $this->crud->addField([ // select_from_array  //從既有的選項（非db table）當中讓user選擇！
		    'name'        => 'dept',
		    'label'       => '所屬部門',
		    'type'        => 'select2_from_array',
		    'options'     => ['0' => '聖職者', '1' => '長年部', '2' => '家庭局', '3' => '家庭局', '4' => '青年部', '5' => 'Campus', '6' => 'SS', '7' => '幼初等部'],
		    'allows_null' => false,
		    'tab'   => trans('backpack::crud.main_tab')
		    // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
	    ]);

	    $this->crud->addField([ // select_from_array  //從既有的選項（非db table）當中讓user選擇！
		    'name'        => 'belongto_church',
		    'label'       => '所屬教會',
		    'type'        => 'select2_from_array',
		    'options'     => ['0' => '主希望光', '1' => '信榮', '2' => '主析', '3' => '主大明', '4' => '主信心', '5' => '主大勇', '6' => '和平', '7' => '迦南'],
		    'allows_null' => false,
		    'tab'   => trans('backpack::crud.main_tab')
		    // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
	    ]);


	    $this->crud->addField([   // Checkbox
		    'name' => 'newbie',
		    'label' => '是否為新生',
		    'type' => 'checkbox',
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);


	    $this->crud->addField([   // 編輯器，big64
		    'name'  => 'note',
		    'label' => '備註',
		    'type'  => 'summernote',
		    //'options' => ['height' => 150],
		    'tab'   => trans('backpack::crud.main_tab')
	    ]);

//	    $this->crud->addField([   // CustomHTML
//		    'name' => 'calendar',
//		    'type' => 'custom_html',
//		    'value' => '<input name="rycalendar" type="hidden" value="0">',
//		    'tab'             => trans('backpack::crud.schedule_tab')
//	    ]);


//	    $this->crud->addField([ // select_from_array  //從既有的選項（非db table）當中讓user選擇！
//		    'name'            => 'schedule',
//		    'label'           => '行程規劃',
//		    'type'            => 'schedule_select_from_array', //自訂的欄位， 裡頭 有所有的行程菜單的選項，會根據日期變動，然後調整行程選單
//		    'options'         => '',  // 這邊帶入空字串，因為options需要客製！ 之後在edit 那邊帶入
//		    'allows_null'     => false,
//		    'tab'             => trans('backpack::crud.schedule_tab'),
//		    'wrapperAttributes' => ['class' => 'sub_schedule'],
//		    'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
//	    ]);
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
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }


	public function create()
	{
		$this->crud->hasAccessOrFail('create');

		// prepare the fields you need to show
		$this->data['crud'] = $this->crud;
		$this->data['saveAction'] = $this->getSaveAction();
		$this->data['fields'] = $this->crud->getCreateFields();
		$this->data['title'] = trans('backpack::crud.add').' '.$this->crud->entity_name;

		// load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
		return view($this->crud->getCreateView(), $this->data);
	}

	public function createByGroup($group_id)
	{

		$this->crud->hasAccessOrFail('create');

		$this->crud->removeField('group_id');


		$this->crud->addField([    // SELECT2 （跟SELECT 是一樣的 只是長得比較好看而已，可以跳過！）
			'label'     => '欲參加的團',
			'type'      => 'select2',
			'name'      => 'group_id',
			'entity'    => 'group', // Member::group() //// the method that defines the relationship in your Model
			'attribute' => 'name',
			'model'     => "App\Models\VerifiedGroup",
			'tab'   => trans('backpack::crud.main_tab')
		]);

		// prepare the fields you need to show
		$this->data['crud'] = $this->crud;
		$this->data['saveAction'] = $this->getSaveAction();
		$this->data['fields'] = $this->crud->getCreateFields();
		$this->data['title'] = trans('backpack::crud.add').' '.$this->crud->entity_name;


		// load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
		return view($this->crud->getCreateView(), $this->data);



	}
}
