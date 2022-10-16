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
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            // Board name
            $table->string('name');
            // Board status (enum: 'active', 'inactive') (default: 'inactive')
            $table->enum('status', ['active', 'inactive'])->default('active');
            // Board Visibility (enum: 'public', 'private') (default: 'public')
            $table->enum('visibility', ['public', 'private'])->default('public');
            // Board Workspace (enum: 'personal', 'work', 'school') (default: 'personal')
            $table->enum('workspace', ['personal', 'work', 'school'])->default('personal');
            // Issue id (foreign key)
            $table->unsignedBigInteger('issue_id');
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
        Schema::dropIfExists('boards');
    }
};
