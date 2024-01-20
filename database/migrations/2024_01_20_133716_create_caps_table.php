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
        Schema::create('caps', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('contact');
            $table->string('email');
            $table->string('phone');
            $table->string('street');
            $table->integer('number');
            $table->string('interior')->nullable();
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caps');
    }
};
