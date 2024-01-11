<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|string|max:30',
                'password' => 'required|min:8',
            ],
            [
                'username.required' => 'กรุณากรอกชื่อผู้ใช้งาน',
                'password.required' => 'กรุณากรอกรหัสผ่าน',
            ]
        );

        $validated = auth()->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ], $request->password);

        $request->session()->regenerate();

        if ($validated) {
            if (auth()->user()->status == 1) {
                return redirect()->route('home')->with('success', 'เข้าสู่ระบบสำเร็จ');
            }
            
            if (auth()->user()->status == 9) {
                return redirect()->route('dashboard')->with('success', 'เข้าสู่ระบบสำเร็จ');
            }
        } else {
            return redirect()->back()->with('error', 'เข้าสู่ระบบไม่สำเร็จ');
        }
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:30',
            'email' => 'required|email|max:30|unique:users',
            'password' => 'required|min:8|confirmed',

        ], [
            'username.required' => 'กรุณากรอกชื่อผู้ใช้งาน',
            'email.required' => 'กรุณากรอกอีเมล',
            'password.required' => 'กรุณากรอกรหัสผ่าน',

        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $validated = auth()->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ], $request->password);

        $request->session()->regenerate();

        if ($validated) {
            return redirect()->route('home')->with('success', 'เข้าสู่ระบบสำเร็จ');
        } else {
            return redirect()->back()->with('error', 'เข้าสู่ระบบไม่สำเร็จ');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('getLogin')->with('success', 'คุณออกจากระบบเรียบร้อยแล้ว');
    }
}
