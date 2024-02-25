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
        Schema::create('loot_results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('loot_source_id')
                ->constrained('loot_source')
                ->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->string('discord_username');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loot_results');
    }
};
