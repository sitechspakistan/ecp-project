<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\ContactMails;
use App\Models\Subscribers;
use App\Models\Pages;
use App\Models\Services;
use App\Models\UserGroups;
use App\Models\User;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Testimonials;
use Session;

class AdminController extends Controller
{
    public function index()
    {
        $products_count = Products::where('is_active', 1)->count();
        $orders_count = Orders::count();
        $testimonials_count = Testimonials::where('is_active', 1)->count();
        $blogs_count = Blogs::where('is_active', 1)->count();
        $users_count = User::where('is_active', 1)->count();
        $pages_count = Pages::where('is_active', 1)->count();
        $messages = ContactMails::OrderBy('id', 'DESC')->limit(5)->get();
        $subscribers = Subscribers::OrderBy('id', 'DESC')->limit(5)->get();
        return view('backend.dashboard', compact('products_count', 'blogs_count', 'orders_count', 'users_count', 'pages_count', 'testimonials_count', 'messages', 'subscribers'));
    }

    public function profile()
    {
        $data = auth()->user();
        $groups = UserGroups::OrderBy('name')->get();
        return view('backend.profile', compact('data', 'groups'));
    }

    public function update_profile(Request $request)
    {
        $id = auth()->id();
        $data = $request->except('_token', 'password');
        if($request->has('password') && $request->password!='') {
            $data['password'] = bcrypt($request->password);
        }
        User::find($id)->update($data);
        Session::flash('success', 'Profile update successfully');
        return redirect()->back();
    }
}
