<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('users', 'saving_started_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('saving_started_at');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('users', 'saving_started_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->date('saving_started_at')->nullable()->after('saving_plan_id');
            });
        }
    }
};
