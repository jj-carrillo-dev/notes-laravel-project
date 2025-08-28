<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('notebooks', function (Blueprint $table) {
            $table->tinyInteger('order')->default(9)->after('user_id');
        });

        // Update existing notebooks to have an order of 9
        DB::table('notebooks')->update(['order' => 9]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notebooks', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
