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
        Schema::create('vet_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id');
            $table->string('description',300);
            $table->datetime('date');
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vet_visits');
    }
};
