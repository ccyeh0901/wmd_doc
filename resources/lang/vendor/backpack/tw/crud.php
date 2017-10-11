<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Backpack Crud Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines are used by the CRUD interface.
	| You are free to change them to anything
	| you want to customize your views to better match your application.
	|
	*/

	// Forms
	'save_action_save_and_new'                => '存檔＆新增',
	'save_action_save_and_edit'               => '存檔＆繼續編輯',
	'save_action_save_and_back'               => '存檔＆回列表',
	'save_action_changed_notification'        => 'Default behaviour after saving has been changed.',

	// Create form
	'add'                                     => '新增',
	'back_to_all'                             => '回到所有',
	'cancel'                                  => '取消',
	'add_a_new'                               => '新增一個 ',

	// Edit form
	'edit'                                    => '編輯',
	'save'                                    => '儲存',

	// Revisions
	'revisions'                               => '歷史版本',
	'no_revisions'                            => 'No revisions found',
	'created_this'                            => 'created this',
	'changed_the'                             => 'changed the',
	'restore_this_value'                      => 'Restore this value',
	'from'                                    => 'from',
	'to'                                      => 'to',
	'undo'                                    => 'Undo',
	'revision_restored'                       => 'Revision successfully restored',
	'guest_user'                              => '訪客',

	// Translatable models
	'edit_translations'                       => 'EDIT TRANSLATIONS',
	'language'                                => 'Language',

	// CRUD table view
	'all'                                     => 'All ',
	'in_the_database'                         => 'in the database',
	'list'                                    => 'List',
	'actions'                                 => 'Actions',
	'preview'                                 => 'Preview',
	'delete'                                  => 'Delete',
	'admin'                                   => 'Admin',
	'details_row'                             => 'This is the details row. Modify as you please.',
	'details_row_loading_error'               => 'There was an error loading the details. Please retry.',

	// Confirmation messages and bubbles
	'delete_confirm'                          => 'Are you sure you want to delete this item?',
	'delete_confirmation_title'               => 'Item Deleted',
	'delete_confirmation_message'             => 'The item has been deleted successfully.',
	'delete_confirmation_not_title'           => 'NOT deleted',
	'delete_confirmation_not_message'         => "There's been an error. Your item might not have been deleted.",
	'delete_confirmation_not_deleted_title'   => 'Not deleted',
	'delete_confirmation_not_deleted_message' => 'Nothing happened. Your item is safe.',

	// DataTables translation
	'emptyTable'                              => '無資料',
	'info'                                    => '顯示 _START_ 至 _END_ 筆資料 / 共_TOTAL_筆',
	'infoEmpty'                               => 'Showing 0 to 0 of 0 entries',
	'infoFiltered'                            => '(filtered from _MAX_ total entries)',
	'infoPostFix'                             => '',
	'thousands'                               => ',',
	'lengthMenu'                              => '每頁 _MENU_ 筆',
	'loadingRecords'                          => '載入中...',
	'processing'                              => '處理中...',
	'search'                                  => '搜尋: ',
	'zeroRecords'                             => '找不到相符的',
	'paginate'                                => [
		'first'    => '最先',
		'last'     => '最後',
		'next'     => '下一頁',
		'previous' => '上一頁',
	],
	'aria'                                    => [
		'sortAscending'  => ': activate to sort column ascending',
		'sortDescending' => ': activate to sort column descending',
	],
	'export'                                  => [
		'copy'              => 'Copy',
		'excel'             => 'Excel',
		'csv'               => 'CSV',
		'pdf'               => 'PDF',
		'print'             => 'Print',
		'column_visibility' => 'Column visibility',
	],

	// global crud - errors
	'unauthorized_access'                     => 'Unauthorized access - you do not have the necessary permissions to see this page.',
	'please_fix'                              => 'Please fix the following errors:',

	// global crud - success / error notification bubbles
	'insert_success'                          => '資料送出成功！',
	'update_success'                          => '資料更新成功！',

	// CRUD reorder view
	'reorder'                                 => 'Reorder',
	'reorder_text'                            => 'Use drag&drop to reorder.',
	'reorder_success_title'                   => 'Done',
	'reorder_success_message'                 => 'Your order has been saved.',
	'reorder_error_title'                     => 'Error',
	'reorder_error_message'                   => 'Your order has not been saved.',

	// CRUD yes/no
	'yes'                                     => 'Yes',
	'no'                                      => 'No',

	// CRUD filters navbar view
	'filters'                                 => '過濾器',
	'toggle_filters'                          => '切換過濾器',
	'remove_filters'                          => '移除過濾器',

	// Fields
	'browse_uploads'                          => 'Browse uploads',
	'clear'                                   => 'Clear',
	'page_link'                               => 'Page link',
	'page_link_placeholder'                   => 'http://example.com/your-desired-page',
	'internal_link'                           => 'Internal link',
	'internal_link_placeholder'               => 'Internal slug. Ex: \'admin/page\' (no quotes) for \':url\'',
	'external_link'                           => 'External link',
	'choose_file'                             => 'Choose file',

	//Table field
	'table_cant_add'                          => 'Cannot add new :entity',
	'table_max_reached'                       => 'Maximum number of :max reached',

	// File manager
	'file_manager'                            => 'File Manager',
	'lang_switch'                             => '語言切換',
	'group_name'                              => '團名',
	'schedule_tab'                            => 'Schedule', //這個不能是中文
	'main_tab'                                => 'Main',
	'wait_for_group_validation' => '請耐心等候審核...'
];
