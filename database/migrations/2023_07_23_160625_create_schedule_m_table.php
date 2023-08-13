<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_m', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->bigInteger('doctor_id');
            $table->integer('quota');
            $table->integer('schedule_day');
            $table->time('schedule_time_start');
            $table->time('schedule_time_end');
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
        Schema::dropIfExists('schedule_m');
    }
}
