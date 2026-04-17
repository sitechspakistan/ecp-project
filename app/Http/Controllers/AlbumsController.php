<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Albums;
use Session;

class AlbumsController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = Albums::where('title', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = Albums::OrderBy('id', $sort)->paginate($limit);
        }
        return view('backend.albums.index', compact('data'));
    }

    public function create()
    {
        return view('backend.albums.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['is_active'] = 1;    
        Albums::create($data);
        Session::flash('success', 'Item added successfully');
        return redirect()->route('albums.index');
    }

    public function edit($id)
    {
        $data = Albums::find($id);        
        return view('backend.albums.edit', compact('data'));
    }
    
    public function update($id, Request $request)
    {
        $data = $request->except('_token');
        $data['gallery'] = $request->gallery??null;
        Albums::find($id)->update($data);
        Session::flash('success', 'Item update successfully');
        return redirect()->route('albums.index');
    }

    public function status($id)
    {
        $client = Albums::find($id);
        $client->is_active = ($client->is_active==1)?0:1;
        $client->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $count = count($request->ids);
        Albums::destroy($request->ids);
        Session::flash('success', "{$count} item(s) deleted");
        return redirect()->back();
    }
}
