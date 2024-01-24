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
        $booking = Booking::where('bk_std_id', $id)->join('stadiums', 'bookings.bk_std_id', 'stadiums.id')->select('bookings.*', 'stadiums.std_name')->orderBy('created_at', 'desc')->get();
        $history = Booking::where('bk_username', auth()->user()->username)->join('stadiums', 'bookings.bk_std_id', 'stadiums.id')->select('bookings.*', 'stadiums.std_name')->orderBy('created_at', 'desc')->get();
        $bookings = Booking::join('stadiums', 'bookings.bk_std_id', 'stadiums.id')->select('bookings.*', 'stadiums.std_name')->orderBy('created_at', 'desc')->get();
        $search = Stadiums::find($id);
        return view('booking', compact('booking', 'bookings', 'stadiums', 'search', 'history'), $data);
    }

    public function indexAll()
    {
        $data = [
            'title' => 'จองสนามกีฬา'
        ];
        $booking = Booking::join('stadiums', 'bookings.bk_std_id', 'stadiums.id')->select('bookings.*', 'stadiums.std_name')->orderBy('created_at', 'desc')->get();
        $history = Booking::where('bk_username', auth()->user()->username)->join('stadiums', 'bookings.bk_std_id', 'stadiums.id')->select('bookings.*', 'stadiums.std_name')->orderBy('created_at', 'desc')->get();
        $bookings = Booking::join('stadiums', 'bookings.bk_std_id', 'stadiums.id')->select('bookings.*', 'stadiums.std_name')->orderBy('created_at', 'desc')->get();
        $stadiums = Stadiums::all();
        $search = '';
        return view('booking', compact('booking', 'bookings', 'stadiums', 'search', 'history'), $data);
    }

    public function addBooking(Request $request)
    {
        $booking = Booking::where('bk_std_id', $request->bk_std_id)
            ->where('bk_date',  $request->bk_date)
            ->get();
        // dd(count($booking));
        if (count($booking) == 0) {
            //บันทึกข้อมูล;
            $booking = new Booking;
            $booking->bk_std_id = $request->bk_std_id;
            $booking->bk_username = auth()->user()->username;
            $booking->bk_date = $request->bk_date;
            $booking->bk_str_time = $request->bk_str_time;
            $booking->bk_end_time = $request->bk_end_time;
            $booking->bk_slip = $request->bk_slip;
            $booking->bk_status = 1;
            $booking->save();
            Alert::success('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
            return redirect()->back()->with('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
        } else {

            foreach ($booking as $bk) {
                if (($bk->bk_str_time >= $request->bk_str_time && $bk->bk_str_time >= $request->bk_end_time) || ($bk->bk_end_time <= $request->bk_str_time && $bk->bk_end_time <= $request->bk_end_time)) {
                    //บันทึกข้อมูล;
                    $booking = new Booking;
                    $booking->bk_std_id = $request->bk_std_id;
                    $booking->bk_username = auth()->user()->username;
                    $booking->bk_date = $request->bk_date;
                    $booking->bk_str_time = $request->bk_str_time;
                    $booking->bk_end_time = $request->bk_end_time;
                    $booking->bk_slip = $request->bk_slip;
                    $booking->bk_status = 1;
                    $booking->save();

                    Alert::success('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
                    return redirect()->back()->with('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
                } else {

                    Alert::error('ไม่สำเร็จ', 'ไม่สามารถจองในช่วงเวลาดังกล่าวได้');
                    return redirect()->back()->with('ไม่สำเร็จ', 'ไม่สามารถจองในช่วงเวลาดังกล่าวได้');
                }
            }
        }
    }

    public function editBooking($id)
    {
        $Booking = Booking::find($id);
        return view('booking', compact('Booking'));
    }

    public function updateBooking(Request $request, $id)
    {
        $booking = Booking::find($id);

        $img_path = $booking->bk_slip;
        if ($img_path) {
            $image_path = public_path('/' . $img_path);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $date = date("Y-m-d");
        $file = $request->file('bk_slip');

        if ($file) {
            $bk_slip =  $date . '-slipe-' . auth()->user()->username;
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $bk_slip . '.' . $ext;
            $uploade_path = 'uploads/slips/';
            $image_url = $uploade_path . $image_full_name;
            $file->move($uploade_path, $image_full_name);

            Booking::find($id)->update(
                [
                    'bk_std_id' => $request->bk_std_id,
                    'bk_date' => $request->bk_date,
                    'bk_str_time' => $request->bk_str_time,
                    'bk_end_time' => $request->bk_end_time,
                    'bk_slip' => $image_url,
                    'bk_status' => 2,
                    
                ]
            );
        } else {
            Booking::find($id)->update(
                [
                    'bk_std_id' => $request->bk_std_id,
                    'bk_date' => $request->bk_date,
                    'bk_str_time' => $request->bk_str_time,
                    'bk_end_time' => $request->bk_end_time,
                    'bk_status' => 1,

                ]
            );
        }
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
