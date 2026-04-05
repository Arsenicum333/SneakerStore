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
        Schema::create('favourites', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->string('session_token')->unique();
        });

        Schema::table('favourite_items', function (Blueprint $table) {
            $table->foreign('favourite_id')
                ->references('id')
                ->on('favourites')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('favourite_items', function (Blueprint $table) {
            $table->dropForeign(['favourite_id']);
        });

        Schema::dropIfExists('favourites');
    }
};
