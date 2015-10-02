<?php

// 客户预存关系表

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchGoodTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_good', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('branch_id')->unsigned(); // 客户
            $table->enum('pay_status', array(
                '0',
                // 未付款
                '1'
                // 已付款
            ));
            $table->integer('stock'); // 合同存量
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
        Schema::drop('branch_good');
    }

}
