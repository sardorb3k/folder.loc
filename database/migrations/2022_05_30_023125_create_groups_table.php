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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('teacher_id');
            $table->foreignId('assistant_id')->nullable();
            $table->string('lessontime')->nullable();
            // Level enum value ielts level (A1, A2, B1, B2, C1, C2, D1, D2, E1, E2)
            $table->string('level')->nullable();
            $table->enum('days',['couple','odd'])->nullable();
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
        Schema::dropIfExists('groups');
    }
};
