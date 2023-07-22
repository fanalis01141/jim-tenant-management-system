<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch',
        'choice_1',
        'choice_2',
        'amount',
        'date',
    ];
}
