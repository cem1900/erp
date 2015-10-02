<?php

// 网点表

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name'); // 客户名称
            $table->integer('type_id')->unsigned(); // 客户类型
            $table->integer('area_id')->unsigned(); // 区域
            $table->integer('line_id')->unsigned(); // 线路
            $table->integer('user_id')->unsigned(); // 业务员
            $table->string('contact'); // 联系人
            $table->string('mobile'); // 手机
            $table->string('address'); // 地址
            $table->string('code'); // 客户编号
            $table->integer('day'); // 回访提醒间隔
            $table->timestamp('last_visit_at'); // 最后回访时间
            $table->timestamp('last_ship_at'); // 最后配送时间
            $table->integer('stock'); // 合同存量
            $table->string('memo'); // 备注
            $table->enum('check', array(
                '1',
                // 通过
                '0',
                // 审核
            ));

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
        Schema::drop('branch');
    }

}
