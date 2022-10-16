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
        Schema::create('task_commits', function (Blueprint $table) {
            $table->id();
            // Task id (foreign key)
            $table->unsignedBigInteger('task_id');
            // Commit id (foreign key)
            $table->unsignedBigInteger('commit_id')->nullable();
            // Commit message
            $table->string('message');
            // Commit status (enum: 'active', 'inactive') (default: 'inactive')
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
        Schema::dropIfExists('task_commits');
    }
};
