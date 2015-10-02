<?php

// 出货单主表

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliveryTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('bn'); // 出货单编码
            $table->string('real_bn'); // 出货单实际编码

            $table->string('ship_name'); // 客户
            $table->string('ship_addr'); // 客户地址
            $table->string('ship_mobile'); // 客户手机

            $table->timestamp('t_begin'); // 单据创建时间
            $table->timestamp('t_send'); // 单据结束时间
            $table->timestamp('t_confirm'); // 单据确认时间

            $table->integer('branch_id')->unsigned(); // 客户
            $table->integer('user_id')->unsigned(); // 业务员

            $table->string('money'); // 配送总额

            $table->enum('status', array(
                '1',
                // 配货中
                '2',
                // 配送中
                '3'
                // 已完成
            ));

            $table->enum('pay_status', array(
                '1',
                // 已支付
                '0'
                // 未支付
            ));

            $table->string('memo'); // 备注
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
        Schema::drop('delivery');
    }

}
