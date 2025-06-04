<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Country;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    public function index()
    {        
        $countries = Country::orderBy('created_at', 'desc')->get();
        return view('admin.pages.country.index')->with(['title'=>'Countries List', 'countries'=>$countries]);
    }
    
    public function create()
    {
        return view('admin.pages.country.create')->with(['title' => 'Add Country']);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'short_name' => 'required',
            'name' => 'required',            
            'iso3' => 'required',
            'number_code' => 'required',
            'phone_code' => 'required',
            'currency_code' => 'required',
            'status' => 'required',
        ]);
    
        try {                
            $rs = Country::create([
                'short_name' => $request->input('short_name'),
                'name' => $request->input('name'),
                'iso3' => $request->input('iso3'),
                'number_code' => $request->input('number_code'),
                'phone_code' => $request->input('phone_code'),
                'currency_code' => $request->input('currency_code'),
                'status' => $request->input('status'),
            ]);
            
            if ($rs) {
                $message = array('flag' => 'alert-success', 'message' => 'Country Created Successfully');
                return redirect()->route('admin.country.index')->with(['message' => $message]);    
            }
    
            $message = array('flag' => 'alert-danger', 'message' => 'Unable to Create Country, Please try again');
            return redirect()->route('admin.country.index')->with(['message' => $message]); 
        } catch (Exception $e) {
            $message = array('flag' => 'alert-danger', 'message' => $e->getMessage());
            return back()->with(['message' => $message]);
        }
    }   

    public function edit(Request $request, $id)
    {
        try
        {           
            $countryData = Country::where('id', $id)->first();           
            if(empty($countryData))
            {
                $message = array('flag'=>'alert-danger', 'message'=>'No Country found with provided id');
                return back()->with(['message'=>$message]);
            }
            
            return view('admin.pages.country.edit')->with(['countryData'=>$countryData, 'title'=>'Edit Country']);            
        }
        catch (Exception $e)
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'short_name' => 'required',
            'name' => 'required',            
            'iso3' => 'required',
            'number_code' => 'required',
            'phone_code' => 'required',
            'currency_code' => 'required',
            'status' => 'required',
        ]);
              
        try 
        {           
            $data = [
                'short_name' => $request->input('short_name'),
                'name' => $request->input('name'),
                'iso3' => $request->input('iso3'),
                'number_code' => $request->input('number_code'),
                'phone_code' => $request->input('phone_code'),
                'currency_code' => $request->input('currency_code'),
                'status' => $request->input('status'),
            ];
         
            $rs = Country::where(['id'=> $id])->update($data);
           
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Country updated successfully.');
                return redirect()->route('admin.country.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update country, Please try again');
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
            $rs = Country::destroy($id);
            
            if($rs)
            {
                $message = array('flag'=>'alert-success', 'message'=>'Country Deleted Successfully');
                return redirect()->route('admin.country.index')->with(['message'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to delete country, Please try again');
            return redirect()->route('admin.country.index')->with(['message'=>$message]); 
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }   
    }
}