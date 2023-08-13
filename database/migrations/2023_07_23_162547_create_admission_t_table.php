<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionTTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_t', function (Blueprint $table) {
            $table->id('admission_id');
            $table->bigInteger('patient_id');
            $table->bigInteger('dic_id');
            $table->bigInteger('queue_id');
            $table->bigInteger('nic_id');
            $table->string('admission_number');
            $table->string('patient_age');
            $table->text('symptoms');
            $table->float('height');
            $table->float('weight');
            $table->float('body_temp');
            $table->string('blood_pulse', 20);
            $table->string('respiratory_rate', 20);
            $table->string('blood_pressure', 20);
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
        Schema::dropIfExists('admission_t');
    }
}
