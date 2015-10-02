<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddEmptyToGoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('goods', function(Blueprint $table) {
            $table->integer('empty'); // 空瓶回收
            $table->integer('empty_unit'); // 多少箱空瓶兑换一箱
		});

        Schema::table('products', function(Blueprint $table) {
            $table->integer('empty'); // 空瓶回收
        });

        $table = Schema::getConnection()->getTablePrefix() . 'good_log';

        DB::statement("ALTER TABLE `" . $table . "` MODIFY COLUMN  `status`  ENUM('purchase', 'new', 'picking' , 'price', 'edit', 'damage', 'replacement', 'allocation', 'empty');");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('goods', function(Blueprint $table) {
            $table->dropColumn('empty', 'empty_unit');
		});

        Schema::table('products', function(Blueprint $table) {
            $table->dropColumn('empty');
        });

        $table = Schema::getConnection()->getTablePrefix() . 'good_log';

        DB::statement("ALTER TABLE `" . $table . "` MODIFY COLUMN  `status`  ENUM('purchase', 'new', 'picking' , 'price', 'edit', 'damage', 'replacement', 'allocation');");
	}

}
