<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->date('date_at');
            $table->string('begin_time')->nullable();
            $table->string('end_time')->nullable();
            $table->integer('work_time')->nullable();
            $table->integer('break_time')->nullable();
            $table->integer('work_states_id')->nullable();
            $table->integer('status')->nullable()->default(0); // 1:入力中,2:完了
            $table->uuid('uuid');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['user_id', 'date_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
