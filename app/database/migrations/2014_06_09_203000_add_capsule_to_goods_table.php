<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCapsuleToGoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('goods', function(Blueprint $table) {
            $table->string('capsule_unit'); // 瓶盖回收
        });

        $table = Schema::getConnection()->getTablePrefix() . 'good_log';

        DB::statement("ALTER TABLE `" . $table . "` MODIFY COLUMN  `status`  ENUM('purchase', 'new', 'picking' , 'price', 'edit', 'damage', 'replacement', 'allocation', 'empty', 'capsule');");
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('goods', function(Blueprint $table) {
            $table->dropColumn('capsule_unit');
        });

        $table = Schema::getConnection()->getTablePrefix() . 'good_log';

        DB::statement("ALTER TABLE `" . $table . "` MODIFY COLUMN  `status`  ENUM('purchase', 'new', 'picking' , 'price', 'edit', 'damage', 'replacement', 'allocation', 'empty');");
	}

}
