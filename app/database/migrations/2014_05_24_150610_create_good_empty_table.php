<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGoodEmptyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('good_empty', function(Blueprint $table) {
			$table->increments('id');

            $table->enum('mode', array(
                '1',
                // 空瓶换酒
                '2',
                // 空瓶换钱
                '3'
                // 直接退瓶
            ));

            $table->integer('good_id')->unsigned(); // 货品ID
            $table->integer('branch_id')->unsigned(); // 客户
            $table->integer('empty'); // 空瓶回收
            $table->string('money');  // 回收价

            $table->integer('delivery_id')->unsigned(); // 配送单ID

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
		Schema::drop('good_empty');
	}

}
