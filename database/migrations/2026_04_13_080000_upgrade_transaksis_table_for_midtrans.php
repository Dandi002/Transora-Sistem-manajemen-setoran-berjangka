<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->foreignId('staff_id')->nullable()->after('user_id')->constrained('users')->nullOnDelete();
            $table->foreignId('saving_plan_id')->nullable()->after('staff_id')->constrained('saving_plans')->nullOnDelete();
            $table->unsignedTinyInteger('week_number')->nullable()->after('saving_plan_id');
            $table->string('order_id')->nullable()->unique()->after('week_number');
            $table->unsignedBigInteger('gross_amount')->default(0)->after('order_id');
            $table->string('payment_type')->nullable()->after('gross_amount');
            $table->string('transaction_status')->default('pending')->after('payment_type');
            $table->string('midtrans_transaction_id')->nullable()->after('transaction_status');
            $table->string('fraud_status')->nullable()->after('midtrans_transaction_id');
            $table->timestamp('paid_at')->nullable()->after('fraud_status');
            $table->timestamp('expires_at')->nullable()->after('paid_at');
            $table->json('payment_payload')->nullable()->after('expires_at');

            $table->index(['user_id', 'week_number']);
            $table->index(['transaction_status']);
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'week_number']);
            $table->dropIndex(['transaction_status']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['staff_id']);
            $table->dropForeign(['saving_plan_id']);
            $table->dropUnique(['order_id']);

            $table->dropColumn([
                'user_id',
                'staff_id',
                'saving_plan_id',
                'week_number',
                'order_id',
                'gross_amount',
                'payment_type',
                'transaction_status',
                'midtrans_transaction_id',
                'fraud_status',
                'paid_at',
                'expires_at',
                'payment_payload',
            ]);
        });
    }
};
