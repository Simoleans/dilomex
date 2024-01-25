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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('code_invoice');
            $table->foreignId('invoice_type_id')->constrained('invoice_types');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('family_id')->constrained('families');
            $table->foreignId('invoice_status_id')->constrained('invoice_statuses');
            $table->string('territory')->nullable();
            $table->string('box_invoice')->nullable();
            $table->string('concentrated')->nullable();
            $table->string('weight')->nullable();
            $table->string('order')->nullable();
            $table->decimal('price', 22, 4)->default(0);
            //missing
            $table->string('box_missing')->nullable();
            $table->string('part_missing')->nullable();
            $table->string('observations_missing')->nullable();

            //details
            $table->date('date_concentrated');
            $table->date('date_invoice');
            $table->date('date_portage');
            $table->date('date_date')->nullable();
            $table->string('part_invoice')->nullable();
            $table->string('volume')->nullable();
            $table->string('currency')->nullable();
            $table->string('observations_invoice')->nullable();
            $table->string('barcode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
