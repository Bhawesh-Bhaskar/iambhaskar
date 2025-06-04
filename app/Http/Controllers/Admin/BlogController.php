<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Admin;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {        
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        $admins = Admin::orderBy('created_at', 'desc')->get();
        return view('admin.pages.blog.index')->with(['title'=>'Blogs List', 'blogs'=>$blogs, 'admins'=>$admins]);
    }
    
    public function create()
    {
        $categories = BlogCategory::where('status', 1)->orderBy('created_at', 'desc')->get();
        $tags = BlogTag::where('status', 1)->orderBy('created_at', 'desc')->get();
        return view('admin.pages.blog.create')->with(['title' => 'Add Blog', 'categories'=>$categories, 'tags'=>$tags]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'short_description' => 'required'
        ]);
        
        try 
        {
            if ($request->hasFile('image') && $request->image->isValid()) {
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/blogs');
                $request->image->move($destinationPath, $file);
            } else {
                $file = null;
            }   

            $slug = Str::slug($request->input('title'));
            $originalSlug = $slug;
            $counter = 1;
    
            while (Blog::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            if($request->featured == 'on'){
                $featured = '1';
            }else{
                $featured = '0';
            }

            $rs = Blog::create([
                'title' => $request->input('title'),
                'slug' => $slug,
                'short_description' => $request->input('short_description'),
                'description' => $request->input('description'),
                'category' => $request->input('category'),
                'tag' => $request->input('tag'),
                'credit' => $request->input('credit'),
                'credit_url' => $request->input('credit_url'),
                'added_by' => Auth::user()->id,
                'image' => $file,
                'featured' => $featured,
                'orderby' => $request->input('orderby'),
                'status' => $request->input('status')
            ]);
            
            if($rs)
            {    
                $message = array('flag'=>'alert-success', 'message'=>'Blog Created Successfully');
                return redirect()->route('admin.blog.index')->with(['message'=>$message]);    
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to Create Blog, Please try again');
            return redirect()->route('admin.blog.index')->with(['message'=>$message]); 
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
            $blogData = Blog::where('slug', $slug)->first();
            $blog_categories = BlogCategory::where('status', 1)->orderBy('created_at', 'desc')->get();
            $blog_tags = BlogTag::where('status', 1)->orderBy('created_at', 'desc')->get();
           
            if(empty($blogData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No Blog found with provided id');
                return back()->with(['message'=>$message]);
            }
            
            return view('admin.pages.blog.edit')->with(['blogData'=>$blogData, 'title'=>'Edit Blog', 'blog_categories'=>$blog_categories, 'blog_tags'=>$blog_tags]);
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
          'short_description' => 'required',  
        ]);
              
        try 
        {   
            $blog = Blog::where('slug', $slug)->first();
            if ($request->hasFile('image') && $request->image->isValid()) {
                if ($blog->image && file_exists(public_path('assets/img/blogs/'.$blog->image))) {
                    unlink(public_path('assets/img/blogs/'.$blog->image));
                }
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/blogs');
                $request->image->move($destinationPath, $file);                
            } else {
                $file = $blog->image;
            } 

            if($request->featured == 'on'){
                $featured = '1';
            }else{
                $featured = '0';
            }

            $data = [
                'title' => $request->input('title'),
                'short_description' => $request->input('short_description'),
                'description' => $request->input('description'),
                'image' => $file,
                'added_by' => Auth::user()->id,
                'category' => $request->input('category'),
                'tag' => $request->input('tag'),
                'credit' => $request->input('credit'),
                'credit_url' => $request->input('credit_url'),
                'featured' => $featured,
                'orderby' => $request->input('orderby'),
                'status' => $request->input('status')
            ];
         
            $rs = Blog::where(['slug'=> $slug])->update($data);
            
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Blog updated successfully.');
                return redirect()->route('admin.blog.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update Blog, Please try again');
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
            $rs = Blog::destroy($id);
            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'Blog Deleted Successfully');
                return redirect()->route('admin.blog.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to delete Blog, Please try again');
            return redirect()->route('admin.blog.index')->with(['message'=>$message]); 
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }   
    }

    // Blog Categories

    public function category()
    {        
        $category = BlogCategory::orderBy('created_at', 'desc')->get();
        return view('admin.pages.blog.category.index')->with(['title'=>'Blog Category List', 'category'=>$category]);
    }
    
    public function createcategory()
    {
        return view('admin.pages.blog.category.create')->with(['title' => 'Add Blog Category']);
    }
    
    public function storecategory(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);
        
        try 
        {
            $slug = Str::slug($request->input('title'));
            $originalSlug = $slug;
            $counter = 1;
    
            while (BlogCategory::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $rs = BlogCategory::create([
                'title' => $request->input('title'),
                'slug' => $slug,
                'status' => $request->input('status')
            ]);
            
            if($rs)
            {    
                $message = array('flag'=>'alert-success', 'message'=>'Blog Category Created Successfully');
                return redirect()->route('admin.blogcategory.index')->with(['message'=>$message]);    
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to Create Blog Category, Please try again');
            return redirect()->route('admin.blogcategory.index')->with(['message'=>$message]); 
        }
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }

    public function editcategory(Request $request, $slug)
    {
       try
       {           
           $blogcatData = BlogCategory::where('slug', $slug)->first();
           
            if(empty($blogcatData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No Blog Category found with provided id');
                return back()->with(['message'=>$message]);
            }
            
            return view('admin.pages.blog.category.edit')->with(['blogcatData'=>$blogcatData, 'title'=>'Edit Blog']);           
        }
        catch (Exception $e)
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }

    public function updatecategory(Request $request, $slug)
    {      
        $request->validate([
          'title' => 'required', 
          'status' => 'required',
        ]);
              
        try 
        {   
            $data = [
                'title' => $request->input('title'),
                'status' => $request->input('status')
            ];
            
            $rs = BlogCategory::where(['slug'=> $slug])->update($data);
            
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Blog Category updated successfully.');
                return redirect()->route('admin.blogcategory.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update Blog Category, Please try again');
            return back()->with(['message'=>$message]);
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }    
    
    public function deletecategory(Request $request, $id)
    {
        try 
        {
            $rs = BlogCategory::destroy($id);
            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'Blog Category Deleted Successfully');
                return redirect()->route('admin.blogcategory.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to delete Blog Category, Please try again');
            return redirect()->route('admin.blogcategory.index')->with(['message'=>$message]); 
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }   
    }

    // Blog Tags

    public function tag()
    {        
        $tag = BlogTag::orderBy('created_at', 'desc')->get();
        return view('admin.pages.blog.tag.index')->with(['title'=>'Blog Tag List', 'tag'=>$tag]);
    }
    
    public function createtag()
    {
        return view('admin.pages.blog.tag.create')->with(['title' => 'Add Blog Tag']);
    }
    
    public function storetag(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);
        
        try 
        {
            $slug = Str::slug($request->input('title'));
            $originalSlug = $slug;
            $counter = 1;
    
            while (BlogTag::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $rs = BlogTag::create([
                'title' => $request->input('title'),
                'slug' => $slug,
                'status' => $request->input('status')
            ]);
            
            if($rs)
            {    
                $message = array('flag'=>'alert-success', 'message'=>'Blog Tag Created Successfully');
                return redirect()->route('admin.blogtag.index')->with(['message'=>$message]);    
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to Create Blog Tag, Please try again');
            return redirect()->route('admin.blogtag.index')->with(['message'=>$message]); 
        }
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }

    public function edittag(Request $request, $slug)
    {
        try
        {           
            $blogtagData = BlogTag::where('slug', $slug)->first();
            
            if(empty($blogtagData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No Blog Tag found with provided id');
                return back()->with(['message'=>$message]);
            }
            
            return view('admin.pages.blog.tag.edit')->with(['blogtagData'=>$blogtagData, 'title'=>'Edit Blog']);
        }
        catch (Exception $e)
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }

    public function updatetag(Request $request, $slug)
    {      
        $request->validate([
          'title' => 'required',
          'status' => 'required',  
        ]);
              
        try 
        {   
            $data = [
                'title' => $request->input('title'),
                'status' => $request->input('status')
            ];
            
            $rs = BlogTag::where(['slug'=> $slug])->update($data);
            
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Blog Tag updated successfully.');
                return redirect()->route('admin.blogtag.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update Blog Tag, Please try again');
            return back()->with(['message'=>$message]);
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }    
    
    public function deletetag(Request $request, $id)
    {
        try 
        {
            $rs = BlogTag::destroy($id);
            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'Blog Tag Deleted Successfully');
                return redirect()->route('admin.blogtag.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to delete Blog Tag, Please try again');
            return redirect()->route('admin.blogtag.index')->with(['message'=>$message]); 
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }   
    }
}