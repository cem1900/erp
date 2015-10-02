<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGoodCapsuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('good_capsule', function(Blueprint $table) {
			$table->increments('id');

            $table->integer('good_id')->unsigned(); // 货品ID
            $table->integer('branch_id')->unsigned(); // 客户
            $table->integer('capsule'); // 瓶盖
            $table->string('price');  // 回收单价
            $table->string('money');  // 回收总价

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
		Schema::drop('good_capsule');
	}

}
