<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Stadiums;
use File;

class ReserveController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'การจอง'
        ];
        $bookings = Booking::join('stadiums', 'bookings.bk_std_id', 'stadiums.id')->select('bookings.*', 'stadiums.std_name')->orderBy('created_at', 'desc')->get();
        $stadiums = Stadiums::all();
        return view('admin.reserve',compact('bookings','stadiums'), $data);
    }

    public function addReserve(Request $request)
    {
        //บันทึกข้อมูล
        $reserve = new Booking;
        $reserve->bk_std_id = $request->bk_std_id;
        $reserve->bk_username = $request->bk_username;
        $reserve->bk_date = $request->bk_date;
        $reserve->bk_str_time = $request->bk_str_time;
        $reserve->bk_end_time = $request->bk_end_time;
        $reserve->bk_slip = $request->bk_slip;
        $reserve->bk_status = $request->bk_status;
        $reserve->save();

        // แจ้งเตือน ไลน์
        Alert::success('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
        return redirect()->back()->with('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
    }

    public function editReserve($id)
    {
        $reserve = Booking::find($id);
        return view('admin.reserve', compact('reserve'));
    }

    public function updateReserve(Request $request, $id)
    {
        $booking = Booking::find($id);

        $img_path = $booking->bk_slip;
        if ($img_path) {
            $image_path = public_path('/'.$img_path);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $date = date("Y-m-d");
        $time = date("His");
        // dd($date, $time);
        $file = $request->file('bk_slip');

        if ($file) {
            $bk_slip =  $date . '-' . $time . '-slipe-' . auth()->user()->username;
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
                    'bk_status' => $request->bk_status,
                ]
            );
        } else {
            Booking::find($id)->update(
                [
                    'bk_std_id' => $request->bk_std_id,
                    'bk_date' => $request->bk_date,
                    'bk_str_time' => $request->bk_str_time,
                    'bk_end_time' => $request->bk_end_time,
                    'bk_status' => $request->bk_status,
                ]
            );
        }

        // $update = Booking::find($id)->update(
        //     [
        //         'bk_std_id' => $request->bk_std_id,
        //         'bk_date' => $request->bk_date,
        //         'bk_str_time' => $request->bk_str_time,
        //         'bk_end_time' => $request->bk_end_time,
        //         'bk_slip' => $request->bk_slip,
        //         'bk_status' => $request->bk_status,
        //         'bk_node' => $request->bk_node,
        //     ]
        // );
        Alert::success('สำเร็จ', 'อัพเดทข้อมูลสำเร็จ');
        return redirect()->back()->with('success', 'อัพเดทข้อมูลสำเร็จ');
    }

    public function deleteReserve($id)
    {
        $delete = Booking::find($id)->delete();
        Alert::success('สำเร็จ', 'ลบข้อมูสำเร็จ');
        return redirect()->back()->with('success', 'ลบข้อมูสำเร็จ');
    }

    // public function index()
    // {
    //     $data = [
    //         'title' => 'การชำระเงิน'
    //     ];
    //     $bookings = Booking::where('bk_status','2')->join('stadiums', 'bookings.bk_std_id', 'stadiums.id')->select('bookings.*', 'stadiums.std_name')->orderBy('created_at', 'desc')->get();
    //     $stadiums = Stadiums::all();
    //     return view('admin.payment',compact('bookings','stadiums'), $data);
    // }
}
