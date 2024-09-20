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
        Schema::table('product_transactions', function (Blueprint $table) {
            //
            $table->dropColumn('is_paid');
            $table->enum('status', ['diproses','dibayar','berhasil','dibatalkan'])->default('diproses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_transactions', function (Blueprint $table) {
            //
            $table->dropColumn('status');
            $table->boolean('is_paid')->default(false);
        });
    }
};
