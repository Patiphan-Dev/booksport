<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Stadiums;
use RealRashid\SweetAlert\Facades\Alert;

class StadiumController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'สนามกีฬา'
        ];
        $stadiums = Stadiums::all();
        return view('admin.stadium', compact('stadiums'), $data);
    }

    public function addStadium(Request $request)
    {
        $time = date("Y-m-d");

        if ($files = $request->file('std_img_path')) {

            // dd($files);

            $i = 1;
            foreach ($files as $file) {
                $std_img_path =  $request->std_name . '-' . $time . '-img-' . $i++;
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $std_img_path . '.' . $ext;
                $uploade_path = 'uploads/stadiums/';
                $image_url = $uploade_path . $image_full_name;
                $file->move($uploade_path, $image_full_name);
                $arr[] = $image_url;
            }
            $std_img_path = implode(",", $arr);

            //บันทึกข้อมูล
            $stadium = new Stadiums;
            $stadium->std_name = $request->std_name;
            $stadium->std_details = $request->std_details;
            $stadium->std_price = $request->std_price;
            $stadium->std_facilities = $request->std_facilities;
            $stadium->std_img_path = $std_img_path;
            $stadium->std_status = '1';
            $stadium->save();
        }

        Alert::success('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
        return redirect()->back()->with('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
    }

    public function editStadium($id)
    {
        $stadiums = Stadiums::find($id);
        return view('admin.stadium', compact('stadiums'));
    }

    public function updateStadium(Request $request, $id)
    {
        $update = Stadiums::find($id)->update(
            [
                'std_name' => $request->std_name,
                'std_details' => $request->std_details,
                'std_price' => $request->std_price,
                'std_facilities' => $request->std_facilities,
                'status' => $request->status,
            ]
        );
        Alert::success('สำเร็จ', 'อัพเดทข้อมูลสำเร็จ');
        return redirect()->back()->with('success', 'อัพเดทข้อมูลสำเร็จ');
    }

    public function deleteStadium($id)
    {
        $delete = Stadiums::find($id)->delete();
        Alert::success('สำเร็จ', 'ลบข้อมูสำเร็จ');
        return redirect()->back()->with('success', 'ลบข้อมูสำเร็จ');
    }
}