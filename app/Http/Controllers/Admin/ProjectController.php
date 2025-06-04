<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {        
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('admin.pages.project.index')->with(['title'=>'Projects List', 'projects'=>$projects]);
    }
    
    public function create()
    {
        return view('admin.pages.project.create')->with(['title' => 'Add Project']);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',            
            'image' => 'required',
            'orderby' => 'required',
        ]);
    
        try {
            if ($request->hasFile('image') && $request->image->isValid()) {
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/projects');
                $request->image->move($destinationPath, $file);
            } else {
                $file = null;
            }
    
            $slug = Str::slug($request->input('title'));
            $originalSlug = $slug;
            $counter = 1;
    
            while (Project::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
                
            $rs = Project::create([
                'title' => $request->input('title'),
                'slug' => $slug,
                'link' => $request->input('link'),
                'status' => $request->input('status'),
                'orderby' => $request->input('orderby'),
                'company' => $request->input('company'),
                'image' => $file,
            ]);
            
            if ($rs) {
                $message = array('flag' => 'alert-success', 'message' => 'Project Created Successfully');
                return redirect()->route('admin.project.index')->with(['message' => $message]);    
            }
    
            $message = array('flag' => 'alert-danger', 'message' => 'Unable to Create Project, Please try again');
            return redirect()->route('admin.project.index')->with(['message' => $message]); 
        } catch (Exception $e) {
            $message = array('flag' => 'alert-danger', 'message' => $e->getMessage());
            return back()->with(['message' => $message]);
        }
    }   

    public function edit(Request $request, $slug)
    {
        try
        {           
            $projectData = Project::where('slug', $slug)->first();           
            if(empty($projectData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No Project found with provided id');
                return back()->with(['message'=>$message]);
            }
            
            return view('admin.pages.project.edit')->with(['projectData'=>$projectData, 'title'=>'Edit Project']);            
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
            'status' => 'required', 
            'orderby' => 'required'
        ]);
              
        try 
        { 
            $project = Project::where('slug', $slug)->first();
            if ($request->hasFile('image') && $request->image->isValid()) {
                if ($project->image && file_exists(public_path('assets/img/projects/'.$project->image))) {
                    unlink(public_path('assets/img/projects/'.$project->image));
                }
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/projects');
                $request->image->move($destinationPath, $file);                
            } else {
                $file = $project->image;
            } 
            
            $data = [
                'title' => $request->input('title'),
                'link' => $request->input('link'),
                'status' => $request->input('status'),
                'orderby' => $request->input('orderby'),
                'company' => $request->input('company'),
                'image' => $file,
            ];
         
            $rs = Project::where(['slug'=> $slug])->update($data);
           
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Project updated successfully.');
                return redirect()->route('admin.project.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update project, Please try again');
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
            $rs = Project::destroy($id);
            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'Project Deleted Successfully');
                return redirect()->route('admin.project.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to delete project, Please try again');
            return redirect()->route('admin.project.index')->with(['message'=>$message]); 
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }   
    }
}