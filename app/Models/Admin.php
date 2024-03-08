<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Admin extends Model
{
    // use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'Admin';
    protected $fillable = ['username', 'password'];

}
