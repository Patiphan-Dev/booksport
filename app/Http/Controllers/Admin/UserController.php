<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

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

        //บันทึกข้อมูล
        // $user = new User;
        // $user->username = $request->username;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->status = $request->status;
        // $user->save();

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,

        ]);

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
        //อัพเดทข้อมูล
        User::find($id)->update(
            [
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => $request->status,
            ]
        );

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
