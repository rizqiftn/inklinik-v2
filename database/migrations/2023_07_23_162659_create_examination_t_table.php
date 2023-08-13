<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationTTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_t', function (Blueprint $table) {
            $table->id('examination_id');
            $table->bigInteger('admission_id');
            $table->bigInteger('dic_id');
            $table->text('symptoms');
            $table->bigInteger('primary_diagnose_code');
            $table->bigInteger('secondary_diagnose_code');
            $table->timestamp('examination_date');
            $table->text('medical_recommendation');
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
        Schema::dropIfExists('examination_t');
    }
}
