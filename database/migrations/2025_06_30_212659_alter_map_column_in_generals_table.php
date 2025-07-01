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
        Schema::table('generals', function (Blueprint $table) {
            $table->text('map')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('generals', function (Blueprint $table) {
            $table->string('map', 255)->nullable()->change();
        });
    }
};
