<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuItems;
use App\Models\Pages;
use App\Models\Services;
use Session;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::OrderBy('id','DESC')->get();
        return view('backend.menu.index', ['menus'=>$menus]);
    }

    public function edit($id)
    {
        $menus = Menu::OrderBy('id','DESC')->get();
        $data = Menu::find($id);
        $pages = Pages::OrderBy('title')->pluck('title','slug')->toArray();
        $services = Services::where('is_active',1)->OrderBy('title')->pluck('title','slug')->toArray();
        return view('backend.menu.index', ['menus'=>$menus, 'data'=>$data, 'pages'=>$pages, 'services'=>$services]);
    }

    public function store(Request $request)
    {
        $data = Menu::create(['title'=>$request->title]);
        return redirect()->route('editMenu',$data['id']);
    }
    
    public function update($id, Request $request)
    {
        $data = $request->except(['items', 'orders', '_token']);
        if($request->has('is_primary')) {
            Menu::where('is_primary',1)->update(['is_primary'=>0]);
        }
        Menu::find($id)->update($data);
        $items = $request->items??[];        
        $orders = $request->has('orders')?json_decode($request->orders):[];
        MenuItems::where('menu_id',$id)->delete();
        if(!empty($items) && $orders) {
            $menu_items = [];
            foreach($orders as $key => $value) {            
                $parent = MenuItems::create([
                    'menu_id'=>$id,
                    'title'=>$items[$value->id]['title']??null,
                    'type'=>$items[$value->id]['type']??null,
                    'slug'=>$items[$value->id]['slug']??null,
                    'url'=>$items[$value->id]['url']??null,
                    'new_window'=>$items[$value->id]['new_window']??null,
                    'sort_order'=>$key,
                    'parent'=>null,
                ]);
                if(isset($value->children)) {
                    $this->updateOrder($parent['id'],$value->children, $items, $id);
                }
            }
            // MenuItems::insert($menu_items);
        }
        return redirect()->route('editMenu',$id);
    }

    public function delete($id)
    {
        MenuItems::where('menu_id',$id)->delete();
        Menu::destroy($id);
        return redirect()->route('menuEditor');
    }

    public function add_item(Request $request) {
        $rand = rand(1,200); $data = [];
        $pages = Pages::OrderBy('title')->pluck('title','slug')->toArray();
        $services = Services::where('is_active',1)->OrderBy('title')->pluck('title','slug')->toArray();
        if($request->type=='page') {
            $page = Pages::where('slug', $request->id)->first();
            $data['title'] = $page['title'];
            $data['slug'] = $page['slug'];
            $data['id'] = $page['id'];
            return view('backend.menu.menu-item',['data'=>$data, 'type'=>'page', 'rand'=>$rand, 'pages'=>$pages, 'services'=>$services])->render();
        } elseif($request->type=='service') {
            $service = Services::find($request->id);
            $data['title'] = $service['title'];
            $data['slug'] = $service['slug'];
            $data['id'] = $service['id'];
            return view('backend.menu.menu-item',['data'=>$data, 'type'=>'service', 'rand'=>$rand, 'pages'=>$pages, 'services'=>$services])->render();
        } elseif($request->type=='mega_menu') {
            //
        } elseif($request->type=='custom') {
            $data['title'] = $request->title;
            $data['type'] = 'custom';
            $data['url'] = $request->url;
            return view('backend.menu.menu-item',['data'=>$data, 'type'=>'custom', 'rand'=>$rand, 'pages'=>$pages, 'services'=>$services])->render();
        }
    }

    public function updateOrder($menu_id, $childrens, $items, $mid) {
        $menu_item = [];
        foreach($childrens as $k => $child){
            $parent = MenuItems::create([
                'menu_id'=>$mid,
                'title'=>$items[$child->id]['title']??null,
                'type'=>$items[$child->id]['type']??null,
                'slug'=>$items[$child->id]['slug']??null,
                'url'=>$items[$child->id]['url']??null,
                'new_window'=>$items[$child->id]['new_window']??null,
                'sort_order'=>$k,
                'parent'=>$menu_id,
            ]);
            if(isset($child->children)) {
                $this->updateOrder($parent['id'],$child->children, $items, $mid);
            }
        }
    }
}
