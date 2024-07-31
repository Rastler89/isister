<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surgeries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('type');
            $table->datetime('date');
            $table->string('preop');
            $table->text('description');
            $table->text('result');
            $table->text('complications')->nullable();
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('type')->references('id')->on('operation_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surgeries');
    }
};
