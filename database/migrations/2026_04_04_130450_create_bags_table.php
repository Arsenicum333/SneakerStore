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
        Schema::create('bags', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->string('session_token')->unique();

            $table->timestamps();
        });

        Schema::table('bag_items', function (Blueprint $table) {
            $table->foreign('bag_id')
                ->references('id')
                ->on('bags')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bag_items', function (Blueprint $table) {
            $table->dropForeign(['bag_id']);
        });

        Schema::dropIfExists('bags');
    }
};
