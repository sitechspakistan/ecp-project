<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use Session;

class MembershipController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort ?? 'DESC';
        $limit = $request->limit ?? 10;

        $query = Membership::query();
        if ($request->has('q') && $request->q != '') {
            $q = $request->q;
            $query->where(function ($innerQuery) use ($q) {
                $innerQuery->where('title', 'LIKE', "%{$q}%")
                    ->orWhere('code', 'LIKE', "%{$q}%")
                    ->orWhere('user_type', 'LIKE', "%{$q}%");
            });
        }

        $data = $query->orderBy('id', $sort)->paginate($limit);
        return view('backend.memberships.index', compact('data'));
    }

    public function create()
    {
        return view('backend.memberships.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|integer|unique:memberships,code',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'btn_txt' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'duration_value' => 'required|integer|min:1',
            'duration_type' => 'required|in:day,month,year',
            'user_type' => 'required|in:buyer,seller',
        ]);

        $data = $request->except('_token');
        $data['is_active'] = ($request->is_active === 'on' || $request->is_active == 1) ? 1 : 0;
        $data['is_default'] = ($request->is_default === 'on' || $request->is_default == 1) ? 1 : 0;
        $data['is_featured_eligible'] = ($request->is_featured_eligible === 'on' || $request->is_featured_eligible == 1) ? 1 : 0;

        if ($data['is_default'] == 1) {
            Membership::where('user_type', $data['user_type'])->update(['is_default' => 0]);
        }

        Membership::create($data);
        Session::flash('success', 'Membership added successfully');
        return redirect()->route('memberships.index');
    }

    public function edit($id)
    {
        $data = Membership::findOrFail($id);
        return view('backend.memberships.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'code' => "required|integer|unique:memberships,code,{$id}",
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'btn_txt' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'duration_value' => 'required|integer|min:1',
            'duration_type' => 'required|in:day,month,year',
            'user_type' => 'required|in:buyer,seller',
        ]);

        $data = $request->except('_token');
        $data['is_active'] = ($request->is_active === 'on' || $request->is_active == 1) ? 1 : 0;
        $data['is_default'] = ($request->is_default === 'on' || $request->is_default == 1) ? 1 : 0;
        $data['is_featured_eligible'] = ($request->is_featured_eligible === 'on' || $request->is_featured_eligible == 1) ? 1 : 0;

        if ($data['is_default'] == 1) {
            Membership::where('user_type', $data['user_type'])
                ->where('id', '!=', $id)
                ->update(['is_default' => 0]);
        }

        Membership::findOrFail($id)->update($data);
        Session::flash('success', 'Membership updated successfully');
        return redirect()->route('memberships.index');
    }

    public function status($id)
    {
        $membership = Membership::findOrFail($id);
        $membership->is_active = ($membership->is_active == 1) ? 0 : 1;
        $membership->save();
        return redirect()->route('memberships.index');
    }

    public function delete(Request $request)
    {
        $count = count($request->ids ?? []);
        if ($count > 0) {
            Membership::destroy($request->ids);
        }
        Session::flash('success', "{$count} membership(s) deleted");
        return redirect()->route('memberships.index');
    }
}
