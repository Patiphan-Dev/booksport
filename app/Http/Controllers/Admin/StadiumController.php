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
        return view('admin.stadium', $data);
    }

    public function addStadium(Request $request)
    {

        $images = $request->file('files');
        if ($request->hasFile('files')) :
            $i = 1;
            foreach ($images as $item) :
                $var = date_create();
                $time = date_format($var, 'YmdHis');
                $imageName = $request->std_name . '-' . $time. '-' .$i++;
                $item->move(base_path() . '/uploads/images_stadiums/', $imageName);
                $arr[] = $imageName;
            endforeach;
            $image = implode(",", $arr);
        else :
            $image = '';
        endif;

        //บันทึกข้อมูล
        $stadium = new Stadiums;
        $stadium->std_name = $request->std_name;
        $stadium->std_details = $request->std_details;
        $stadium->std_price = $request->std_price;
        $stadium->std_facilities = $request->std_facilities;
        $stadium->std_img_path = array('image' => $image);
        $stadium->status = '1';

        $stadium->save();

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
