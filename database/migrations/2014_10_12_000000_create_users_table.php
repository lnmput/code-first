<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedTinyInteger('is_actived')->default(0)->comment('是否激活, 默认没有激活状态');
            $table->unsignedTinyInteger('sex')->default(0)->comment('性别')->comment('0 保密  1 男  2 女');
            $table->ipAddress('ip');
            $table->string('avatar')->default('')->comment('头像');
            $table->unsignedBigInteger('unique_id')->unique()->comment('用于显示用户随机数字代替自增id');
            $table->string('profile',30)->default('');
            $table->rememberToken();
            $table->timestamp('last_login_at')->comment('最后登录时间');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
