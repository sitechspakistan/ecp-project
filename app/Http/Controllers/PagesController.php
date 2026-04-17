<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\PageComponents;
use Session;
use Str;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = Pages::where('title', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = Pages::OrderBy('id', $sort)->paginate($limit);
        }
        return view('backend.pages.index', compact('data'));
    }
    
    public function create()
    {
        $pages = Pages::OrderBy('id', 'DESC')->get();
        return view('backend.pages.create', compact('pages'));
    }
    
    public function store(Request $request)
    {
        $data = $request->except('components');
        $data['is_active'] = 1;
        $data['is_login'] = ($data['is_login'])??0;
        $page = Pages::create($data);
        $comps = [];
        if($request->has('components')) {
            foreach($request->components as $value) {
                $comps[] = $value;
            }
        }
        if(!empty($comps)) {
            foreach ($comps as $key => $value) {
                foreach($value as $k => $val) {
                    PageComponents::create([
                        'page_id'=>$page['id'],
                        'type'=>$k,
                        'title'=>(isset($val['title']))?$val['title']:null,
                        'meta'=>$val,
                        'sort_order'=>$key,
                    ]);
                }
            }
        }
        return redirect()->route('pages.index');
    }

    public function edit($id)
    {
        $pages = Pages::OrderBy('id', 'DESC')->get();
        $data = Pages::find($id);
        // if($request->has('log')) {
        //     $components = ComponentsLogs::where('log_id',$request->log)->where('page_id',$id)->OrderBy('sort_order','ASC')->get();
        // } else {
        //     $components = PageComponents::where('page_id',$id)->OrderBy('sort_order','ASC')->get();
        // }
        $components = PageComponents::where('page_id',$id)->OrderBy('sort_order','ASC')->get();
        return view('backend.pages.edit', compact('pages', 'data', 'components'));
    }

    public function update($id, Request $request)
    {
        $page = Pages::find($id);
        PageComponents::where('page_id',$id)->delete();
        $data = $request->except('components');
        $data['is_login'] = ($data['is_login'])??0;
        
        if($request->has('components')) {
            foreach($request->components as $value) {
                $comps[] = $value;
            }
        }
        if(!empty($comps)) {
            foreach ($comps as $key => $value) {
                foreach($value as $k => $val) {
                    PageComponents::create([
                        'page_id'=>$page['id'],
                        'type'=>$k,
                        'title'=>(isset($val['title']))?$val['title']:null,
                        'meta'=>$val,
                        'sort_order'=>$key,
                    ]);
                }
            }
        }
        $data['seo_data'] = $request->seo_data??null;
        $page->update($data);
        Session::flash('success', 'Page updated successfully');
        return redirect()->back();
    }

    public function status($id)
    {
        $client = Pages::find($id);
        $client->is_active = ($client->is_active==1)?0:1;
        $client->save();
        return redirect()->back();
    }

    public function getComponent(Request $request) {
        $rand = rand(99,9999);
        $comp = $request->comp;
        $view = view("backend.components.{$comp}",compact(['rand']))->render();
        return response()->json(['html' => $view, 'rand' => $rand]);
    }

    public function delete($id)
    {
        $page = Pages::find($id);
        if($page['is_home']!=1) {
            $page->delete();
            Session::flash('success', 'Page deleted successfully');
        }
        return redirect()->back();
    }
}
