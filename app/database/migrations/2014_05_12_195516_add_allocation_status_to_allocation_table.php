<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAllocationStatusToAllocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('allocation', function(Blueprint $table) {
            $table->enum('allocation_status', array(
                '0',
                // 未确认
                '1',
                // 已确认
            ));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('allocation', function(Blueprint $table) {
            $table->dropColumn('allocation_status');
		});
	}

}
