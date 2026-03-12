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
        Schema::dropIfExists('bookingitems');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookingitems', function (Blueprint $table) {
            $table->renameColumn('rental_id', 'booking_id');
        });

    }
};
