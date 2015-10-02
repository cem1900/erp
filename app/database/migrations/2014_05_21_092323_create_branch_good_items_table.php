<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchGoodItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('branch_good_items', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('good_id')->unsigned(); // 货品ID
            $table->integer('branch_id')->unsigned(); // 客户
            $table->integer('sell'); // 销售数量
            $table->integer('empty'); // 空瓶回收
            $table->integer('capsule'); // 瓶盖回收
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
		Schema::drop('branch_good_items');
	}

}
