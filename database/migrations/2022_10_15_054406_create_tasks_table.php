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
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            // Task name
            $table->string('name');
            // Task description
            $table->text('description');
            // Task labels JSON
            $table->json('labels');
            // Task deadline
            $table->date('deadline');
            // Task users JSON
            $table->json('users');
            // Task board id (foreign key)
            $table->unsignedBigInteger('board_id');
            // Task status (enum: 'active', 'inactive') (default: 'inactive')
            $table->enum('status', ['active', 'inactive'])->default('inactive');
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
        Schema::dropIfExists('task');
    }
};
