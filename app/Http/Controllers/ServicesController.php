<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use Session;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = Services::where('title', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = Services::OrderBy('id', $sort)->paginate($limit);
        }
        return view('backend.services.index', compact('data'));
    }

    public function create()
    {
        $services = Services::OrderBy('id', 'DESC')->get();
        $sort_order = Services::max('sort_order')+1;
        return view('backend.services.create', compact('services', 'sort_order'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['is_active'] = 1;
        Services::create($data);
        Session::flash('success', 'Item added successfully');
        return redirect()->route('services.index');
    }

    public function edit($id)
    {
        $data = Services::find($id);        
        $services = Services::where('id', '!=', $id)->OrderBy('id', 'DESC')->get();
        return view('backend.services.edit', compact('services', 'data'));
    }
    
    public function update($id, Request $request)
    {
        $data = $request->except('_token');
        $data['meta'] = $request->meta??null;
        $data['seo_data'] = $request->seo_data??null;
        Services::find($id)->update($data);
        Session::flash('success', 'Item update successfully');
        return redirect()->route('services.index');
    }

    public function status($id)
    {
        $client = Services::find($id);
        $client->is_active = ($client->is_active==1)?0:1;
        $client->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $count = count($request->ids);
        Services::destroy($request->ids);
        Session::flash('success', "{$count} item(s) deleted");
        return redirect()->back();
    }
}
