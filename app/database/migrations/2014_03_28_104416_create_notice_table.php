<?php

// 用户提醒

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNoticeTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned(); // 用户
            $table->enum('type', array(
                '1',
                // 提醒进货
                '2',
                // 提醒回访
                '3',
                // 提醒销售
                '4',
                // 提醒过期
                '5',
                // 客户商品提醒
            ));

            $table->string('content'); // 内容
            $table->string('data'); // 数据

            $table->enum('read', array(
                '1',
                // 已读
                '0'
                // 未读
            ));

            $table->timestamp('timeline'); // 提醒时间

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notice');
    }

}
