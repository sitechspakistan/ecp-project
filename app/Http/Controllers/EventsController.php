<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\EventCategories;
use App\Models\EventCategoryRelation;
use App\Models\Configurations;
use Session;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = Events::where('title', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = Events::OrderBy('id', $sort)->paginate($limit);
        }
        $seo = Configurations::find(1)->value('events_seo');
        return view('backend.events.index', compact('data', 'seo'));
    }

    public function create()
    {
        $categories = EventCategories::where('is_active', 1)->OrderBy('title')->get();
        $sort_order = Events::max('sort_order')+1;
        return view('backend.events.create', compact('categories', 'sort_order'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['is_active'] = 1;
        $item = Events::create($data);
        if($request->has('categories') && !empty($request->categories)) {
            foreach($request->categories as $cat) {
                EventCategoryRelation::create([
                    'event_id'=>$item['id'],
                    'category_id'=>$cat,
                ]);
            }
        }
        Session::flash('success', 'Item added successfully');
        return redirect()->route('events.index');
    }

    public function edit($id)
    {
        $data = Events::find($id);        
        $categories = EventCategories::where('is_active', 1)->OrderBy('title')->get();
        $current_cats = EventCategoryRelation::where('event_id', $id)->pluck('category_id')->toArray();
        return view('backend.events.edit', compact('categories', 'current_cats', 'data'));
    }
    
    public function update($id, Request $request)
    {
        $data = $request->except('_token');
        $data['meta'] = $request->meta??null;
        $data['seo_data'] = $request->seo_data??null;
        Events::find($id)->update($data);
        EventCategoryRelation::where('event_id', $id)->delete();
        if($request->has('categories') && !empty($request->categories)) {
            foreach($request->categories as $cat) {
                EventCategoryRelation::create([
                    'event_id'=>$id,
                    'category_id'=>$cat,
                ]);
            }
        }
        Session::flash('success', 'Item update successfully');
        return redirect()->route('events.index');
    }

    public function status($id)
    {
        $client = Events::find($id);
        $client->is_active = ($client->is_active==1)?0:1;
        $client->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $count = count($request->ids);
        Events::destroy($request->ids);
        Session::flash('success', "{$count} item(s) deleted");
        return redirect()->back();
    }

    public function seo(Request $request)
    {
        $data = $request->except('_token');
        $data['events_seo'] = $request->seo_data??null;
        Configurations::find(1)->update($data);
        Session::flash('success', 'SEO Data update successfully');
        return redirect()->back();
    }
}
