<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'donor_id',
        'transaction_reference',
        'amount',
        'currency',
        'donation_type',
        'payment_method',
        'payment_id',
        'status',
        'is_anonymous',
        'message',
        'payment_instructions',
        'failure_reason',
        'admin_notes',
        'ip_address',
        'user_agent',
        'paid_at',
        'verified_by',
        'verified_at',
        'cancelled_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_anonymous' => 'boolean',
        'paid_at' => 'datetime',
        'verified_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    /**
     * Relationship with donor
     */
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    /**
     * Get verified by user
     */
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Scope for completed donations
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope for pending donations
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for monthly donations
     */
    public function scopeMonthly($query)
    {
        return $query->where('donation_type', 'monthly');
    }

    /**
     * Get formatted amount
     */
    public function getFormattedAmountAttribute()
    {
        return $this->currency . ' ' . number_format($this->amount, 2);
    }

    /**
     * Check if donation is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if donation is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
