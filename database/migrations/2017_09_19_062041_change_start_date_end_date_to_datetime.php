<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStartDateEndDateToDatetime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	    Schema::table('monsters', function ($table) {
		    $table->dateTime('start_date')->change();
		    $table->dateTime('end_date')->change();
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
	    Schema::table('monsters', function ($table) {
		    $table->date('start_date')->change();
		    $table->date('end_date')->change();
	    });

    }
}
