<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Stadiums;
use App\Models\Booking;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'แดชบอร์ด'
        ];
        $stadiums = Stadiums::all();
        $bookings = Booking::all();
        $bookday = Booking::where('bk_date', Carbon::now()->toDateString())->get();
        $bookstatus = Booking::where('bk_status', 2)->get();
        // dd(Carbon::now()->toDateString());
        return view('admin.dashboard', compact('stadiums', 'bookings', 'bookday','bookstatus'), $data);
    }
}
