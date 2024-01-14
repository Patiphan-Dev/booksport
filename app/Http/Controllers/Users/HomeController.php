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
        $stadiums = Stadiums::get();
        return view('home', compact('stadiums'), $data);
    }
}
