<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPrimaryKeyMonthlyBaseInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monthly_base_infos', function (Blueprint $table) {
            $table->date('term_start_day')->after('user_id'); //yyyymm
            $table->date('term_end_day')->after('term_start_day')->nullable(); //yyyymm
            $table->increments('id')->unsigned();
            $table->unique(['user_id', 'term_start_day']);
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
