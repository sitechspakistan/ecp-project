<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\BlogCategories;
use App\Models\BlogCategoryRelation;
use App\Models\Configurations;
use Session;

class BlogsController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = Blogs::where('title', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = Blogs::OrderBy('id', $sort)->paginate($limit);
        }
        $seo = Configurations::find(1)->value('blogs_seo');
        return view('backend.blogs.index', compact('data', 'seo'));
    }

    public function create()
    {
        $categories = BlogCategories::where('is_active', 1)->OrderBy('title')->get();
        $sort_order = Blogs::max('sort_order')+1;
        return view('backend.blogs.create', compact('categories', 'sort_order'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['is_active'] = 1;
        $item = Blogs::create($data);
        if($request->has('categories') && !empty($request->categories)) {
            foreach($request->categories as $cat) {
                BlogCategoryRelation::create([
                    'blog_id'=>$item['id'],
                    'category_id'=>$cat,
                ]);
            }
        }
        Session::flash('success', 'Item added successfully');
        return redirect()->route('blogs.index');
    }

    public function edit($id)
    {
        $data = Blogs::find($id);        
        $categories = BlogCategories::where('is_active', 1)->OrderBy('title')->get();
        $current_cats = BlogCategoryRelation::where('blog_id', $id)->pluck('category_id')->toArray();
        return view('backend.blogs.edit', compact('categories', 'current_cats', 'data'));
    }
    
    public function update($id, Request $request)
    {
        $data = $request->except('_token');
        $data['meta'] = $request->meta??null;
        $data['seo_data'] = $request->seo_data??null;
        Blogs::find($id)->update($data);
        BlogCategoryRelation::where('blog_id', $id)->delete();
        if($request->has('categories') && !empty($request->categories)) {
            foreach($request->categories as $cat) {
                BlogCategoryRelation::create([
                    'blog_id'=>$id,
                    'category_id'=>$cat,
                ]);
            }
        }
        Session::flash('success', 'Item update successfully');
        return redirect()->route('blogs.index');
    }

    public function status($id)
    {
        $client = Blogs::find($id);
        $client->is_active = ($client->is_active==1)?0:1;
        $client->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $count = count($request->ids);
        Blogs::destroy($request->ids);
        Session::flash('success', "{$count} item(s) deleted");
        return redirect()->back();
    }

    public function seo(Request $request)
    {
        $data = $request->except('_token');
        $data['blogs_seo'] = $request->seo_data??null;
        Configurations::find(1)->update($data);
        Session::flash('success', 'SEO Data update successfully');
        return redirect()->back();
    }
}
