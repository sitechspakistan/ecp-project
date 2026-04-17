<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = Orders::with('user','orderdetail')->where('order_no', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = Orders::with('user','orderdetail')->OrderBy('id', $sort)->paginate($limit);
        }
        return view('backend.orders.index', compact('data'));
    }
}
