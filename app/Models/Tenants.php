<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenants extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'branch',
        'full_name',
        'sex',
        'phone_number',
        'complete_address',
        'utility',
        'mode_of_payment',
        'amount_of_payment',
        'start_date',
        'start_time',
    ];
}


