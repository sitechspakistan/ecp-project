<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configurations;
use Session;

class ConfigurationsController extends Controller
{
    public function index()
    {
        $data = Configurations::find(1);
        return view('backend.configuration', compact('data'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');
        $data['sidebar_meta'] = $request->sidebar_meta??null;
        $data['social_meta'] = $request->social_meta??null;
        $data['footer_meta'] = $request->footer_meta??null;
        $data['topbar_meta'] = $request->topbar_meta??null;
        if(isset($request->robot)){
            $f_path = public_path('robots.txt');
            $f_robot=fopen($f_path,'w');
            fwrite($f_robot,$request->robot);
            fclose($f_robot);
        }
        Configurations::find(1)->update($data);
        Session::flash('success', 'Item added successfully');
        return redirect()->back();
    }
}
