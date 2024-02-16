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
        Schema::table('loot_table', function (Blueprint $table) {
            $table->decimal('chance', 16, 15, true)->default(1.0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loot_table', function (Blueprint $table) {
            $table->dropColumn('chance');
        });
    }
};
