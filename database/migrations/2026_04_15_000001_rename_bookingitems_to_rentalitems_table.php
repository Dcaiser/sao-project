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
        if (Schema::hasTable('bookingitems') && !Schema::hasTable('rentalitems')) {
            Schema::rename('bookingitems', 'rentalitems');
        }

        if (Schema::hasTable('reports')) {
            Schema::table('reports', function (Blueprint $table) {
                try {
                    $table->dropForeign(['bookingitem_id']);
                } catch (Throwable $exception) {
                    // Ignore when the foreign key does not exist on this environment.
                }
            });

            Schema::table('reports', function (Blueprint $table) {
                $table->foreign('bookingitem_id')->references('id')->on('rentalitems')->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('reports')) {
            Schema::table('reports', function (Blueprint $table) {
                try {
                    $table->dropForeign(['bookingitem_id']);
                } catch (Throwable $exception) {
                    // Ignore when the foreign key does not exist on this environment.
                }
            });

            Schema::table('reports', function (Blueprint $table) {
                $table->foreign('bookingitem_id')->references('id')->on('bookingitems')->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('rentalitems') && !Schema::hasTable('bookingitems')) {
            Schema::rename('rentalitems', 'bookingitems');
        }
    }
};
