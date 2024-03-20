<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use File;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => 'สนามกีฬา'
        ];

        $users = User::all();
        return view('admin.user', compact('users'), $data);
    }

    public function addUser(Request $request)
    {
        $date = date("Y-m-d");

        if ($file = $request->file('qrcode')) {
            $qrcode =  $request->username . '-' . $date . '-qrcode';
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $qrcode . '.' . $ext;
            $uploade_path = 'uploads/qrcode/';
            $image_url = $uploade_path . $image_full_name;
            $file->move($uploade_path, $image_full_name);

            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'qrcode' => $image_url,
                'status' => $request->status,
            ]);
        }

        Alert::success('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
        return redirect()->back()->with('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $img = $user->std_img_path;
        $image_path = public_path('/' . $img);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $date = date("Y-m-d");

        if ($file = $request->file('qrcode')) {
            $qrcode =  $request->username . '-' . $date . '-qrcode';
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $qrcode . '.' . $ext;
            $uploade_path = 'uploads/qrcode/';
            $image_url = $uploade_path . $image_full_name;
            $file->move($uploade_path, $image_full_name);

            //อัพเดทข้อมูล
            User::find($id)->update(
                [
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'qrcode' => $image_url,
                    'status' => $request->status,
                ]
            );
        }

        Alert::success('สำเร็จ', 'อัพเดทข้อมูลสำเร็จ');
        return redirect()->back()->with('success', 'อัพเดทข้อมูลสำเร็จ');
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        // Alert::success('สำเร็จ', 'ลบข้อมูสำเร็จ');
        return redirect()->back()->with('success', 'ลบข้อมูสำเร็จ');
    }
}
