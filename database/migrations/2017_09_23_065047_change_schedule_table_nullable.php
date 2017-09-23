<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeScheduleTableNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		    Schema::table('schedules', function (Blueprint $table) {
			    $table->text('schedule')->nullable()->change();
		    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
	    Schema::table('schedules', function (Blueprint $table) {
		    $table->text('schedule')->nullable(false)->change();
	    });
    }
}
