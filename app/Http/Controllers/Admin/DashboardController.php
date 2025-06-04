<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;

class DashboardController extends Controller 
{
	public function index() {
        $admins = Admin::where('status', '1')->count();
        $users = User::where('status', '1')->count();    
        return view('admin.pages.dashboard.index')->with(['admins' => $admins, 'users' => $users]);
    }

	public function changePassword()
    {
        return view('admin.pages.dashboard.password');
    }

    public function updatePassword(Request $request)
    { 
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $old_password = $request->old_password;
        $password = $request->password;

        $admin = Admin::find(auth()->user()->id);

        if (!Hash::check($old_password, $admin->password)) {
            $message = array('flag'=>'alert-danger', 'message'=>'Please Enter Correct Current Password');
            return redirect()->route('admin.change.passsword')->with(['message'=>$message]);
        } else {
            Admin::where('id', auth()->user()->id)->update(['password' => bcrypt($password)]);

            $message = array('flag'=>'alert-success', 'message'=>'Password Changed Successfully');
            return redirect()->route('admin.change.passsword')->with(['message'=>$message]); 
        }   
    }

    public function profile()
    {
        $adminData = Admin::where('id', auth()->user()->id)->first();
        return view('admin.pages.dashboard.profile')->with(['adminData'=>$adminData, 'title'=>'Edit Profile']);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);
                
        try {     
            $id = auth()->user()->id;        
            $admin = Admin::find($id); 
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
                'phone' => $request->input('phone'),
                'image' => $file
            ];
            $rs = Admin::where(['id' => $id])->update($data);

            if ($rs) {              
                $message = array('flag' => 'alert-success', 'message' => 'Profile updated successfully.');
                return redirect()->route('admin.profile')->with(['message' => $message]);
            }
            
            $message = array('flag' => 'alert-danger', 'message' => 'Unable to update profile, Please try again');
            return back()->with(['message' => $message]);
        } 
        catch (Exception $e) {
            $message = array('flag' => 'alert-danger', 'message' => $e->getMessage());
            return back()->with(['message' => $message]);
        }
    }
}