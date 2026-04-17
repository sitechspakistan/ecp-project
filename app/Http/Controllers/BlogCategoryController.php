<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategories;
use App\Models\BlogCategoryRelation;
use Session;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = BlogCategories::where('title', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = BlogCategories::OrderBy('id', $sort)->paginate($limit);
        }
        return view('backend.blogs.categories', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['is_active'] = 1;
        BlogCategories::create($data);
        Session::flash('success', 'Item added successfully');
        return redirect()->back();
    }
    
    public function update($id, Request $request)
    {
        $data = $request->except('_token');
        BlogCategories::find($id)->update($data);
        Session::flash('success', 'Item update successfully');
        return redirect()->back();
    }

    public function status($id)
    {
        $client = BlogCategories::find($id);
        $client->is_active = ($client->is_active==1)?0:1;
        $client->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $count = count($request->ids);
        BlogCategoryRelation::whereIn('category_id', $request->ids)->delete();
        BlogCategories::destroy($request->ids);
        Session::flash('success', "{$count} item(s) deleted");
        return redirect()->back();
    }
}
