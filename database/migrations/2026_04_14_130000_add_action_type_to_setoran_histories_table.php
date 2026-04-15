<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('setoran_histories', function (Blueprint $table) {
            $table->string('action_type', 30)
                ->default('transfer_paid')
                ->after('method');
        });
    }

    public function down(): void
    {
        Schema::table('setoran_histories', function (Blueprint $table) {
            $table->dropColumn('action_type');
        });
    }
};
