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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('company_id')->constrained('companies');
            $table->string('name');
            $table->foreignId('customer_type_id')->constrained('customer_types');
            $table->string('state')->nullable();
            $table->string('street')->nullable();
            $table->string('colony')->nullable();
            $table->integer('postal_code')->nullable();
            $table->foreignId('location_id')->constrained('locations');
            $table->string('priority')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
