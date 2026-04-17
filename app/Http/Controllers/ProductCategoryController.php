<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategories;
use App\Models\ProductCategoryRelation;
use Session;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = ProductCategories::withCount('products')->where('title', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = ProductCategories::withCount('products')->OrderBy('id', $sort)->paginate($limit);
        }
        return view('backend.products.category.index', compact('data'));
    }

    public function create()
    {
        return view('backend.products.category.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['is_active'] = 1;
        ProductCategories::create($data);
        Session::flash('success', 'Item added successfully');
        return redirect()->route('products-categories.index');
    }

    public function edit($id)
    {
        $data = ProductCategories::find($id);
        return view('backend.products.category.edit', compact('data'));
    }
    
    public function update($id, Request $request)
    {
        $data = $request->except('_token');
        ProductCategories::find($id)->update($data);
        Session::flash('success', 'Item update successfully');
        return redirect()->route('products-categories.index');
    }

    public function status($id)
    {
        $client = ProductCategories::find($id);
        $client->is_active = ($client->is_active==1)?0:1;
        $client->save();
        return redirect()->route('products-categories.index');
    }

    public function delete(Request $request)
    {
        $count = count($request->ids);
        ProductCategoryRelation::whereIn('category_id', $request->ids)->delete();
        ProductCategories::destroy($request->ids);
        Session::flash('success', "{$count} item(s) deleted");
        return redirect()->route('products-categories.index');
    }
}
