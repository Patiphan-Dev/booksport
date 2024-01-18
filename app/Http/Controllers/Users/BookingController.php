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
        $bookings = Booking::where('bk_std_id', $id)->get();
        $stadiums = Stadiums::all();

        return view('booking',compact('bookings','stadiums'), $data);
    }

    public function addBooking(Request $request)
    {
        //บันทึกข้อมูล
        $Booking = new Booking;
        $Booking->bk_std_id = $request->bk_std_id;
        $Booking->bk_username = $request->bk_username;
        $Booking->bk_date = $request->bk_date;
        $Booking->bk_str_time = $request->bk_str_time;
        $Booking->bk_end_time = $request->bk_end_time;
        $Booking->bk_slip = $request->bk_slip;
        $Booking->bk_status = $request->bk_status;
        $Booking->save();

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
