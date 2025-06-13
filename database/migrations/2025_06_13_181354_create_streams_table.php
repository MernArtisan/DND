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
        Schema::create('streams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stream_id')->unique();
            $table->string('team_1');
            $table->string('team_2');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('channel_id'); // 👈 Added with relation
            $table->string('title');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('location')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'live', 'ended'])->default('pending');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade'); // 👈 added
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streams');
    }
};
