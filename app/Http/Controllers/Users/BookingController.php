<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Stadiums;
use RealRashid\SweetAlert\Facades\Alert;
use File;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index($id)
    {
        $data = [
            'title' => 'จองสนามกีฬา'
        ];
        $booking = Booking::where('bk_std_id', $id)
            ->join('stadiums', 'bookings.bk_std_id', 'stadiums.id')
            ->select('users.username', 'users.qrcode', 'bookings.*', 'stadiums.std_name')
            ->orderBy('created_at', 'desc')->get();
        $history = Booking::where('bk_username', auth()->user()->username)
            ->join('stadiums', 'bookings.bk_std_id', 'stadiums.id')
            ->join('users', 'stadiums.std_supperuser', 'users.id')
            ->select('users.username', 'users.qrcode', 'bookings.*', 'stadiums.std_name')
            ->orderBy('created_at', 'desc')->paginate(10);
        $bookings = Booking::join('stadiums', 'bookings.bk_std_id', 'stadiums.id')
            ->select('bookings.*', 'stadiums.std_name')
            ->orderBy('created_at', 'desc')->get();
        $search = Stadiums::find($id);
        $stadiums = Stadiums::all();
        return view('booking', compact('booking', 'bookings', 'stadiums', 'search', 'history'), $data);
    }

    public function indexAll()
    {
        $data = [
            'title' => 'จองสนามกีฬา'
        ];
        $booking = Booking::join('stadiums', 'bookings.bk_std_id', 'stadiums.id')
            ->join('users', 'stadiums.std_supperuser', 'users.id')
            ->select('users.qrcode', 'bookings.*', 'stadiums.std_name')
            ->orderBy('created_at', 'desc')->get();
        $history = Booking::where('bk_username', auth()->user()->username)
            ->join('stadiums', 'bookings.bk_std_id', 'stadiums.id')
            ->join('users', 'stadiums.std_supperuser', 'users.id')
            ->select('users.qrcode', 'bookings.*', 'stadiums.std_name')
            ->orderBy('created_at', 'desc')
            ->get();
        $bookings = Booking::join('stadiums', 'bookings.bk_std_id', 'stadiums.id')
            ->join('users', 'stadiums.std_supperuser', 'users.id')
            ->select('users.qrcode', 'bookings.*', 'stadiums.std_name')
            ->orderBy('created_at', 'desc')
            ->get();
        $stadiums = Stadiums::all();
        $search = '';
        return view('booking', compact('booking', 'bookings', 'stadiums', 'search', 'history'), $data);
    }

    public function addBooking(Request $request)
    {
        // เช็กช่วงเวลาที่จอง
        $bk_std_id = $request->bk_std_id;
        $bk_date = $request->bk_date;
        $checkin = $request->bk_str_time;
        $checkout = $request->bk_end_time;

        $booking = Booking::where(function ($query) use ($bk_std_id, $bk_date, $checkin, $checkout) {
            $query->where(function ($query) use ($bk_std_id, $bk_date, $checkin, $checkout) {
                $query->where('bk_std_id', $bk_std_id)
                    ->where('bk_date', $bk_date)
                    ->where('bk_str_time', '>=', $checkin)
                    ->where('bk_str_time', '<', $checkout);
            })
                ->orWhere(function ($query) use ($bk_std_id, $bk_date, $checkin, $checkout) {
                    $query->where('bk_std_id', $bk_std_id)
                        ->where('bk_date', $bk_date)
                        ->where('bk_end_time', '>', $checkin)
                        ->where('bk_end_time', '<=', $checkout);
                });
        })
            ->orWhere(function ($query) use ($bk_std_id, $bk_date, $checkin, $checkout) {
                $query->where('bk_std_id', $bk_std_id)
                    ->where('bk_date', $bk_date)
                    ->where('bk_str_time', '<=', $checkin)
                    ->where('bk_end_time', '>=', $checkout);
            })
            ->first();


        // คำนวณจำนวนชั่วโมง
        $hoursCheckIn = Carbon::parse($request->bk_str_time);
        $hoursCheckOut = Carbon::parse($request->bk_end_time);
        // Calculate the difference in minutes
        $minutes = $hoursCheckIn->diffInMinutes($hoursCheckOut);

        $getprice = Stadiums::find($request->bk_std_id);

        $price = ($getprice->std_price / 60) * $minutes;
        $totalPrice = round($price);
        // dd($getprice->std_price,  $minutes, $totalPrice);


        // dd($booking);
        if ($booking == null) {
            //บันทึกข้อมูล;
            $booking = new Booking;
            $booking->bk_std_id = $request->bk_std_id;
            $booking->bk_username = auth()->user()->username;
            $booking->bk_date = $request->bk_date;
            $booking->bk_str_time = $request->bk_str_time;
            $booking->bk_end_time = $request->bk_end_time;
            $booking->bk_sumtime = $minutes;
            $booking->bk_total_price = $totalPrice;
            $booking->bk_status = 1;
            $booking->save();

            Alert::success('สำเร็จ', 'จองสนามสำเสร็จ');
            return redirect()->back()->with('สำเร็จ', 'จองสนามสำเสร็จ');
        } else {

            Alert::error('ไม่สำเร็จ', 'ไม่สามารถจองในช่วงเวลาดังกล่าวได้');
            return redirect()->back()->with('ไม่สำเร็จ', 'ไม่สามารถจองในช่วงเวลาดังกล่าวได้');
        }
    }

    public function editBooking($id)
    {
        $Booking = Booking::find($id);
        return view('booking', compact('Booking'));
    }

    public function updateBooking(Request $request, $id)
    {
        // เช็กช่วงเวลาที่จอง
        $bk_std_id = $request->bk_std_id;
        $bk_date = $request->bk_date;
        $checkin = $request->bk_str_time;
        $checkout = $request->bk_end_time;

        $bookings = Booking::where(function ($query) use ($id, $bk_std_id, $bk_date, $checkin, $checkout) {
            $query->where(function ($query) use ($id, $bk_std_id, $bk_date, $checkin, $checkout) {
                $query->where('id', '!=', $id)
                    ->where('bk_std_id', $bk_std_id)
                    ->where('bk_date', $bk_date)
                    ->where('bk_str_time', '>=', $checkin)
                    ->where('bk_str_time', '<', $checkout);
            })
                ->orWhere(function ($query) use ($id, $bk_std_id, $bk_date, $checkin, $checkout) {
                    $query->where('id', '!=', $id)
                        ->where('bk_std_id', $bk_std_id)
                        ->where('bk_date', $bk_date)
                        ->where('bk_end_time', '>', $checkin)
                        ->where('bk_end_time', '<=', $checkout);
                });
        })
            ->orWhere(function ($query) use ($id, $bk_std_id, $bk_date, $checkin, $checkout) {
                $query->where('id', '!=', $id)
                    ->where('bk_std_id', $bk_std_id)
                    ->where('bk_date', $bk_date)
                    ->where('bk_str_time', '<=', $checkin)
                    ->where('bk_end_time', '>=', $checkout);
            })
            ->first();


        // คำนวณจำนวนชั่วโมง
        $hoursCheckIn = Carbon::parse($request->bk_str_time);
        $hoursCheckOut = Carbon::parse($request->bk_end_time);
        // Calculate the difference in minutes
        $minutes = $hoursCheckIn->diffInMinutes($hoursCheckOut);

        $getprice = Stadiums::find($request->bk_std_id);

        $price = ($getprice->std_price / 60) * $minutes;
        $totalPrice = round($price);
        // dd($getprice->std_price,  $minutes, $totalPrice);


        // ตึงข้อมูลตามไอดีมาตรวจสอบสลิป
        $booking = Booking::find($id);

        $date = date("Y-m-d");
        $time = date("His");
        $file = $request->file('bk_slip');

        if ($file) {

            // ลบรูปภาพในโฟลเดอร์
            $img_path = $booking->bk_slip;
            if ($img_path) {
                $image_path = public_path($img_path);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            // เพิ่มรูปภาพเข้าไปใหม่
            $bk_slip =  $date . '-' . $time . '-slipe-' . auth()->user()->username;
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $bk_slip . '.' . $ext;
            $uploade_path = 'uploads/slips/';
            $image_url = $uploade_path . $image_full_name;
            $file->move($uploade_path, $image_full_name);

            if ($bookings == null) {
                // อัพเดทข้อมูลการจอง
                Booking::find($id)->update(
                    [
                        'bk_std_id' => $request->bk_std_id,
                        'bk_date' => $request->bk_date,
                        'bk_str_time' => $request->bk_str_time,
                        'bk_end_time' => $request->bk_end_time,
                        'bk_slip' => $image_url,
                        'bk_sumtime' => $minutes,
                        'bk_total_price' => $totalPrice,
                        'bk_status' => 2,
                    ]
                );
                Alert::success('สำเร็จ', 'รอตรวจสอบจากแอดมิน');
                return redirect()->back()->with('สำเร็จ', 'รอตรวจสอบจากแอดมิน');
            } else {
                Alert::error('ไม่สำเร็จ', 'ไม่สามารถจองในช่วงเวลาดังกล่าวได้');
                return redirect()->back()->with('ไม่สำเร็จ', 'ไม่สามารถจองในช่วงเวลาดังกล่าวได้');
            }
        } else {
            if ($bookings == null) {
                Booking::find($id)->update(
                    [
                        'bk_std_id' => $request->bk_std_id,
                        'bk_date' => $request->bk_date,
                        'bk_str_time' => $request->bk_str_time,
                        'bk_end_time' => $request->bk_end_time,
                        'bk_sumtime' => $minutes,
                        'bk_total_price' => $totalPrice,
                        'bk_status' => 1,
                    ]
                );
                Alert::success('สำเร็จ', 'รอตรวจสอบจากแอดมิน');
                return redirect()->back()->with('สำเร็จ', 'รอตรวจสอบจากแอดมิน');
            } else {
                Alert::error('ไม่สำเร็จ', 'ไม่สามารถจองในช่วงเวลาดังกล่าวได้');
                return redirect()->back()->with('ไม่สำเร็จ', 'ไม่สามารถจองในช่วงเวลาดังกล่าวได้');
            }
        }
        Alert::success('สำเร็จ', 'อัพเดทข้อมูลสำเร็จ');
        return redirect()->back()->with('success', 'อัพเดทข้อมูลสำเร็จ');
    }

    public function deleteBooking($id)
    {
        Booking::find($id);
        Alert::success('สำเร็จ', 'ลบข้อมูสำเร็จ');
        return redirect()->back()->with('success', 'ลบข้อมูสำเร็จ');
    }
}
