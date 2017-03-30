<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTypeDateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->time('begin_time')->change();
            $table->time('end_time')->change();
            $table->time('break_time')->change();
            $table->float('work_time', 4, 2)->change();
            $table->integer('status')->nullable()->default(0)->comment('1:入力中,2:完了')->change(); // 1:入力中,2:完了
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
