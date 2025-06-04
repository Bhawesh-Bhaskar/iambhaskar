<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;

class RoleController extends Controller
{
    public function index()
    {        
        $roles = Role::orderBy('created_at', 'desc')->get();
        return view('admin.pages.role.index')->with(['title'=>'Roles List', 'roles'=>$roles]);
    }
    
    public function create()
    {
        $permissions = Permission::where(['user_type' => 'Admin'])->select('id', 'group', 'display_name','user_type')->get();

        $perm = [];
        if (!empty($permissions))
        {
            foreach ($permissions as $key => $value)
            {
                $perm[$value->group][$key]['id']           = $value->id;
                $perm[$value->group][$key]['display_name'] = $value->display_name;
                $perm[$value->group][$key]['user_type'] = $value->user_type;
            }
        }        
        return view('admin.pages.role.create')->with(['title' => 'Add Role', 'perm'=>$perm]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required',            
            'description' => 'required',
            'status' => 'required',
            'user_type' => 'required'
        ]);
        
        try 
        {
            $rs = Role::create([
                'name' =>$request->input('name'),
                'display_name' =>$request->input('display_name'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
                'user_type' => $request->input('user_type')
            ]);

            foreach ($request->permission as $key => $value)
            {
                PermissionRole::firstOrCreate(['permission_id' => $value, 'role_id' => $rs->id]);
            }
            
            if($rs)
            {    
                $message = array('flag'=>'alert-success', 'message'=>'Role Created Successfully');
                return redirect()->route('admin.roles.index')->with(['message'=>$message]);    
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to Create Role, Please try again');
            return redirect()->route('admin.roles.index')->with(['message'=>$message]); 
        }
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }

    public function edit(Request $request, $id)
    {
        try
        {           
            $roleData = Role::where('id', $id)->first();            
            if(empty($roleData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No Role found with provided id');
                return back()->with(['message'=>$message]);
            }

            $stored_permissions = Role::permission_role($id)->toArray();
            $permissions = Permission::where(['user_type' => 'Admin'])->select('id', 'group', 'display_name','user_type')->get();

            $perm = [];
            if (!empty($permissions))
            {
                foreach ($permissions as $key => $value)
                {
                    $perm[$value->group][$key]['id']           = $value->id;
                    $perm[$value->group][$key]['display_name'] = $value->display_name;
                    $perm[$value->group][$key]['user_type'] = $value->user_type;
                }
            }
            
            return view('admin.pages.role.edit')->with(['roleData'=>$roleData, 'title'=>'Edit Role', 'stored_permissions'=>$stored_permissions, 'perm'=>$perm]);           
        }
        catch (Exception $e)
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);         
        }
    }

    public function update(Request $request, $id)
    {      
        $request->validate([
            'name' => 'required',
            'display_name' => 'required',            
            'description' => 'required',
            'status' => 'required',
            'user_type' => 'required'
        ]);
              
        try 
        {             
            $data = [
                'name' =>$request->input('name'),
                'display_name' =>$request->input('display_name'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
                'user_type' => $request->input('user_type')
            ];
         
            $rs = Role::where(['id'=> $id])->update($data);  
            
            $stored_permissions = Role::permission_role($id);
            foreach ($stored_permissions as $key => $value)
            {
                if (!in_array($value, $request->permission))
                {
                    PermissionRole::where(['permission_id' => $value, 'role_id' => $id])->delete();
                }
            }
            foreach ($request->permission as $key => $value)
            {
                PermissionRole::firstOrCreate(['permission_id' => $value, 'role_id' => $id]);
            }
            
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Role updated successfully.');
                return redirect()->route('admin.roles.index')->with(['message'=>$message]);
            }
           
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update role, Please try again');
            return back()->with(['message'=>$message]);
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }
    
    public function delete(Request $request, $id)
    {
        try 
        {
            $rs = Role::destroy('id', $id);
            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'Role deleted Successfully');
                return redirect()->route('admin.roles.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to delete Role, Please try again');
            return redirect()->route('admin.roles.index')->with(['message'=>$message]); 
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }   
    }
}