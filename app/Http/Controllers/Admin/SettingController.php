<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Personal;
use App\Models\Contact;
use App\Models\SeoDetail;
use App\Models\EmailConfig;
use App\Models\Setting;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::where('id', '1')->first();
        return view('admin.pages.setting.index')->with(['title'=>'Settings', 'settings'=>$settings]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'google_recaptcha_key' => 'required',
            'google_recaptcha_secret' => 'required',
            'google_analytics_code' => 'required',
            'google_firebase_key' => 'required',
            'version' => 'required',
        ]);
              
        try 
        { 
            $setting = Setting::where('id', '1')->first();
            
            if ($request->hasFile('logo') && $request->logo->isValid()) {
                if ($setting->logo && file_exists(public_path('assets/img/setting/'.$setting->logo))) {
                    unlink(public_path('assets/img/setting/'.$setting->logo));
                }
                $ext = $request->logo->getClientOriginalExtension();
                $file1 = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/setting');
                $request->logo->move($destinationPath, $file1);                
            } else {
                $file1 = $setting->logo;
            }
            
            if ($request->hasFile('favicon') && $request->favicon->isValid()) {
                if ($setting->favicon && file_exists(public_path('assets/img/setting/'.$setting->favicon))) {
                    unlink(public_path('assets/img/setting/'.$setting->favicon));
                }
                $ext = $request->favicon->getClientOriginalExtension();
                $file2 = date('YmdHis') . rand(1, 99999) . '.' . $ext;
                $destinationPath = public_path('assets/img/setting');
                $request->favicon->move($destinationPath, $file2);                
            } else {
                $file2 = $setting->favicon;
            }

            $data = [
                'name' => $request->input('name'),
                'logo' => $file1,
                'favicon' => $file2,
                'google_recaptcha_key' => $request->input('google_recaptcha_key'),
                'google_recaptcha_secret' => $request->input('google_recaptcha_secret'),
                'google_analytics_code' => $request->input('google_analytics_code'),
                'google_firebase_key' => $request->input('google_firebase_key'),
                'version' => $request->input('version'),
            ];
         
            $rs = Setting::where(['id'=> '1'])->update($data);
           
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Setting updated successfully.');
                return redirect()->route('admin.settings.index')->with(['message'=>$message]);
            }
           
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update settings, Please try again');
            return back()->with(['message'=>$message]);
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    } 

    public function contact(Request $request)
    {
        $contacts = Contact::orderby('id', 'desc')->get();
        return view('admin.pages.setting.contact')->with(['title'=>'Contacts', 'contacts'=>$contacts]);
    }    

    public function personal(Request $request)
    {
        $personals = Personal::where('id', '1')->first();
        return view('admin.pages.setting.personal')->with(['title'=>'Personal Records', 'personals'=>$personals]);
    }

    public function update_personal(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email1' => 'required',
            'phone1' => 'required',
            'dob' => 'required',
            'website' => 'required',
            'age' => 'required',
            'qualification' => 'required',
            'location' => 'required',
            'map' => 'required',
        ]);
              
        try 
        { 
            $data = [
                'name' => $request->input('name'),
                'email1' => $request->input('email1'),
                'email2' => $request->input('email2'),
                'phone1' => $request->input('phone1'),
                'phone2' => $request->input('phone2'),
                'whatsapp' => $request->input('whatsapp'),
                'dob' => $request->input('dob'),
                'website' => $request->input('website'),
                'age' => $request->input('age'),
                'qualification' => $request->input('qualification'),
                'location' => $request->input('location'),
                'map' => $request->input('map'),
                'experience' => $request->input('experience'),
                'freelance' => $request->input('freelance'),
            ];
         
            $rs = Personal::where(['id'=> '1'])->update($data);
           
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'Personal details updated successfully.');
                return redirect()->route('admin.personal.index')->with(['message'=>$message]);
            }
           
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update personal details, Please try again');
            return back()->with(['message'=>$message]);
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    } 
    
    public function email(Request $request)
    {
        $configs = EmailConfig::where('id', '1')->first();
        return view('admin.pages.setting.email')->with(['title'=>'Email Configs List', 'configs'=>$configs]);
    }
    
    public function update_email(Request $request)
    {
        $request->validate([
            'email_protocol' => 'required',
            'email_encryption' => 'required',
            'smtp_host' => 'required',
            'smtp_port' => 'required',
            'smtp_email' => 'required',
            'smtp_username' => 'required',
            'smtp_password' => 'required',
            'from_address' => 'required',
            'from_name' => 'required',
            'notification_email' => 'required',
        ]);
              
        try 
        { 
            $data = [
                'email_protocol' => $request->input('email_protocol'),
                'email_encryption' => $request->input('email_encryption'),
                'smtp_host' => $request->input('smtp_host'),
                'smtp_port' => $request->input('smtp_port'),
                'smtp_email' => $request->input('smtp_email'),
                'smtp_username' => $request->input('smtp_username'),
                'smtp_password' => $request->input('smtp_password'),
                'from_address' => $request->input('from_address'),
                'from_name' => $request->input('from_name'),
                'notification_email' => $request->input('notification_email'),
            ];
         
            $rs = EmailConfig::where(['id'=> '1'])->update($data);

            Config::set([
                'mail.driver'     => $request->input('email_protocol'),
                'mail.host'       => $request->input('smtp_host'),
                'mail.port'       => $request->input('smtp_port'),
                'mail.from'       => [
                    'address'     => $request->input('from_address'),
                    'name'        => $request->input('from_name')
                ],
                'mail.encryption' => $request->input('email_encryption'),
                'mail.username'   => $request->input('smtp_username'),
                'mail.password'   => $request->input('smtp_password'),
            ]);

            $fromInfo = \Config::get('mail.from');

            $user = [];
            $user['to']       = 'bhawesh9696@gmail.com';
            $user['from']     = $fromInfo['address'];
            $user['fromName'] = $fromInfo['name'];

            $ok = Mail::send('emails.verify', ['user' => $user], function ($m) use ($user)
            {
                $m->from($user['from'], $user['fromName']);
                $m->to($user['to']);
                $m->subject('verify smtp settings');
            });
            $emailConfig = EmailConfig::find("1");
            $emailConfig->status = 1;
            $emailConfig->save();
            $message = array('flag'=>'alert-success', 'message'=>'SMTP settings are verified successfully.');
            return redirect()->route('admin.email.index')->with(['message'=>$message]);
        } 
        catch (Exception $e) 
        {
            $emailConfig = EmailConfig::find("1");
            $emailConfig->status = 0;
            $emailConfig->save();
            
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }

    public function seo(Request $request)
    {
        $seo_details = SeoDetail::where('id', '1')->first();
        return view('admin.pages.setting.seo')->with(['title'=>'SEO Details', 'seo_details'=>$seo_details]);
    }
    
    public function update_seo(Request $request)
    {
        $request->validate([
            'seo_title' => 'required',
            'seo_description' => 'required',
            'seo_keywords' => 'required',
            'canonical' => 'required',
        ]);
              
        try 
        { 
            $data = [
                'seo_title' => $request->input('seo_title'),
                'seo_description' => $request->input('seo_description'),
                'seo_keywords' => $request->input('seo_keywords'),
                'canonical' => $request->input('canonical'),
                'blog_seo_title' => $request->input('blog_seo_title'),
                'blog_seo_description' => $request->input('blog_seo_description'),
                'blog_seo_keywords' => $request->input('blog_seo_keywords'),
                'blog_canonical' => $request->input('blog_canonical'),
            ];
         
            $rs = SeoDetail::where(['id'=> '1'])->update($data);
           
            if($rs){              
                $message = array('flag'=>'alert-success', 'message'=>'SEO details updated successfully.');
                return redirect()->route('admin.seo.index')->with(['message'=>$message]);
            }
           
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to update SEO details, Please try again');
            return back()->with(['message'=>$message]);
        } 
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }  
}