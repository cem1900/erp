<?php

// 货品日志表

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGoodLogTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_log', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('good_id')->unsigned(); // 货品ID
            $table->integer('product_id')->unsigned(); // 货品批次ID
            $table->integer('user_id')->unsigned(); // 操作ID
            $table->string('user_name'); // 操作人
            $table->timestamp('alttime'); // 操作时间

            $table->enum('status', array(
                'purchase',
                // 进货
                'new',
                // 新增
                'picking',
                // 出货
                'price',
                // 改价
                'edit',
                // 修改
                'damage',
                // 报损
                'replacement',
                // 换货
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
        Schema::drop('good_log');
    }

}
