<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\User;
use App\Models\UserGroups;
use App\Models\UserLog;
use Illuminate\Validation\Rules\Password;
use Session;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = User::where('title', 'LIKE', "%{$q}%")->where('group_id', "!=",null)->where('user_type', 'admin')->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = User::where('group_id', "!=",null)->where('user_type', 'admin')->OrderBy('id', $sort)->paginate($limit);
        }
        $groups = UserGroups::OrderBy('name')->get();
        return view('backend.users.index', compact('data', 'groups'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);
        $data['user_type'] = 'admin';
        $data['is_active'] = 1;
        $data['password'] = bcrypt($request->password);
        User::create($data);
        Session::flash('success', 'User added successfully');
        return redirect()->back();
    }
    
    public function update($id, Request $request)
    {
        $data = $request->except('_token', 'password');
        if($request->has('password') && $request->password!='') {
            $data['password'] = bcrypt($request->password);
        }
        $data['user_type'] = 'admin';
        User::find($id)->update($data);
        Session::flash('success', 'User update successfully');
        return redirect()->back();
    }

    public function status($id)
    {
        $client = User::find($id);
        $client->is_active = ($client->is_active==1)?0:1;
        $client->save();
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $count = count($request->ids);
        User::destroy($request->ids);
        Session::flash('success', "{$count} users(s) deleted");
        return redirect()->back();
    }

    public function logs(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = UserLog::where('description', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = UserLog::OrderBy('id', $sort)->paginate($limit);
        }
        return view('backend.users.logs', compact('data'));
    }

    public function sellers(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        $query = User::whereIn('user_type', ['seller', 'buyer']);

        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $query->where(function ($innerQuery) use ($q) {
                $innerQuery->where('name', 'LIKE', "%{$q}%")
                    ->orWhere('email', 'LIKE', "%{$q}%");
            });
        }

        $data = $query->OrderBy('id', $sort)->paginate($limit);
        $memberships = Membership::where('is_active', 1)->orderBy('code')->get();
        return view('backend.users.sellers', compact('data', 'memberships'));
    }

    public function seller_status($id)
    {
        $client = User::find($id);
        $client->is_active = ($client->is_active==1)?0:1;
        $client->save();
        return redirect()->back();
    }

    public function seller_password_update(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::where('id', $id)->whereIn('user_type', ['seller', 'buyer'])->firstOrFail();
        $user->password = $request->password;
        $user->save();

        Session::flash('success', 'Password updated for '.$user->name);
        return redirect()->back();
    }

    public function seller_membership_expiry_update(Request $request, $id)
    {
        $request->validate([
            'membership_id' => ['required', 'integer', 'exists:memberships,id'],
            'start_date' => ['required', 'date'],
            'expiry_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $user = User::where('id', $id)->whereIn('user_type', ['seller', 'buyer'])->firstOrFail();
        $membership = Membership::findOrFail($request->membership_id);

        $user->membership_id = $membership->code;
        $user->membership_title = $membership->title;
        $user->start_date = $request->start_date;
        $user->expiry_date = $request->expiry_date;
        $user->save();

        Session::flash('success', 'Membership updated for '.$user->name);
        return redirect()->back();
    }

    public function delete_sellers(Request $request)
    {
        $count = count($request->ids);
        User::destroy($request->ids);
        Session::flash('success', "{$count} seller(s) deleted");
        return redirect()->back();
    }
}
