<?php

// 回访表

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visit', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('branch_id')->unsigned();   // 网点
            $table->integer('user_id')->unsigned();     // 业务员
            $table->string('comment');      // 回访内容
            $table->timestamp('visit_at');  // 最后回访时间
            $table->enum('check', array(
                '0',
                // 未审核
                '1'
                // 审核通过
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
		Schema::drop('visit');
	}

}
