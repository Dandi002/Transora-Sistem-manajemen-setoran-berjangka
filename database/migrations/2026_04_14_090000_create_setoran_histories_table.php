<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('setoran_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('staff_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('transaksi_id')->nullable()->constrained('transaksis')->nullOnDelete();
            $table->unsignedTinyInteger('week_number');
            $table->string('method', 20);
            $table->timestamp('recorded_at');
            $table->string('source_label')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'week_number']);
            $table->index(['method', 'recorded_at']);
            $table->unique(['transaksi_id', 'week_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('setoran_histories');
    }
};
