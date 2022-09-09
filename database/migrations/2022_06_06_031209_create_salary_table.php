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
        Schema::create('salary', function (Blueprint $table) {
            $table->id();
            // Teacher id (foreign key)
            $table->unsignedBigInteger('teacher_id');
            // Salary float (10,2)
            $table->float('salary', 10, 2);
            // enum ('active', 'inactive') (default: 'inactive')
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->foreign('teacher_id')->references('id')->on('users');
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
        Schema::dropIfExists('salary');
    }
};
