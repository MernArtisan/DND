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
        Schema::create('subscription_plans', function (Blueprint $table) {

            $table->id();
            $table->string('name'); // "Per Game", "Season Pass", "Unlimited"
            $table->string('slug')->unique();
            $table->decimal('price', 8, 2);
            $table->enum('billing_cycle', ['one-time', 'annual']);
            $table->enum('duration_unit', ['hours', 'days', 'months', 'years']); // New
            $table->integer('duration_value'); // New (e.g., 48 hours, 6 months)
            $table->text('description');
            $table->json('features')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
