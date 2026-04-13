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
        Schema::create('bag_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bag_id');

            $table->foreignId('variant_id')
                ->constrained('product_variants')
                ->cascadeOnDelete();

            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bag_items');
    }
};
