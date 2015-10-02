<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGoodDamageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('good_damage', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('good_id')->unsigned(); // 货品ID
            $table->integer('product_id')->unsigned(); // 货品批次ID
            $table->integer('damage'); // 损坏
            $table->string('damage_bn'); // 报损单
            $table->integer('user_id')->unsigned(); // 操作ID
            $table->timestamp('damage_time'); // 报损时间
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
		Schema::drop('good_damage');
	}

}
