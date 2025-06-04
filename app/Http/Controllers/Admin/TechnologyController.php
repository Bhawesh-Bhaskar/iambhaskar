<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    public function index()
    {        
        $technologies = Technology::orderBy('created_at', 'desc')->get();
        return view('admin.pages.technology.index')->with(['title'=>'Technologies List', 'technologies'=>$technologies]);
    }
    
    public function create()
    {
        return view('admin.pages.technology.create')->with(['title' => 'Add Technology']);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',            
            'icon' => 'required',
            'description' => 'required'
        ]);
        
        try 
        {
            $slug = Str::slug($request->input('title'));
            $originalSlug = $slug;
            $counter = 1;
    
            while (Technology::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $rs = Technology::create([
                'title' => $request->input('title'),
                'slug' => $slug,
                'icon' => $request->input('icon'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
                'orderby' => $request->input('orderby'),
            ]);
            
            if($rs)
            {    
                $message = array('flag'=>'alert-success', 'message'=>'Technology Created Successfully');
                return redirect()->route('admin.technology.index')->with(['message'=>$message]);    
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to Create Technology, Please try again');
            return redirect()->route('admin.technology.index')->with(['message'=>$message]); 
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
            $techData = Technology::where('slug', $slug)->first();
            
            if(empty($techData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No Technology found with provided id');
                return back()->with(['message'=>$message]);
            }
            
            return view('admin.pages.technology.edit')->with(['techData'=>$techData, 'title'=>'Edit Technology']);           
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
            'title' => 'required',
            'icon' => 'required',
            'description' => 'required'
        ]);
              
        try 
        { 
            $data = [
                'title' => $request->input('title'),
                'icon' => $request->input('icon'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
                'orderby' => $request->input('orderby'),
            ];         
            $rs = Technology::where(['slug'=> $slug])->update($data);
           
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Technology updated successfully.');
                return redirect()->route('admin.technology.index')->with(['message'=>$message]);
            }
           
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update Technology, Please try again');
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
            $rs = Technology::destroy($id);
            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'Technology Deleted Successfully');
                return redirect()->route('admin.technology.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to delete Technology, Please try again');
            return redirect()->route('admin.technology.index')->with(['message'=>$message]); 
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }   
    }
}