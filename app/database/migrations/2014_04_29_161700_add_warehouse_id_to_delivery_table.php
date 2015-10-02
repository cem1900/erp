<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddWarehouseIdToDeliveryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('delivery', function(Blueprint $table) {
            $table->integer('warehouse_id')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('delivery', function(Blueprint $table) {
            $table->dropColumn('warehouse_id');
		});
	}

}
