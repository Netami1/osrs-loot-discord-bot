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
        Schema::create('loot_table_roll', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('loot_table_id');
            $table->string('item_name');
            $table->integer('item_id');
            $table->float('chance')->default(1.0);
            $table->unsignedInteger('min')->default(1);
            $table->unsignedInteger('max')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loot_table_roll');
    }
};
