<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reception', function (Blueprint $table) {
            $table->id();
            // first name
            $table->string('first_name');
            // last name
            $table->string('last_name');
            // Phone
            $table->string('phone')->nullable();
            // Other phone
            $table->json('phone_contact')->nullable();
            // Gender
            $table->enum('gender', ['male', 'female'])->nullable();
            // Home address
            $table->string('homeaddress')->nullable();
            // Reason to study
            $table->string('reasontostudy')->nullable();
            // Interests
            $table->string('interests')->nullable();
            // Hear about
            $table->string('hear_about')->nullable();
            // Course
            $table->json('course')->nullable();
            // Birthday
            $table->date('birthday')->nullable();
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
        Schema::dropIfExists('reception');
    }
};
