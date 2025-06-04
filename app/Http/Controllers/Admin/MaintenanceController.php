<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\MaintenanceSetting;
use Illuminate\Support\Str;

class MaintenanceController extends Controller
{
    public function index()
    {        
        $settings = MaintenanceSetting::orderBy('created_at', 'desc')->get();
        return view('admin.pages.maintenance.index')->with(['title'=>'Maintenance Settings List', 'settings'=>$settings]);
    }
    
    public function create()
    {
        return view('admin.pages.maintenance.create')->with(['title' => 'Add Maintenance Settings']);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',           
            'date' => 'required',
            'from_time' => 'required',
            'to_time' => 'required',
            'message' => 'required',
            'status' => 'required'
        ]);
        
        try 
        {
            $slug = Str::slug($request->input('subject'));
            $originalSlug = $slug;
            $counter = 1;
    
            while (MaintenanceSetting::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $rs = MaintenanceSetting::create([
                'subject' => $request->input('subject'),
                'slug' => $slug,
                'date' => $request->input('date'),
                'from_time' => $request->input('from_time'),
                'to_time' => $request->input('to_time'),
                'message' => $request->input('message'),
                'status' => $request->input('status'),
            ]);
            
            if($rs)
            {    
                $message = array('flag'=>'alert-success', 'message'=>'Maintenance Settings Created Successfully');
                return redirect()->route('admin.maintenance.index')->with(['message'=>$message]);    
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to Create Maintenance Settings, Please try again');
            return redirect()->route('admin.maintenance.index')->with(['message'=>$message]); 
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
            $mainData = MaintenanceSetting::where('slug', $slug)->first();
            
            if(empty($mainData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No Maintenance Settings found with provided id');
                return back()->with(['message'=>$message]);
            }
            
            return view('admin.pages.maintenance.edit')->with(['mainData'=>$mainData, 'title'=>'Edit Maintenance Settings']);            
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
            'subject' => 'required',           
            'date' => 'required',
            'from_time' => 'required',
            'to_time' => 'required',
            'message' => 'required',
            'status' => 'required'
        ]);
              
        try 
        { 
            $data = [
                'subject' => $request->input('subject'),
                'slug' => $slug,
                'date' => $request->input('date'),
                'from_time' => $request->input('from_time'),
                'to_time' => $request->input('to_time'),
                'message' => $request->input('message'),
                'status' => $request->input('status'),
            ];
         
            $rs = MaintenanceSetting::where(['slug'=> $slug])->update($data);
            
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Maintenance Settings updated successfully.');
                return redirect()->route('admin.maintenance.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update Maintenance Settings, Please try again');
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
            $rs = MaintenanceSetting::destroy($id);
            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'Maintenance Settings Deleted Successfully');
                return redirect()->route('admin.maintenance.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to delete Maintenance Settings, Please try again');
            return redirect()->route('admin.maintenance.index')->with(['message'=>$message]); 
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }   
    }
}