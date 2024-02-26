<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('loot_table', function (Blueprint $table) {
            $table->unsignedInteger('rolls_min')->nullable()->default(null);
            $table->unsignedInteger('rolls_max')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loot_table', function (Blueprint $table) {
            $table->dropColumn(['rolls_min', 'rolls_max']);
        });
    }
};
