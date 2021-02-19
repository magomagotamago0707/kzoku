<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGoalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('goal_information')) {
            // テーブルが存在していればリターン
            return;
        }
        Schema::create('goal_information', function (Blueprint $table) {
            $table->increments('goal_information_id');
            $table->string('personal_id')->nullable(false);
            $table->string('title')->nullable(false);
            $table->timestamp('start_date')->nullable(false);
            $table->timestamp('end_date')->nullable();
            $table->timestamp('result_end_date')->nullable();
            $table->integer('progress_status')->nullable(false);
            $table->integer('setting_status')->nullable(false);
            $table->integer('count_flg')->nullable(false);
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goal_information');
    }
}
