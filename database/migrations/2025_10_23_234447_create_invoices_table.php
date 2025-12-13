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
            $table->string('name_client');
            $table->string('invoice_number');
            $table->date('invoice_Date');
            $table->date('due_Date');
            // $table->string('product');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

             $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('rate_vat');
            $table->decimal('value_vat',8,2);
            $table->decimal('total',8,2);
            $table->integer('quantity')->default(1);

           $table->string('status');
           $table->integer('value_status');
           $table->text('notes')->nullable();
           $table->date('payment_Date')->nullable();

           $table->softDeletes();
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
