<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en_passport');  //團員姓名
	        $table->string('name_kr');  //團員姓名
	        $table->string('name_tw');  //團員姓名
	        $table->string('passport_no');  //護照號碼
	        $table->tinyInteger('sex');
	        $table->date('birthday');  //生日
	        $table->tinyInteger('dept');  //部門
	        $table->tinyInteger('belongto_church'); //所屬教會
	        $table->boolean('newbie'); //是否為新生
	        $table->text('note'); //備註
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('members');
    }
}
