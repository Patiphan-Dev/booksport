<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Stadiums;
use RealRashid\SweetAlert\Facades\Alert;
use File;

class BookingController extends Controller
{
    public function index($id)
    {
        $data = [
            'title' => 'จองสนามกีฬา'
        ];
        $booking = Booking::where('bk_std_id', $id)->join('stadiums', 'bookings.bk_std_id', 'stadiums.id') ->select('bookings.*','stadiums.std_name')->get();
        $history = Booking::where('bk_username', auth()->user()->username)->join('stadiums', 'bookings.bk_std_id', 'stadiums.id') ->select('bookings.*','stadiums.std_name')->get();
        $bookings = Booking::join('stadiums', 'bookings.bk_std_id', 'stadiums.id')->select('bookings.*','stadiums.std_name')->get();
        $stadiums = Stadiums::all();
        $search = Stadiums::find($id);
        return view('booking',compact('booking','bookings','stadiums','search','history'), $data);
    }

    public function indexAll()
    {
        $data = [
            'title' => 'จองสนามกีฬา'
        ];
        $booking = Booking::join('stadiums', 'bookings.bk_std_id', 'stadiums.id') ->select('bookings.*','stadiums.std_name')->get();
        $history = Booking::where('bk_username', auth()->user()->username)->join('stadiums', 'bookings.bk_std_id', 'stadiums.id') ->select('bookings.*','stadiums.std_name')->get();
        $bookings = Booking::join('stadiums', 'bookings.bk_std_id', 'stadiums.id') ->select('bookings.*','stadiums.std_name')->get();
        $stadiums = Stadiums::all();
        $search = '';
        return view('booking',compact('booking','bookings','stadiums','search','history'), $data);
    }

    public function addBooking(Request $request)
    {
        // $booking = Booking::where('',$request->bk_std_id);
        //บันทึกข้อมูล
        $booking = new Booking;
        $booking->bk_std_id = $request->bk_std_id;
        $booking->bk_username = auth()->user()->username;
        $booking->bk_date = $request->bk_date;
        $booking->bk_str_time = $request->bk_str_time;
        $booking->bk_end_time = $request->bk_end_time;
        $booking->bk_slip = $request->bk_slip;
        $booking->bk_status = 1;
        $booking->save();

        // แจ้งเตือน ไลน์
        Alert::success('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
        return redirect()->back()->with('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
    }

    public function editBooking($id)
    {
        $Booking = Booking::find($id);
        return view('booking', compact('Booking'));
    }

    public function updateBooking(Request $request, $id)
    {
        $update = Booking::find($id)->update(
            [
                'bk_std_id' => $request->bk_std_id,
                'bk_username' => $request->bk_username,
                'bk_date' => $request->bk_date,
                'bk_str_time' => $request->bk_str_time,
                'bk_end_time' => $request->bk_end_time,
                'bk_slip' => $request->bk_slip,
                'bk_status' => $request->bk_status,
            ]
        );
        Alert::success('สำเร็จ', 'อัพเดทข้อมูลสำเร็จ');
        return redirect()->back()->with('success', 'อัพเดทข้อมูลสำเร็จ');
    }

    public function deleteBooking($id)
    {
        $delete = Booking::find($id)->delete();
        Alert::success('สำเร็จ', 'ลบข้อมูสำเร็จ');
        return redirect()->back()->with('success', 'ลบข้อมูสำเร็จ');
    }
}
