<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {     
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.pages.user.index')->with(['title'=>'Users List', 'users'=>$users]);
    }
    
    public function create()
    {
        return view('admin.pages.user.create')->with(['title' => 'Add User']);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required',
        ]);
        
        try 
        {
            $last_user = User::orderBy('id', 'desc')->first();
            if(empty($last_user)){
                $user_id = 'BB2K251';
            }else{
                $user_id = 'BB2K25'.$last_user->id + 1;
            }

            if ($request->hasFile('image') && $request->image->isValid()) {
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/users');
                $request->image->move($destinationPath, $file);
            } else {
                $file = null;
            }            

            $rs = User::create([
                'name' =>$request->input('name'),
                'email' => $request->input('email'),
                'user_id' =>$user_id,                
                'phone' => $request->input('phone'),
                'password' => bcrypt($request->input('password')),
                'status' => $request->input('status'),
                'image' => $file
            ]);
            
            if($rs)
            {    
                $message = array('flag'=>'alert-success', 'message'=>'User Created Successfully');
                return redirect()->route('admin.users.index')->with(['message'=>$message]);    
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to Create User, Please try again');
            return redirect()->route('admin.users.index')->with(['message'=>$message]); 
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
            $userData = User::where('id', $id)->first();            
            if(empty($userData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No User found with provided id');
                return back()->with(['message'=>$message]);
            }
            
            return view('admin.pages.user.edit')->with(['userData'=>$userData, 'title'=>'Edit User']);            
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
            'phone' => 'required',
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required',
        ]);
              
        try 
        {  
            $user = User::find($id); 
            if ($request->hasFile('image') && $request->image->isValid()) {
                if ($user->image && file_exists(public_path('assets/img/users/'.$user->image))) {
                    unlink(public_path('assets/img/users/'.$user->image));
                }
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/users');
                $request->image->move($destinationPath, $file);                
            } else {
                $file = $user->image;
            }             
            
            $data = [
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'status' => $request->input('status'),
                'image' => $file
            ];

            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->input('password'));
            }
         
            $rs = User::where(['id'=> $id])->update($data);
            
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'User updated successfully.');
                return redirect()->route('admin.users.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update user, Please try again');
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
            $rs = User::destroy('id', $id);
            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'User deleted Successfully');
                return redirect()->route('admin.users.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to delete User, Please try again');
            return redirect()->route('admin.users.index')->with(['message'=>$message]); 
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }   
    }
}
