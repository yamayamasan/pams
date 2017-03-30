<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyBaseInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_base_infos', function (Blueprint $table) {
            $table->integer('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->date('year_month'); //yyyymm
            $table->integer('total_base_work_time')->nullable(); // 基準勤務時間
            $table->integer('total_lowest_work_time')->nullable(); //最低勤務時間
            $table->integer('total_highest_work_time')->nullable(); // 最高勤務時間
            $table->string('base_attend_time')->nullable(); // 出勤
            $table->string('base_leaving_time')->nullable(); // 退勤
            $table->integer('base_break_time'); // 休憩
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('uuid');
            $table->primary(['user_id', 'year_month']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_base_infos');
    }
}
