<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAllocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('allocation', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('good_id')->unsigned(); // 货品
            $table->integer('to_product_id')->unsigned(); // 新批次
            $table->integer('from_product_id')->unsigned(); // 原始批次
            $table->integer('to_warehouse_id')->unsigned(); // 新仓
            $table->integer('from_warehouse_id')->unsigned(); // 原始仓
            $table->integer('num'); // 调拨数量
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
		Schema::drop('allocation');
	}

}
