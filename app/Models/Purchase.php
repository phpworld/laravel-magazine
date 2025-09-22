<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    protected $fillable = [
        'user_id',
        'magazine_id',
        'transaction_id',
        'razorpay_payment_id',
        'razorpay_order_id',
        'amount',
        'payment_status',
        'purchased_at',
        'download_count',
        'last_downloaded_at'
    ];

    protected $casts = [
        'purchased_at' => 'datetime',
        'last_downloaded_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function magazine(): BelongsTo
    {
        return $this->belongsTo(Magazine::class);
    }

    public function scopeCompleted($query)
    {
        return $query->where('payment_status', 'completed');
    }
}
