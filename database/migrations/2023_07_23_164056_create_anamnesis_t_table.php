<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnamnesisTTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anamnesis_t', function (Blueprint $table) {
            $table->id('anamnesis_id');
            $table->bigInteger('examination_id');
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
        Schema::dropIfExists('anamnesis_t');
    }
}
