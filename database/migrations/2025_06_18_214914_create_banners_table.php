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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();           // e.g. "LOREM IPSUM DOLOR"
            $table->string('subtitle')->nullable();        // e.g. "LOREM IPSUM DOLAR SIT AMET"
            $table->text('description')->nullable();       // full description or short paragraph
            $table->string('image')->nullable();
            $table->enum('platform', ['app', 'web', 'both'])->default('both');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
