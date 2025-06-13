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
        Schema::table('streams', function (Blueprint $table) {
            $table->string('team1_symbol')->nullable()->after('team_1');
            $table->string('team2_symbol')->nullable()->after('team_2');
            $table->string('location_symbol')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('streams', function (Blueprint $table) {
            $table->dropColumn(['team1_symbol', 'team2_symbol', 'location_symbol']);
        });
    }
};
