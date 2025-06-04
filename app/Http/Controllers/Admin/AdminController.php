<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Admin;
use App\Models\Role;

class AdminController extends Controller
{
    public function index()
    {        
        $admins = Admin::orderBy('created_at', 'desc')->get();
        return view('admin.pages.admin.index')->with(['title'=>'Admins List', 'admins'=>$admins]);
    }
    
    public function create()
    {
        $roles = Role::where('id', '!=', '1')->orderBy('created_at', 'desc')->get();
        return view('admin.pages.admin.create')->with(['title' => 'Add Admin', 'roles'=>$roles]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins',  
            'role_id' => 'required',
            'phone' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required',
        ]);
        
        try 
        {
            if ($request->hasFile('image') && $request->image->isValid()) {
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/admins');
                $request->image->move($destinationPath, $file);
            } else {
                $file = null;
            }            

            $rs = Admin::create([
                'name' =>$request->input('name'),
                'email' => $request->input('email'),
                'role_id' => $request->input('role_id'),                
                'phone' => $request->input('phone'),
                'password' => bcrypt($request->input('password')),
                'status' => $request->input('status'),
                'image' => $file
            ]);
            
            if($rs)
            {    
                $message = array('flag'=>'alert-success', 'message'=>'Admin Created Successfully');
                return redirect()->route('admin.admins.index')->with(['message'=>$message]);    
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to Create Admin, Please try again');
            return redirect()->route('admin.admins.index')->with(['message'=>$message]); 
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
            $roles = Role::where('id', '!=', '1')->orderBy('created_at', 'desc')->get();
                   
            $adminData = Admin::where('id', $id)->first();
            
            if(empty($adminData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No Admin found with provided id');
                return back()->with(['message'=>$message]);
            }
            
            return view('admin.pages.admin.edit')->with(['adminData'=>$adminData, 'title'=>'Edit Admin', 'roles'=>$roles]);
            
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
            'role_id' => 'required',
            'phone' => 'required',
            'status' => 'required',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
                
        try {             
            $admin = Admin::find($id); 
            if($admin->role_id == '1'){
                $role_id = '1';
            }else{
                $role_id = $request->input('role_id');
            }

            if ($request->hasFile('image') && $request->image->isValid()) {
                if ($admin->image && file_exists(public_path('assets/img/admins/'.$admin->image))) {
                    unlink(public_path('assets/img/admins/'.$admin->image));
                }
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/admins');
                $request->image->move($destinationPath, $file);                
            } else {
                $file = $admin->image;
            }     
            
            $data = [
                'name' => $request->input('name'),
                'role_id' => $role_id,
                'phone' => $request->input('phone'),
                'status' => $request->input('status'),
                'image' => $file
            ];

            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->input('password'));
            }

            $rs = Admin::where(['id' => $id])->update($data);

            if ($rs) {              
                $message = array('flag' => 'alert-success', 'message' => 'Admin updated successfully.');
                return redirect()->route('admin.admins.index')->with(['message' => $message]);
            }
            
            $message = array('flag' => 'alert-danger', 'message' => 'Unable to update admin, Please try again');
            return back()->with(['message' => $message]);
        } 
        catch (Exception $e) {
            $message = array('flag' => 'alert-danger', 'message' => $e->getMessage());
            return back()->with(['message' => $message]);
        }
    }
    
    public function delete(Request $request, $id)
    {
        try 
        {
            $rs = Admin::destroy('id', $id);            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'Admin Deleted Successfully');
                return redirect()->route('admin.admins.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to delete admin, Please try again');
            return redirect()->route('admin.admins.index')->with(['message'=>$message]); 
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }   
    } 
}