<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    protected $table = 'transaksis';

    protected $fillable = [
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
    ];

    protected $casts = [
        'gross_amount' => 'integer',
        'paid_at' => 'datetime',
        'expires_at' => 'datetime',
        'payment_payload' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function savingPlan(): BelongsTo
    {
        return $this->belongsTo(SavingPlan::class);
    }

    public function setoranHistories(): HasMany
    {
        return $this->hasMany(SetoranHistory::class);
    }
}
