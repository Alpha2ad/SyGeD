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
        Schema::table('decrets', function (Blueprint $table) {
            $table->string('documentPublic')->nullable();
            $table->string('documentPrivate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('decrets', function (Blueprint $table) {
            $table->dropColumn('documentPublic');
            $table->dropColumn('documentPrivate');
        });
    }
};