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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id');

            $table->decimal('price', 6, 2);
            $table->integer('stock_quantity');

            $table->string('size', 8);
            $table->string('color', 20);
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->foreign('variant_id')
                ->references('id')
                ->on('product_variants')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropForeign(['variant_id']);
        });

        Schema::dropIfExists('product_variants');
    }
};
