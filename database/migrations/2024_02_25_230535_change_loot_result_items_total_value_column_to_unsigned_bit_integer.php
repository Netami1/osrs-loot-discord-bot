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
        Schema::table('loot_result_items', function (Blueprint $table) {
            $table->unsignedBigInteger('total_value')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loot_result_items', function (Blueprint $table) {
            $table->unsignedInteger('total_value')->change();
        });
    }
};
