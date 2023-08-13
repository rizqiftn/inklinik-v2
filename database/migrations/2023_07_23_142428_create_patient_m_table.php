<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_m', function (Blueprint $table) {
            $table->id('patient_id');
            $table->string('patient_name', 100);
            $table->date('patient_dob');
            $table->integer('identity_id');
            $table->string('identity_number');
            $table->text('address');
            $table->smallInteger('sex');
            $table->string('phone_number', 22);
            $table->string('email', 100);
            $table->integer('province_id');
            $table->integer('city_id');
            $table->integer('region_id');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('patient_m');
    }
}
