<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonials;
use Session;

class TestimonialsController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = Testimonials::where('title', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = Testimonials::OrderBy('id', $sort)->paginate($limit);
        }
        return view('backend.testimonials.index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['is_active'] = 1;
        Testimonials::create($data);
        Session::flash('success', 'Item added successfully');
        return redirect()->back();
    }
    
    public function update($id, Request $request)
    {
        $data = $request->except('_token');
        Testimonials::find($id)->update($data);
        Session::flash('success', 'Item update successfully');
        return redirect()->back();
    }

    public function status($id)
    {
        $client = Testimonials::find($id);
        $client->is_active = ($client->is_active==1)?0:1;
        $client->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $count = count($request->ids);
        Testimonials::destroy($request->ids);
        Session::flash('success', "{$count} item(s) deleted");
        return redirect()->back();
    }
}
