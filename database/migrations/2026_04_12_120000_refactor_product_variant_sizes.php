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
        Schema::create('product_variant_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')
                ->constrained('product_variants')
                ->cascadeOnDelete();

            $table->string('size', 8);
            $table->integer('stock_quantity');

            $table->unique(['variant_id', 'size']);
        });

        Schema::table('product_variants', function (Blueprint $table) {
            $table->unique(['product_id', 'color']);

            if (Schema::hasColumn('product_variants', 'size')) {
                $table->dropColumn('size');
            }

            if (Schema::hasColumn('product_variants', 'stock_quantity')) {
                $table->dropColumn('stock_quantity');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropUnique(['product_id', 'color']);

            if (!Schema::hasColumn('product_variants', 'stock_quantity')) {
                $table->integer('stock_quantity')->default(0);
            }

            if (!Schema::hasColumn('product_variants', 'size')) {
                $table->string('size', 8)->default('N/A');
            }
        });

        Schema::dropIfExists('product_variant_sizes');
    }
};
