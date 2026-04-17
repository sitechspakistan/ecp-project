<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategories;
use App\Models\NewsCategoryRelation;
use Session;

class NewsCategoryController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = NewsCategories::where('title', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = NewsCategories::OrderBy('id', $sort)->paginate($limit);
        }
        return view('backend.news.categories', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['is_active'] = 1;
        NewsCategories::create($data);
        Session::flash('success', 'Item added successfully');
        return redirect()->back();
    }
    
    public function update($id, Request $request)
    {
        $data = $request->except('_token');
        NewsCategories::find($id)->update($data);
        Session::flash('success', 'Item update successfully');
        return redirect()->back();
    }

    public function status($id)
    {
        $client = NewsCategories::find($id);
        $client->is_active = ($client->is_active==1)?0:1;
        $client->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $count = count($request->ids);
        NewsCategoryRelation::whereIn('category_id', $request->ids)->delete();
        NewsCategories::destroy($request->ids);
        Session::flash('success', "{$count} item(s) deleted");
        return redirect()->back();
    }
}
