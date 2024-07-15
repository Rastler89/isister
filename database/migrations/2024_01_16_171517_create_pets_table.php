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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name',50);
            $table->char('gender',1);
            $table->date('birth');
            $table->string('code',20);
            $table->unsignedBigInteger('breed_id');
            $table->integer('status')->default(1);
            $table->string('image')->nullable();
            $table->text('character')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('breed_id')->references('id')->on('breeds');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
