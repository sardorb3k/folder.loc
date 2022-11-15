<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

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
            $table->string('board_id');
            $table->string('name');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('visibility', ['public', 'private'])->default('public');
            $table->enum('workspace', ['personal', 'work', 'school'])->default('personal');
            $table->integer('issuer_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->smallInteger('order_number')->default(0);
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
