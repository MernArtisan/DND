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
        Schema::create('corprate_sponsers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // optional sponsor name
            $table->string('image')->nullable(); // image path (e.g., logos)
            $table->string('link')->nullable(); // URL to sponsor's website
            $table->boolean('status')->default(true); // active/inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corprate_sponsers');
    }
};
