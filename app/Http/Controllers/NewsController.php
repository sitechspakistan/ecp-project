<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategories;
use App\Models\NewsCategoryRelation;
use App\Models\Configurations;
use Session;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = News::where('title', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = News::OrderBy('id', $sort)->paginate($limit);
        }
        $seo = Configurations::find(1)->value('news_seo');
        return view('backend.news.index', compact('data', 'seo'));
    }

    public function create()
    {
        $categories = NewsCategories::where('is_active', 1)->OrderBy('title')->get();
        $sort_order = News::max('sort_order')+1;
        return view('backend.news.create', compact('categories', 'sort_order'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['is_active'] = 1;
        $item = News::create($data);
        if($request->has('categories') && !empty($request->categories)) {
            foreach($request->categories as $cat) {
                NewsCategoryRelation::create([
                    'news_id'=>$item['id'],
                    'category_id'=>$cat,
                ]);
            }
        }
        Session::flash('success', 'Item added successfully');
        return redirect()->route('news.index');
    }

    public function edit($id)
    {
        $data = News::find($id);        
        $categories = NewsCategories::where('is_active', 1)->OrderBy('title')->get();
        $current_cats = NewsCategoryRelation::where('news_id', $id)->pluck('category_id')->toArray();
        return view('backend.news.edit', compact('categories', 'current_cats', 'data'));
    }
    
    public function update($id, Request $request)
    {
        $data = $request->except('_token');
        $data['meta'] = $request->meta??null;
        $data['seo_data'] = $request->seo_data??null;
        News::find($id)->update($data);
        NewsCategoryRelation::where('news_id', $id)->delete();
        if($request->has('categories') && !empty($request->categories)) {
            foreach($request->categories as $cat) {
                NewsCategoryRelation::create([
                    'news_id'=>$id,
                    'category_id'=>$cat,
                ]);
            }
        }
        Session::flash('success', 'Item update successfully');
        return redirect()->route('news.index');
    }

    public function status($id)
    {
        $client = News::find($id);
        $client->is_active = ($client->is_active==1)?0:1;
        $client->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $count = count($request->ids);
        News::destroy($request->ids);
        Session::flash('success', "{$count} item(s) deleted");
        return redirect()->back();
    }

    public function seo(Request $request)
    {
        $data = $request->except('_token');
        $data['news_seo'] = $request->seo_data??null;
        Configurations::find(1)->update($data);
        Session::flash('success', 'SEO Data update successfully');
        return redirect()->back();
    }
}
