<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Page;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {        
        $content = Page::orderBy('created_at', 'desc')->get();
        return view('admin.pages.content.index')->with(['title'=>'Contents List', 'content'=>$content]);
    }
    
    public function create()
    {
        return view('admin.pages.content.create')->with(['title' => 'Add Contents']);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
        
        try 
        {
            $slug = Str::slug($request->input('name'));
            $originalSlug = $slug;
            $counter = 1;
    
            while (Page::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $rs = Page::create([
                'name' => $request->input('name'),
                'slug' => $slug,
                'content' => $request->input('content'),
                'status' => $request->input('status')
            ]);
            
            if($rs)
            {    
                $message = array('flag'=>'alert-success', 'message'=>'Page Created Successfully');
                return redirect()->route('admin.content.index')->with(['message'=>$message]);    
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to Create Page, Please try again');
            return redirect()->route('admin.content.index')->with(['message'=>$message]); 
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
            $pageData = Page::where('slug', $slug)->first();
            
            if(empty($pageData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No Page found with provided id');
                return back()->with(['message'=>$message]);
            }
            
            return view('admin.pages.content.edit')->with(['pageData'=>$pageData, 'title'=>'Edit Contents']);
            
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
            'status' => 'required',
        ]);
              
        try 
        {   
            $data = [
                'name' => $request->input('name'),
                'content' => $request->input('content'),
                'status' => $request->input('status')
            ];
         
            $rs = Page::where(['slug'=> $slug])->update($data);
            
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Page updated successfully.');
                return redirect()->route('admin.content.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update content, Please try again');
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
            $rs = Page::destroy($id);
            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'Page Deleted Successfully');
                return redirect()->route('admin.content.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to delete Page, Please try again');
            return redirect()->route('admin.content.index')->with(['message'=>$message]); 
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }   
    }
}