<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMails;
use App\Models\Subscribers;
use Session;

class InboxController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = ContactMails::where('name', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = ContactMails::OrderBy('id', $sort)->paginate($limit);
        }
        return view('backend.inbox.index', compact('data'));
    }

    public function delete_inbox(Request $request)
    {
        $count = count($request->ids);
        ContactMails::destroy($request->ids);
        Session::flash('success', "{$count} item(s) deleted");
        return redirect()->back();
    }
    
    public function subscribers(Request $request)
    {
        // $sort = $request->sort??'DESC';
        // $limit = $request->limit??10;
        // if($request->has('q') && $request->q!='') {
        //     $q = $request->q;
        //     $data = Subscribers::where('email', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        // } else {
        //     $data = Subscribers::OrderBy('id', $sort)->paginate($limit);
        // }
        $data = Subscribers::OrderBy('id', 'DESC')->get();
        return view('backend.inbox.subscribers', compact('data'));
    }

    public function delete_subscribers(Request $request)
    {
        $count = count($request->ids);
        Subscribers::destroy($request->ids);
        Session::flash('success', "{$count} item(s) deleted");
        return redirect()->back();
    }
}
