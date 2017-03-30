<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlySummaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_summary', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id');
            $table->date('year_month'); //yyyymm
            $table->float('total_work_time', 6, 2)->nullable()->default(0)->comment('合計労働時間');
            $table->float('avg_work_time_day', 6, 2)->nullable()->default(0)->comment('1日あたりの平均労働時間'); //1日あたりの平均労働時間
            $table->integer('total_work_day_count')->nullable()->default(0)->comment('合計出勤日'); // 合計出勤日
            $table->integer('total_business_day_count')->nullable()->default(0)->comment('合計営業日'); // 合計営業日
            $table->integer('status')->nullable()->default(0); // 1:入力中,2:完了
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('uuid');
            $table->unique(['user_id', 'year_month']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_summary');
    }
}
