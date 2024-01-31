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
        Schema::create('species_diseases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('specie_id');
            $table->unsignedBigInteger('disease_id');
            $table->timestamps();

            $table->foreign('specie_id')->references('id')->on('species');
            $table->foreign('disease_id')->references('id')->on('diseases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('species_diseases');
    }
};
