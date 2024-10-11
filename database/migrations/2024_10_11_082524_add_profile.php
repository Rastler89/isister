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
            $table->string('surname');
            $table->string('phone');
            $table->unsignedBigInteger('country')->nullable();
            $table->unsignedBigInteger('state')->nullable();
            $table->unsignedBigInteger('town')->nullable();
            $table->string('adress');
            $table->string('cp');

            $table->foreign('country')->references('id')->on('countries');
            $table->foreign('state')->references('id')->on('states');
            $table->foreign('town')->references('town')->on('towns');
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