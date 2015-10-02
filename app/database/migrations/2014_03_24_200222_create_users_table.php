<?php

// 员工表

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('mobile');
            $table->enum('grade', array(
                '1',
                // 超管
                '5',
                // 财务管理员
                '6',
                // 仓库管理员
                '7',
                // 审核管理员
                '10'
                // 业务员
            ));
            $table->enum('disable', array(
                '0',
                // 启用
                '1'
                // 禁用
            ));
            $table->timestamp('last_signin_at');
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
        Schema::drop('users');
    }

}
