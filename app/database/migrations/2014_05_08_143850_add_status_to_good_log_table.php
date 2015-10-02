<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStatusToGoodLogTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = Schema::getConnection()->getTablePrefix() . 'good_log';

        DB::statement("ALTER TABLE `" . $table . "` MODIFY COLUMN  `status`  ENUM('purchase', 'new', 'picking' , 'price', 'edit', 'damage', 'replacement', 'allocation');");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = Schema::getConnection()->getTablePrefix() . 'good_log';

        DB::statement("ALTER TABLE `" . $table . "` MODIFY COLUMN  `status`  ENUM('purchase', 'new', 'picking' , 'price', 'edit', 'damage', 'replacement');");

    }

}
