<?php

// 出货明细表

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliveryItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_items', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('delivery_id')->unsigned(); // 配送单ID
            $table->integer('branch_id')->unsigned(); // 客户
            $table->integer('good_id')->unsigned(); // 货品ID
            $table->integer('product_id')->unsigned(); // 货品批次ID
            $table->string('good_name'); // 货品名称
            $table->string('spec_info'); // 商品规格
            $table->integer('number'); // 配货数量
            $table->integer('presentation'); // 赠送数量
            $table->string('price'); // 配货价格
            $table->string('money'); // 配货总价
            $table->timestamp('life_date'); // 过期日期
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('delivery_items');
    }

}
