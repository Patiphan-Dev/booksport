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
        if (auth()->user()->status == 9) {
            $stadiums = Stadiums::all();
            $bookings = Booking::all();
            $bookday = Booking::where('bk_date', Carbon::now()->toDateString())->get();
            $bookstatus = Booking::where('bk_status', 2)->get();
        } else {
            $stadiums = Stadiums::where('std_supperuser', auth()->user()->id)
                ->join('users', 'stadiums.std_supperuser', 'users.id')
                ->select('users.username', 'stadiums.*')->get();
            $bookings = Booking::join('stadiums', 'bookings.bk_std_id', 'stadiums.id')
                ->select('bookings.*')
                ->where('stadiums.std_supperuser', auth()->user()->id)
                ->get();
            $bookday = Booking::where('bk_date', Carbon::now()->toDateString())
                ->join('stadiums', 'bookings.bk_std_id', 'stadiums.id')
                ->select('bookings.*')
                ->where('stadiums.std_supperuser', auth()->user()->id)
                ->get();
            $bookstatus = Booking::where('bk_status', 2)
                ->join('stadiums', 'bookings.bk_std_id', 'stadiums.id')
                ->select('bookings.*')
                ->where('stadiums.std_supperuser', auth()->user()->id)
                ->get();
        }

        // dd(Carbon::now()->toDateString());
        return view('admin.dashboard', compact('stadiums', 'bookings', 'bookday', 'bookstatus'), $data);
    }
}
