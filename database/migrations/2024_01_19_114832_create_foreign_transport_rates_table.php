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
        Schema::create('foreign_transport_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('population_id')->constrained('populations');
            $table->foreignId('uni_type_id')->constrained('uni_types');
            $table->decimal('cost', 22, 4)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foreign_transport_rates');
    }
};
