<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'total_donated',
        'donation_count',
        'last_donation_at',
    ];

    protected $casts = [
        'total_donated' => 'decimal:2',
        'last_donation_at' => 'datetime',
    ];

    /**
     * Relationship with donations
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Get full name
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get completed donations
     */
    public function completedDonations()
    {
        return $this->donations()->completed();
    }
}
