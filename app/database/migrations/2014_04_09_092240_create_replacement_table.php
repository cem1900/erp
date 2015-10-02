<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReplacementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('replacement', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('branch_id')->unsigned(); // 客户
            $table->integer('good_id')->unsigned(); // 货品ID
            $table->integer('product_id')->unsigned(); // 货品批次ID
            $table->integer('delivery_id')->unsigned(); // 配送单ID
            $table->integer('new_product_id')->unsigned(); // 新货品批次ID
            $table->integer('product_num'); // 换货数量
            $table->integer('user_id')->unsigned(); // 操作ID
            $table->timestamp('alttime'); // 操作时间
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('replacement');
	}

}
