<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddEmptyToDeliveryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('delivery', function(Blueprint $table) {
            $table->enum('type', array(
                '0',
                // 普通发货单
                '1',
                // 空瓶兑换
                '2',
                // 预留
                '3',
                // 预留
                '4',
                // 预留
                '5',
                // 预留
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
		Schema::table('delivery', function(Blueprint $table) {
            $table->dropColumn('type');
		});
	}

}
