<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\HomePage;
use Illuminate\Support\Str;

class CmsController extends Controller
{
    public function edit(Request $request)
    {
        try
        {           
            $home = HomePage::where('id', '1')->first();        
            return view('admin.pages.cms.home')->with(['home'=>$home,'title'=>'Edit Home Page']);           
        }
        catch (Exception $e)
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }
    
    public function update(Request $request)
    {
        try 
        { 
            $home = HomePage::where('id', '1')->first();
            
            if ($request->hasFile('image1') && $request->image1->isValid()) {
                if ($home->image1 && file_exists(public_path('assets/img/portfolio/'.$home->image1))) {
                    unlink(public_path('assets/img/portfolio/'.$home->image1));
                }
                $ext = $request->image1->getClientOriginalExtension();
                $file1 = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/portfolio');
                $request->image1->move($destinationPath, $file1);                
            } else {
                $file1 = $home->image1;
            }
            
            if ($request->hasFile('image2') && $request->image2->isValid()) {
                if ($home->image2 && file_exists(public_path('assets/img/portfolio/'.$home->image2))) {
                    unlink(public_path('assets/img/portfolio/'.$home->image2));
                }
                $ext = $request->image2->getClientOriginalExtension();
                $file2 = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/portfolio');
                $request->image2->move($destinationPath, $file2);                
            } else {
                $file2 = $home->image2;
            }

            if ($request->hasFile('image3') && $request->image3->isValid()) {
                if ($home->image3 && file_exists(public_path('assets/img/portfolio/'.$home->image3))) {
                    unlink(public_path('assets/img/portfolio/'.$home->image3));
                }
                $ext = $request->image3->getClientOriginalExtension();
                $file3 = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/portfolio');
                $request->image3->move($destinationPath, $file3);                
            } else {
                $file3 = $home->image3;
            }

            if ($request->hasFile('attachment1') && $request->attachment1->isValid()) {
                if ($home->attachment1 && file_exists(public_path('assets/img/portfolio/'.$home->attachment1))) {
                    unlink(public_path('assets/img/portfolio/'.$home->attachment1));
                }
                $ext = $request->attachment1->getClientOriginalExtension();
                $file4 = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/portfolio');
                $request->attachment1->move($destinationPath, $file4);                
            } else {
                $file4 = $home->attachment1;
            }
        
            $data = [
                'content1' => $request->input('content1'),
                'content2' => $request->input('content2'),
                'content3' => $request->input('content3'),
                'content4' => $request->input('content4'),
                'content5' => $request->input('content5'),
                'content6' => $request->input('content6'),
                'content7' => $request->input('content7'),
                'content8' => $request->input('content8'),
                'image1' => $file1,
                'image2' => $file2,
                'image3' => $file3,
                'attachment1' => $file4,
            ];
            
            $rs = HomePage::where(['id'=> '1'])->update($data);
           
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Home Page updated successfully.');
                return redirect()->route('admin.home.edit')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update Home Page, Please try again');
            return back()->with(['message'=>$message]);
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    } 
}