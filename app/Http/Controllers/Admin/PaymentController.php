<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Stadiums;

class PaymentController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'การชำระเงิน'
        ];
        $bookings = Booking::where('bk_status','2')->join('stadiums', 'bookings.bk_std_id', 'stadiums.id')->select('bookings.*', 'stadiums.std_name')->orderBy('created_at', 'desc')->get();
        $stadiums = Stadiums::all();
        return view('admin.payment',compact('bookings','stadiums'), $data);
    }
}
