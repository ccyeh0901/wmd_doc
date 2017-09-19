<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class ChangeGroupDateToDatetime extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

		Schema::table('groups', function ($table) {
			$table->dateTime('arriving_date')->change();
			$table->dateTime('leaving_date')->change();
			$table->dateTime('wmd_visit_from')->change();
			$table->dateTime('wmd_visit_end')->change();
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
		Schema::table('groups', function ($table) {
			$table->date('arriving_date')->change();
			$table->date('leaving_date')->change();
			$table->date('wmd_visit_from')->change();
			$table->date('wmd_visit_end')->change();
		});


	}
}
