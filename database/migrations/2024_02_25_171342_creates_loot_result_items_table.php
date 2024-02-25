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
        Schema::create('loot_result_items', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('loot_result_id')
                ->constrained('loot_results')
                ->onDelete('cascade');
            $table->foreignId('item_id')
                ->constrained('items')
                ->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('total_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loot_result_items');
    }
};
