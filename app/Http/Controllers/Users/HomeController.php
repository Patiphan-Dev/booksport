<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stadiums;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'หน้าแรก'
        ];
        $stadiums = Stadiums::all();
        return view('home', compact('stadiums'), $data);
    }

    public function about()
    {
        $data = [
            'title' => 'เกี่ยวกับเรา'
        ];
        return view('about', $data);
    }
}
