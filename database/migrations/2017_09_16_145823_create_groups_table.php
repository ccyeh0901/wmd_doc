<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name')->nullable();  //團名
	        $table->tinyInteger('type')->nullable(); //出團類型：中央團、教會團、工作隊
	        $table->integer('parent_id')->unsigned()->nullable(); //多層式設計
	        $table->integer('category_id')->unsigned()->nullable(); //屬於哪個分類
	        $table->integer('article_id')->unsigned()->nullable(); //屬於哪篇文章
	        $table->integer('tag_id')->unsigned()->nullable(); //屬於哪個分類

	        $table->date('arriving_date')->nullable(); //入境日期
	        $table->date('leaving_date')->nullable(); //出境日期
	        $table->date('wmd_visit_from')->nullable(); //進入月明洞日期
	        $table->date('wmd_visit_end')->nullable(); //離開月明洞日期

	        $table->integer('estimated_number')->nullable(); // 預計人數
//	        $table->integer('stay_days')->nullable(); // 停留天數
	        $table->string('leader_name')->nullable(); //團長姓名
	        $table->tinyInteger('contact_method')->nullable(); //聯絡方式
	        $table->integer('user_id')->unsigned()->nullable(); //是誰開團的

	        $table->text('schedule')->nullable();  //行程
	        $table->text('description')->nullable(); //備註、說明...

	        $table->boolean('verified')->nullable(); //是否通過審核
	        $table->string('apply_url')->nullable(); //報名網址

            $table->timestamps();
        });

	    Schema::create('group_tag', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('group_id')->unsigned();
		    $table->integer('tag_id')->unsigned();
		    $table->nullableTimestamps();
		    $table->softDeletes();
	    });

	    Schema::create('group_article', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('group_id')->unsigned();
		    $table->integer('article_id')->unsigned();
		    $table->nullableTimestamps();
		    $table->softDeletes();
	    });

	    Schema::create('group_category', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('group_id')->unsigned();
		    $table->integer('category_id')->unsigned();
		    $table->nullableTimestamps();
		    $table->softDeletes();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('groups');
	    Schema::drop('group_tag');
	    Schema::drop('group_article');
	    Schema::drop('group_category');


    }
}
