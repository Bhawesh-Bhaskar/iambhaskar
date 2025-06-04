<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Auth;

class LoginController extends Controller
{        
    public function index()
    {
        return view('admin.pages.auth.login');
    }

    public function secure_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
        ]);

        $credentials = $request->only('email', 'password');  

        if (Auth::guard('admin')->attempt($credentials)) {            
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
    }

    public function register()
    {
        return view('admin.pages.auth.register');
    }


    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users'
        ]);
        
        try 
        {
            $last_user = User::orderBy('created_at', 'desc')->first();
            $new_user = ($request->user_id = $last_user->id + 1);
            $user_id = ('CLNT000'.$new_user);

            $rs = User::create([
                'name' =>$request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')), 
                'user_type' => '2',
                'is_deleted' => '0',
                'contact' => $request->input('contact'),
                'user_id' => $user_id,
            ]);
            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'User Created Successfully');
                return redirect()->route('register')->with(['message'=>$message]);    
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to Create User, Please try again');
            return redirect()->route('register')->with(['message'=>$message]); 
        }
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }  
    
    public function forgot_password()
    {
        return view('admin.pages.auth.forgot_password');
    }
    
    public function reset_password($token)
    {
        return view('admin.pages.auth.reset_password');
    }
    
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
