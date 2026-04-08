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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bookingitem_id')->unique();
            $table->unsignedBigInteger('rental_id')->index();
            $table->unsignedBigInteger('product_id')->nullable()->index();
            $table->string('rental_code')->nullable();
            $table->string('borrower_name')->nullable();
            $table->string('borrower_phone')->nullable();
            $table->string('product_name')->nullable();
            $table->string('category_name')->nullable();
            $table->unsignedInteger('quantity')->default(0);
            $table->date('rental_start_date')->nullable()->index();
            $table->date('rental_end_date')->nullable();
            $table->string('rental_status')->default('pending')->index();
            $table->timestamps();

            $table->foreign('bookingitem_id')->references('id')->on('bookingitems')->cascadeOnDelete();
            $table->foreign('rental_id')->references('id')->on('rentals')->cascadeOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
