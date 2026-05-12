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
        Schema::table('bag_items', function (Blueprint $table): void {
            $table->unique(['bag_id', 'variant_size_id']);
        });

        Schema::table('favourite_items', function (Blueprint $table): void {
            $table->unique(['favourite_id', 'variant_size_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bag_items', function (Blueprint $table): void {
            $table->dropUnique(['bag_id', 'variant_size_id']);
        });

        Schema::table('favourite_items', function (Blueprint $table): void {
            $table->dropUnique(['favourite_id', 'variant_size_id']);
        });
    }
};
