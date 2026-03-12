<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("
    ALTER TABLE rentals
    MODIFY rental_status ENUM('pending','approved','rejected','cancelled','menunggu diambil','aktif','dikembalikan','dibatalkan')
    DEFAULT 'pending'
");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement("
    ALTER TABLE rentals
    MODIFY rental_status ENUM('menunggu diambil','aktif','dikembalikan','dibatalkan')
    DEFAULT 'menunggu diambil'
");
    }
};
