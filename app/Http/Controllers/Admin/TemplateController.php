<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\EmailTemplate;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    public function index($id)
    {    
        $tempData = EmailTemplate::where(['temp_id' => $id, 'type' => 'email'])->get();
        $list_menu = 'menu-' . $id;
        return view('admin.pages.template.index')->with(['title'=>'Email Templates List', 'tempData'=>$tempData, 'list_menu'=>$list_menu, 'tempId'=>$id]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
          'subject' => 'required', 
          'body' => 'required'
        ]);
              
        try 
        {
            $data = [
                'subject' => $request->input('subject'),
                'body' => $request->input('body')
            ];
            
            $rs = EmailTemplate::where(['temp_id'=> $id])->update($data);           

            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Email Template updated successfully.');
                return redirect()->route('admin.templates.index', $id)->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update email template, Please try again');
            return back()->with(['message'=>$message]);
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }  
}