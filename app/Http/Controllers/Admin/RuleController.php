<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class RuleController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'กฎกติกา'
        ];
        $rule = Rule::find(1);
        return view('admin.rule', compact('rule'), $data);
    }

    public function addRule(Request $request)
    {
        //บันทึกข้อมูล
        $rule = new Rule;
        $rule->rule_detail = $request->rule_detail;
        $rule->save();

        // แจ้งเตือน
        Alert::success('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
        return redirect()->back()->with('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
    }

    public function updateRule(Request $request)
    {
        //อัพเดทข้อมูล
        Rule::find(1)->update(
            [
                'rule_detail' => $request->rule_detail,
            ]
        );
        // แจ้งเตือน
        Alert::success('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
        return redirect()->back()->with('สำเร็จ', 'บันทึกข้อมูลสำเร็จ');
    }
}
