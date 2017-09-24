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
	        $table->unsignedInteger('group_id');//屬於哪個團
	        $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

	        $table->unsignedInteger('user_id')->nullable();// 是誰報名的 (一個user可能同時報名兩個member以上，幫別人報名，nullable 代表 可以直接報名， 不需要歸屬於哪個user）
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
