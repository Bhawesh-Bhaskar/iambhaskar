<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\HomePage;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Personal;
use App\Models\Social;
use App\Models\Comment;

class HomeController extends Controller
{
    public function index()
    {
        $home = HomePage::where('id', '1')->first();
        $projects = Project::where('status', '1')->orderBy('orderby', 'asc')->get();
        $technologies = Technology::where('status', '1')->orderBy('id', 'asc')->get();
        $personal = Personal::where('id', '1')->first();
        $social = Social::where('id', '1')->first();
        $blogs = Blog::where('featured', 'on')->orderBy('id', 'desc')->limit(3)->get();
        $blog_cat = BlogCategory::get();
        $blog_tag = BlogTag::get();
        return view('front.pages.index')->with(['title'=>'Home Page', 'home'=>$home, 'projects'=>$projects, 'technologies'=>$technologies, 'personal'=>$personal, 'social'=>$social, 'blogs'=>$blogs, 'blog_cat'=>$blog_cat, 'blog_tag'=>$blog_tag]);
    } 
    
    public function services()
    {
    	$services = Service::orderBy('id', 'desc')->get();
        return view('front.pages.services')->with(['title'=>'Services Page', 'services'=>$services]);
    }

    public function about()
    {
        $faqs = Faq::get();
        $about = AboutPage::where('id', '1')->first();
        $services = Service::orderBy('id', 'desc')->get();
        $teams = Team::get();
        $testimonials = Testimonial::get();
        return view('front.pages.about')->with(['title'=>'About Page', 'faqs'=>$faqs, 'about'=>$about, 'services'=>$services, 'teams'=>$teams, 'testimonials'=>$testimonials]);
    }

    public function faq()
    {
        $faqs = Faq::get();
        return view('front.pages.faq')->with(['title'=>'Faq Page', 'faqs'=>$faqs]);
    }
    
    public function bannerdetails(Request $request, $id)
    {
        $banner = Banner::where('id', $id)->first();
        $banners = Banner::where('id', '!=', '4')->where('id', '!=', $id)->orderBy('id', 'desc')->get();
        return view('front.pages.banner_details')->with(['title'=>'Details Page', 'banner'=>$banner, 'banners'=>$banners]);
    }

    public function blogdetails(Request $request, $slug)
    {
        $blogs = Blog::where('slug', $slug)->first();
        $lat_blogs = Blog::where('slug', '!=', $slug)->orderBy('id', 'desc')->limit(3)->get();
        $blog_cat = BlogCategory::get();
        $blog_tag = BlogTag::get();
        $home = HomePage::where('id', '1')->first();
        $prev_blog = Blog::where('id', '<', $blogs->id)->orderby('id','desc')->first();
        $next_blog = Blog::where('id', '>', $blogs->id)->orderby('id','asc')->first();
        $comments = Comment::where('blog_id', $blogs->id)->whereNull('parent_id')->where('status', '1')->orderBy('created_at', 'desc')->get();
        $subcomments = Comment::where('blog_id', $blogs->id)->whereNotNull('parent_id')->where('status', '1')->orderBy('created_at', 'asc')->get();
        $totalcomments = Comment::where('blog_id', $blogs->id)->where('status', '1')->orderBy('created_at', 'desc')->count();
        
        return view('front.pages.blog_details')->with(['title'=>'Blog Page', 'blogs'=>$blogs, 'blog_cat'=>$blog_cat, 'blog_tag'=>$blog_tag, 'lat_blogs'=>$lat_blogs, 'home' => $home, 'prev_blog' => $prev_blog, 'next_blog' => $next_blog, 'comments' => $comments, 'subcomments' => $subcomments, 'totalcomments' => $totalcomments]);
    }
    
    public function category_blogs(Request $request, $slug)
    {
        $blog_cat = BlogCategory::where('slug', $slug)->first();
        $first_blog = Blog::where('category', $blog_cat->id)->first();
        $blogs = Blog::where('category', $blog_cat->id)->where('id', '!=', $first_blog->id)->orderBy('id', 'desc')->get();
        return view('front.pages.blogs.category')->with(['title'=>'Blog Page', 'blog_cat'=>$blog_cat, 'first_blog'=>$first_blog, 'blogs'=>$blogs]);
    }
    
    public function tag_blogs(Request $request, $slug)
    {
        $blog_cat = BlogTag::where('slug', $slug)->first();
        $first_blog = Blog::where('tag', $blog_cat->id)->first();
        $blogs = Blog::where('tag', $blog_cat->id)->where('id', '!=', $first_blog->id)->orderBy('id', 'desc')->get();
        return view('front.pages.blogs.category')->with(['title'=>'Blog Page', 'blogs'=>$blogs, 'blog_cat'=>$blog_cat, 'first_blog'=>$first_blog]);
    }
    
    public function blog()
    {
        $main_blog = Blog::where('featured', 'on')->orderBy('orderby', 'asc')->orderBy('id', 'desc')->first();
        $featured_blogs = Blog::where('id', '!=', $main_blog->id)->where('featured', 'on')->orderBy('orderby', 'asc')->orderBy('id', 'desc')->limit(2)->get();
        foreach($featured_blogs as $featured_blog){
            $feat_ids[] = $featured_blog->id;
        }
        
        $first_blog = Blog::where('id', '!=', $main_blog->id)->whereNotIn('id', $feat_ids)->orderBy('id', 'desc')->first();
        $blogs = Blog::where('id', '!=', $main_blog->id)->where('id', '!=', $first_blog->id)->whereNotIn('id', $feat_ids)->orderBy('id', 'desc')->get();
        
        $blog_cat = BlogCategory::get();
        $blog_tag = BlogTag::get();
        return view('front.pages.blogs.index')->with(['title'=>'Blog Page', 'main_blog' => $main_blog, 'featured_blogs' => $featured_blogs, 'blogs'=>$blogs, 'blog_cat'=>$blog_cat, 'blog_tag'=>$blog_tag, 'first_blog' => $first_blog]);
    }

    public function contact()
    {
        return view('front.pages.blogs.contact')->with(['title'=>'Contact Page']);
    }  

    public function listservices($slug)
    {
        $content = Service::where('slug', $slug)->first();
        $policies = Policy::where('services', $content->id)->get();
        $services = Service::where('id', '!=', $content->id)->get();
        return view('front.pages.listservices')->with(['title'=>'Listservices Page', 'content'=>$content, 'policies'=>$policies, 'services'=>$services]);
    }

    public function servicedetails($id)
    {
        $services = Service::where('id', $id)->orderBy('id', 'desc')->first();
        return view('front.pages.services_details')->with(['title'=>'Service Details Page', 'services'=>$services]);
    }
    
    public function contactForm(Request $request)
    {
        $recaptcha = $request->input('g-recaptcha-response');
        $secret_key = '6Ldy9x0mAAAAAPopl0KsuvJrk3bwD85CwniZ_tpv';
        
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='. $secret_key . '&response=' . $recaptcha;
  
        $result = file_get_contents($url);
        $response = json_decode($result);
        if($response->success == true){
            $rs = Contact::create([
                'name' =>$request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject' => $request->input('subject'),
                'message' => $request->input('message'),
                'status' => 0
            ]);
            
            if($rs)
            {
                # Send OTP in email after successful registration
                $data = array();
                
                $data['name'] = $request->input('name');
                $data['email'] = $request->input('email');
                $data['phone'] = $request->input('phone');
                $data['subject'] = $request->input('subject');
                $data['message_new'] = $request->input('message');
                                
                Mail::send('mail.support', $data, function ($message) use ($data) {
                    $message->to($data['email']);
                    $message->from('noreply@i-am-bhaskar.com', 'Bhawesh Bhaskar');
                    $message->subject('Thank You for Contacting Us');
                });
                
                Mail::send('mail.supportadmin', $data, function ($message) use ($data) {
                    $message->to('noreply@i-am-bhaskar.com');
                    $message->from($data['email'], $data['name']);
                    $message->subject('New Enquiry to Bhawesh Bhaskar');
                });
                
                $message = 'Mail sent Successfully';
                return redirect()->back()->with(['success'=>$message]);
            }
        }else{
            $message = 'Invalid Captcha.';
            return redirect()->back()->with(['alert'=>$message]);
        }
    }
    
    public function singlepage(Request $request, $slug)
    {
        $pages = Page::where('slug', $slug)->first();
        return view('front.pages.single_page')->with(['title'=>'Single Page', 'pages'=>$pages]);
    } 
    
    public function exposure()
    {
    	$exposures = Exposure::orderBy('id', 'desc')->get();
        return view('front.pages.exposure')->with(['title'=>'Exposure Page', 'exposures'=>$exposures]);
    }
    
    public function exposuredetails($id)
    {
        $banner = Exposure::where('id', $id)->first();
        $banners = Exposure::where('id', '!=', '4')->where('id', '!=', $id)->orderBy('id', 'desc')->get();
        
        return view('front.pages.exposure_detail')->with(['title'=>'Exposure Detail Page', 'banner'=>$banner, 'banners'=>$banners]);
    }
    
    public function clients()
    {
    	$clients = Client::orderBy('id', 'desc')->get();
        return view('front.pages.clients')->with(['title'=>'Clients Page', 'clients'=>$clients]);
    }
    
    public function schedule()
    {
        return view('front.pages.schedule')->with(['title'=>'Schedule Page']);
    }  
    
    public function subscribe_newsletter(Request $request)
    {
        try 
        {
            $rs = Newsletter::create([
                'email' => $request->input('email'),
                'status' => 0
            ]);
            
            if($rs)
            {
                # Send OTP in email after successful registration
                $data = array();
                
                $data['email'] = $request->input('email');
                                
                Mail::send('mail.newsletter', $data, function ($message) use ($data) {
                    $message->to($data['email']);
                    $message->from('noreply@i-am-bhaskar.com', 'Bhawesh Bhaskar');
                    $message->subject('Newsletter subscribed successfully.');
                });
                
                Mail::send('mail.newsletteradmin', $data, function ($message) use ($data) {
                    $message->to('noreply@i-am-bhaskar.com');
                    $message->from($data['email'], 'Subscriber');
                    $message->subject('New Newsletter Subscriber.');
                });
                
                $message = 'Newsletter subscribed successfully.';
                return redirect()->back()->with(['success'=>$message]);
            }
            
            $message = array('flag'=>'alert-danger', 'message'=>'Unable to send mail, Please try again');
            return back()->with(['message'=>$message]);
        }
        catch (Exception $e) 
        {
            $message = array('flag'=>'alert-danger', 'message'=>$e->getMessage());
            return back()->with(['message'=>$message]);
        }
    }
    
    public function search_blog(Request $request)
    {
        $searchTerm = $request->input('search');
        $first_blog = Blog::where('title', 'like', '%' .$searchTerm. '%')->where('status', '1')->first();
        $blogs = Blog::where('title', 'like', '%' .$searchTerm. '%')->where('id', '!=', $first_blog->id)->where('status', '1')->orderBy('id', 'desc')->get();
        
        $blog_cat = BlogCategory::get();
        $blog_tag = BlogTag::get();
        return view('front.pages.blogs.search')->with(['title'=>'Blog Page', 'blogs'=>$blogs, 'blog_cat'=>$blog_cat, 'blog_tag'=>$blog_tag, 'first_blog' => $first_blog, 'search_term' => $searchTerm]);
    }
    
    public function add_comment(Request $request)
    {
        $check_user = User::where('id', $request->user_id)->where('email_verification', '0')->first();
        if(!empty($check_user)){
            $message = 'Email not verified.';
            return back()->with(['alert'=>$message]);
        }
        
        $request->validate([
           'comment'=>'required'
        ]);
        
        try 
        {
            $rs = Comment::create([
                'user_id' => $request->user_id,
                'blog_id' => $request->blog_id,
                'parent_id' => $request->parent_id,
                'comment' => $request->comment,
            ]);
            
            $message = 'Comment added Successfully';
            return redirect()->back()->with(['success'=>$message]);
        }
        catch (Exception $e) 
        {
            $message = $e->getMessage();
            return back()->with(['alert'=>$message]);
        }
    }
}