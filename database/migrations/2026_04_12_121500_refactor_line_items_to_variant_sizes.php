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
        // Recreate line item tables to point to concrete size selections.
        Schema::dropIfExists('favourite_items');
        Schema::dropIfExists('bag_items');
        Schema::dropIfExists('order_items');

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id');

            $table->foreignId('variant_size_id')
                ->constrained('product_variant_sizes')
                ->cascadeOnDelete();

            $table->integer('quantity');
            $table->decimal('price_at_time', 6, 2);
        });

        Schema::create('bag_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bag_id');

            $table->foreignId('variant_size_id')
                ->constrained('product_variant_sizes')
                ->cascadeOnDelete();

            $table->integer('quantity');
        });

        Schema::create('favourite_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('favourite_id');

            $table->foreignId('variant_size_id')
                ->constrained('product_variant_sizes')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourite_items');
        Schema::dropIfExists('bag_items');
        Schema::dropIfExists('order_items');

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id');

            $table->foreignId('variant_id')
                ->constrained('product_variants')
                ->cascadeOnDelete();

            $table->integer('quantity');
            $table->decimal('price_at_time', 6, 2);
        });

        Schema::create('bag_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bag_id');

            $table->foreignId('variant_id')
                ->constrained('product_variants')
                ->cascadeOnDelete();

            $table->integer('quantity');
        });

        Schema::create('favourite_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('favourite_id');

            $table->foreignId('variant_id')
                ->constrained('product_variants')
                ->cascadeOnDelete();
        });
    }
};
