<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use RealRashid\SweetAlert\Facades\Alert;

class ReserveController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'การจอง'
        ];
        return view('admin.reserve', $data);
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

    public function deleteReserve($id)
    {
        $delete = Booking::find($id)->delete();
        Alert::success('สำเร็จ', 'ลบข้อมูสำเร็จ');
        return redirect()->back()->with('success', 'ลบข้อมูสำเร็จ');
    }
}
