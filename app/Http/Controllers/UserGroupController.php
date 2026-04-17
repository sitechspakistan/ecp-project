<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGroups;
use App\Models\GroupModules;
use Session;

class UserGroupController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = UserGroups::where('title', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = UserGroups::OrderBy('id', $sort)->paginate($limit);
        }
        return view('backend.user-groups.index', compact('data'));
    }

    public function create()
    {
        return view('backend.user-groups.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $group = UserGroups::create(['name'=>$request->name]);
        if($request->has('modules')) {
            foreach ($request->modules as $key => $value) {
                GroupModules::create([
                    'group_id'=>$group['id'],
                    'module'=>$key,
                    '_show'=>(isset($value['_show']))?1:0,
                    '_create'=>(isset($value['_create']))?1:0,
                    '_edit'=>(isset($value['_edit']))?1:0,
                    '_delete'=>(isset($value['_delete']))?1:0,
                ]);
            }
        }
        Session::flash('success', 'Item added successfully');
        return redirect()->route('usergroups.index');
    }

    public function edit($id)
    {
        $data = UserGroups::find($id);        
        $modules = [];
        if(GroupModules::where('group_id',$id)->count()>0) {
            $modules = GroupModules::where('group_id',$id)->get()->groupBy('module')->toArray();
        }
        return view('backend.user-groups.edit', compact('data', 'modules'));
    }
    
    public function update($id, Request $request)
    {
        $data = $request->except('_token');
        UserGroups::find($id)->update($data);
        GroupModules::where('group_id',$id)->delete();
        if($request->has('modules')) {
            foreach ($request->modules as $key => $value) {
                GroupModules::create([
                    'group_id'=>$id,
                    'module'=>$key,
                    '_show'=>(isset($value['_show']))?1:0,
                    '_create'=>(isset($value['_create']))?1:0,
                    '_edit'=>(isset($value['_edit']))?1:0,
                    '_delete'=>(isset($value['_delete']))?1:0,
                ]);
            }
        }
        Session::flash('success', 'Item update successfully');
        return redirect()->route('usergroups.index');
    }

    public function delete(Request $request)
    {
        $count = count($request->ids);
        UserGroups::destroy($request->ids);
        Session::flash('success', "{$count} item(s) deleted");
        return redirect()->back();
    }
}
