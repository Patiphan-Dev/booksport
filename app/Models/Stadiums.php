<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadiums extends Model
{
    use HasFactory;
    protected $fillable = [
        'std_name',
        'std_details',
        'std_price',
        'std_facilities',
        'std_status',
    ];
}
