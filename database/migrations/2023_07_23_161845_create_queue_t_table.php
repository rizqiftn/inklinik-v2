<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueueTTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_t', function (Blueprint $table) {
            $table->id('queue_id');
            $table->bigInteger('schedule_id');
            $table->bigInteger('dic_id');
            $table->bigInteger('patient_id');
            $table->string('queue_number');
            $table->text('symptoms');
            $table->timestamp('time_attendance');
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
        Schema::dropIfExists('queue_t');
    }
}
