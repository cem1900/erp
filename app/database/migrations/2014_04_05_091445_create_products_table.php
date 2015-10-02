<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('good_id')->unsigned(); // 货品ID
            $table->integer('purchase'); // 进货数量
            $table->integer('sell'); // 销售数量
            $table->integer('store'); // 库存
            $table->integer('damage'); // 损坏
            $table->integer('replacement'); // 换货
            $table->string('cost'); // 进货价格
            $table->string('price'); // 销售价格

            $table->timestamp('production_date'); // 生产日期
            $table->integer('life'); // 保质期
            $table->timestamp('cost_date'); // 进货日期
            $table->timestamp('life_date'); // 过期日期
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
        Schema::drop('products');
    }

}
