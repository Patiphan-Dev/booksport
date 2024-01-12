<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'กฎกติกา'
        ];
        return view('admin.rule',$data);
    }
}
