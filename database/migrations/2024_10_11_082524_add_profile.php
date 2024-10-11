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
        Schema::table('users', function($table) {
            $table->string('surname')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('country')->nullable();
            $table->unsignedBigInteger('state')->nullable();
            $table->unsignedBigInteger('town')->nullable();
            $table->string('adress')->nullable();
            $table->string('cp')->nullable();

            $table->foreign('country')->references('id')->on('countries');
            $table->foreign('state')->references('id')->on('states');
            $table->foreign('town')->references('id')->on('towns');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};