<?php

// 商品表

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGoodsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name'); // 名称
            $table->string('barcode'); // 条形码
            $table->integer('purchase'); // 进货数量
            $table->integer('sell'); // 销售数量
            $table->integer('store'); // 库存
            $table->integer('damage'); // 损坏
            $table->integer('replacement'); // 换货
            $table->integer('unit'); // 每箱多少

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
        Schema::drop('goods');
    }

}
