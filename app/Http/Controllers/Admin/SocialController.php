<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Social;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    public function index()
    {        
        $socials = Social::orderBy('created_at', 'desc')->get();
        return view('admin.pages.social.index')->with(['title'=>'Social Media List', 'socials'=>$socials]);
    }
    
    public function create()
    {
        return view('admin.pages.social.create')->with(['title' => 'Add Social Media']);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',          
            'link' => 'required',
            'icon' => 'required',
            'status' => 'required'
        ]);
        
        try 
        {
            if ($request->hasFile('image') && $request->image->isValid()) {
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/socials');
                $request->image->move($destinationPath, $file);
            } else {
                $file = null;
            }

            $slug = Str::slug($request->input('name'));
            $originalSlug = $slug;
            $counter = 1;
    
            while (Social::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $rs = Social::create([
                'name' => $request->input('name'),
                'slug' => $slug,
                'link' => $request->input('link'),
                'icon' => $request->input('icon'),
                'image' => $file,
                'status' => $request->input('status'),
                'orderby' => $request->input('orderby')
            ]);
            
            if($rs)
            {    
                $message = array('flag'=>'alert-success', 'message'=>'Social Media Created Successfully');
                return redirect()->route('admin.social.index')->with(['message'=>$message]);    
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to Create Social Media, Please try again');
            return redirect()->route('admin.social.index')->with(['message'=>$message]); 
        }
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }

    public function edit(Request $request, $slug)
    {
        try
        {           
            $socialData = Social::where('slug', $slug)->first();
            
            if(empty($socialData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No Social Media found with provided id');
                return back()->with(['message'=>$message]);
            }
            
            return view('admin.pages.social.edit')->with(['socialData'=>$socialData, 'title'=>'Edit Social Media']);
            
        }
        catch (Exception $e)
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',          
            'link' => 'required',
            'icon' => 'required',
            'status' => 'required'
        ]);
              
        try 
        { 
            $social = Social::where('slug', $slug)->first();
            if ($request->hasFile('image') && $request->image->isValid()) {
                if ($social->image && file_exists(public_path('assets/img/socials/'.$social->image))) {
                    unlink(public_path('assets/img/socials/'.$social->image));
                }
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/socials');
                $request->image->move($destinationPath, $file);                
            } else {
                $file = $social->image;
            } 

            $data = [
                'name' => $request->input('name'),
                'link' => $request->input('link'),
                'icon' => $request->input('icon'),
                'image' => $file,
                'status' => $request->input('status'),
                'orderby' => $request->input('orderby')
            ];
         
            $rs = Social::where(['slug'=> $slug])->update($data);
            
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Social Media updated successfully.');
                return redirect()->route('admin.social.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update Social Media, Please try again');
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
            $rs = Social::destroy($id);
            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'Social Media Deleted Successfully');
                return redirect()->route('admin.social.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to delete Social Media, Please try again');
            return redirect()->route('admin.social.index')->with(['message'=>$message]); 
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }   
    }
}