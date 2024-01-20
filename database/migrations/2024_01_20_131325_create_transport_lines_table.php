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
        Schema::create('transport_lines', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('address');
            $table->string('contact');
            $table->string('email');
            $table->string('phone');
            $table->tinyInteger('own_line')->default(0)->comment('0: No, 1: Yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_lines');
    }
};
