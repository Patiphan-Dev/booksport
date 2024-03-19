<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'bk_std_id',
        'bk_username',
        'bk_date',
        'bk_str_time',
        'bk_end_time',
        'bk_slip',
        'bk_node',
        'bk_sumtime',
        'bk_total_price',
        'bk_status',

    ];
}
