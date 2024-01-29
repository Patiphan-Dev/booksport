<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stadiums;
use App\Models\Rule;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'หน้าแรก'
        ];
        $stadiums = Stadiums::all();
        $rules = Rule::find(1);
        return view('home', compact('stadiums','rules'), $data);
    }

    public function about()
    {
        $data = [
            'title' => 'เกี่ยวกับเรา'
        ];
        return view('about', $data);
    }
}
