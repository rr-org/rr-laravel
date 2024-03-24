<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'price'
    ];
}
