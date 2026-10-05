<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_name',
        'mobile_number',
        'dress_code',
        'booking_date',
        'return_date',
        'advance_amount',
        'security_deposit',
        'payment_mode',
        'reference_by',
        'total_amount',
        'remaining_amount',
        'status',
        'notes',
        'entry_done_by',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'return_date' => 'date',
        'advance_amount' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
    ];
}
