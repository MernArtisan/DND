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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sub_name')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();

            $table->string('item_1')->nullable();
            $table->text('description_1')->nullable();
            $table->string('item_2')->nullable();
            $table->text('description_2')->nullable();
            $table->string('item_3')->nullable();
            $table->text('description_3')->nullable();
            $table->string('item_4')->nullable();
            $table->text('description_4')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
