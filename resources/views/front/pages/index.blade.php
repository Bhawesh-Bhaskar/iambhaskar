@extends('front.template.master') 
@section('title', $title)
@section('content')

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
    .submit-button{
        background: #149ddd;
        border: 0;
        padding: 10px 24px;
        color: #fff;
        transition: 0.4s;
        border-radius: 4px;
    }
    
    #loading_spinner { 
        display:none; 
    }
    
    #loading_spinner img{
        width: 100px;
    }
    
    .owl-carousel.owl-drag .owl-item{
        padding: 10px;
    }
    
    .testimonials .testimonial-item{
        background: #fff;
        text-align: left;
    }
    
    .testimonials .testimonial-item h3{
        margin: 0px;
    }
    
    .testimonials .testimonial-item h4 {
        padding: 0px 5px;
    }

    .testimonials .testimonial-item p {
        padding: 20px 5px;
        margin-bottom: 0px;
    }
    
    .blog-top-button{
        position: absolute;
        top: 50px;
        right: 50px;
        z-index: 9;
        width: 100px;
        border-radius: 20px;
        font-weight: bold;
        background: #d10a0a;
        color: #fff;
        box-shadow: 0px 1px 5px 5px #d10a0a;
        border: 0px solid #d10a0a;
        animation: blinker 3s linear infinite;
    }
    
    @keyframes blinker {
      50% {
        opacity: 0;
      }
    }
    
    .home-banner{
        background: url({{asset('storage/app/public/cms/'.$home->image1)}}) !important; 
        background-size: cover !important;
        height: 100vh !important;
    }
    
    #hero:before{
        height: 100vh !important;
    }
    
    @media only screen and (max-width: 768px) {
        .home-banner{
            background: url({{asset('storage/app/public/cms/bhawesh.png')}}) !important; 
            background-size: cover !important;
            height: auto !important;
        }
        
        #hero:before{
            height: 300px !important;
        }
        
        .blog-top-button {
            top: 20px;
            right: 65px;
        }
    }
</style>

  <!-- ======= Hero Section ======= -->
  
    <div id="main_slider">
      <section id="hero" class="d-flex flex-column justify-content-center align-items-center home-banner">
        <div class="hero-container" data-aos="fade-in">
          <h1>{{$personal->name}}</h1>
          <p>I'm <span class="typed" data-typed-items="Designer, Developer"></span></p>
          <h3 ><a class="color-white text-white"  href="{{asset('storage/app/public/attachment/'.$home->attachment1)}}" download>Download CV</a></h3>
        </div>
      </section><!-- End Hero -->
    </div>
    
    <a href="{{ route('blog') }}">
        <button class="blog-top-button">Blogs</button>
    </a>

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2>About</h2>
          <p><?php echo $home->content1; ?></p>
        </div>

        <div class="row">
          <div class="col-lg-4" data-aos="fade-right">
            <img src="{{asset('storage/app/public/cms/'.$home->image3)}}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3>UI/UX Designer &amp; Web Developer.</h3>
            <p class="font-italic">
              I am good in Frontend as well as Backend. Also, good hands on CMS.
            </p>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <li><i class="icofont-rounded-right"></i> <strong>Experience:</strong> {{ $personal->experience }} </li>
                  <li><i class="icofont-rounded-right"></i> <strong>Birthday:</strong> {{ $personal->dob }} </li>
                  <li><i class="icofont-rounded-right"></i> <strong>Website:</strong> {{ $personal->website }} </li>
                  <li><i class="icofont-rounded-right"></i> <strong>Phone:</strong> {{ $personal->phone1 }} </li>
                  <li><i class="icofont-rounded-right"></i> <strong>City:</strong> {{ $personal->location }} </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                    <li><i class="icofont-rounded-right"></i> <strong>Qualification:</strong> {{ $personal->qualification }}</li>
                    <li><i class="icofont-rounded-right"></i> <strong>Age:</strong> {{ $personal->age }}</li>
                    <li><i class="icofont-rounded-right"></i> <strong>Email:</strong> {{ $personal->email1 }}</li>
                    <li><i class="icofont-rounded-right"></i> <strong>Email:</strong>{{ $personal->email2 }}</li>
                    @if(!empty($personal->freelance))
                        <li><i class="icofont-rounded-right"></i> <strong>Freelance:</strong> {{ $personal->freelance }}</li>
                    @endif
                </ul>
              </div>
            </div>
            <p><?php echo $home->content2; ?></p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

{{--     <!-- ======= Facts Section ======= -->
    <section id="facts" class="facts">
      <div class="container">

        <div class="section-title">
          <h2>Facts</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row no-gutters">

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up">
            <div class="count-box">
              <i class="icofont-simple-smile"></i>
              <span data-toggle="counter-up">232</span>
              <p><strong>Happy Clients</strong> consequuntur quae</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="count-box">
              <i class="icofont-document-folder"></i>
              <span data-toggle="counter-up">521</span>
              <p><strong>Projects</strong> adipisci atque cum quia aut</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="count-box">
              <i class="icofont-live-support"></i>
              <span data-toggle="counter-up">1,463</span>
              <p><strong>Hours Of Support</strong> aut commodi quaerat</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="count-box">
              <i class="icofont-users-alt-5"></i>
              <span data-toggle="counter-up">15</span>
              <p><strong>Hard Workers</strong> rerum asperiores dolor</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Facts Section --> --}}

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Skills</h2>          
          <p><?php echo $home->content3; ?></p>
        </div>

        <div class="row skills-content">

          <div class="col-lg-6" data-aos="fade-up">

            <div class="progress">
              <span class="skill">Laravel <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            
            <div class="progress">
              <span class="skill">Bootstrap <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">HTML/CSS <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">JavaScript <i class="val">85%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              
            <div class="progress">
              <span class="skill">API's <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">MySql <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">WordPress/CMS <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">Photoshop <i class="val">80%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Skills Section -->

    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume">
      <div class="container">

        <div class="section-title">
          <h2>Resume <a href="{{asset('storage/app/public/attachment/'.$home->attachment1)}}" target="_blank"><i class="icofont-file-pdf"></i></a></h2>
          <p><?php echo $home->content4; ?></p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="resume-title">Professional Experience</h3>
            <div class="resume-item">
              <h4>Sr. Software Developer</h4>
              <h5>Dec, 2020 - Present</h5>
              <p><em><strong>SMD Webtech Limited </strong>, Noida, UP, India</em></p>
            </div>
            <!--<div class="resume-item">-->
            <!--  <h4>Laravel Developer</h4>-->
            <!--  <h5>June, 2020 - Dec, 2020</h5>-->
            <!--  <p><em><strong>Pratham Vision Pvt. Ltd. </strong>, Noida, UP, India</em></p>-->
            <!--</div>-->
            <div class="resume-item">
              <h4>Full Stack Developer</h4>
              <h5>Aug, 2019 - Dec, 2020</h5>
              <p><em><strong>CTD World </strong>, Noida, UP, India</em></p>
            </div>
            <div class="resume-item">
              <h4>Full Stack Developer</h4>
              <h5>Sep, 2018 - July, 2019</h5>
              <p><em><strong>Annexorien Technologies Pvt. Ltd. </strong>, Laxmi Nagar, New Dekhi, India</em></p>
            </div>
            
            <h3 class="resume-title">Sumary</h3>
            <div class="resume-item pb-0">
              <h4>Bhawesh Bhaskar</h4>
              <p><em>Innovative and deadline-driven Full Stack Developer with 2 years of experience. Designing and Developing user-centered digital/print marketing material from initial concept to final, polished deliverable.</em></p>
              <ul>
                <li>{{$personal->location}}</li>
                <li><a href="tel:{{$personal->phone1}}">{{$personal->phone1}}</a> / <a href="tel:{{$personal->phone2}}">{{$personal->phone2}}</a></li>
                <li><a href="mailto:{{$personal->email1}}">{{$personal->email1}}</a> / <a href="mailto:{{$personal->email2}}">{{$personal->email2}}</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-up">
            <h3 class="resume-title">Internships</h3>
            <div class="resume-item">
              <h4>Web Developer</h4>
              <h5>Mar, 2018 - July, 2018</h5>
              <p><em><strong>Seraphic Infosolutions Pvt. Ltd. </strong>, Mohali, Chandigarh, India</em></p>
            </div>
            <div class="resume-item">
              <h4>Digital Marketing</h4>
              <h5>Nov, 2017 - Mar, 2018</h5>
              <p><em><strong>MMU </strong>, Ambala, Haryana, India</em></p>
            </div>
            <div class="resume-item">
              <h4>Web Developer</h4>
              <h5>Nov, 2017 - Jan, 2018</h5>
              <p><em><strong>Pesta Kolej </strong>, Ambala, Haryana, India</em></p>
            </div>
            
            <h3 class="resume-title">Education</h3>
            <div class="resume-item">
              <h4>Graduation (B.Tech)</h4>
              <h5>2014 - 2018</h5>
              <p><em>Maharishi Markandeshwar University, Ambala, Haryana, India.</em></p>
            </div>
            <div class="resume-item">
              <h4>Intermediate ( 10+2 )</h4>
              <h5>2012 - 2014</h5>
              <p><em>Shanti Niketan Awasiya Bal Vidyalaya, Ahiyapur, Muzaffarpur, Bihar.</em></p>
            </div>
            <div class="resume-item">
              <h4>Matriculation ( 10 )</h4>
              <h5>2012</h5>
              <p><em>Shanti Niketan Awasiya Bal Vidyalaya, Ahiyapur, Muzaffarpur, Bihar.</em></p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Resume Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Projects</h2>
          <p><?php echo $home->content5; ?></p>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Websites</li>
              {{-- <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li> --}}
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">
            @foreach($projects as $project)
                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                      <img src="{{asset('storage/app/public/projects/'.$project->image)}}" class="img-fluid" alt="">
                      <div class="portfolio-links">
                        <a href="{{asset('storage/app/public/projects/'.$project->image)}}" data-gall="portfolioGallery" class="venobox" title="{{$project->title}}"><i class="bx bx-plus"></i></a>
                        <a href="{{$project->link}}" title="More Details"><i class="bx bx-link"></i></a>
                      </div>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="#">
            <div class="text-center">
              <button type="button" class="blog-button">Show All</button>
            </div>
        </a>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Technologies Working On</h2>
          <p><?php echo $home->content6; ?></p>
        </div>

        <div class="row">
            @foreach($technologies as $technology)
                <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
                    <div class="icon"><i class="{{$technology->icon}}"></i></div>
                    <h4 class="title"><a href="#">{{$technology->title}}</a></h4>
                    <p class="description">{{$technology->description}}</p>
                </div>
            @endforeach
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Blogs</h2>
          <p><?php echo $home->content7; ?></p>
        </div>

        <div class="owl-carousel testimonials-carousel">
            @foreach($blogs as $blog)
                <div class="testimonial-item" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('blogdetails', $blog->slug) }}">
                        <img src="{{ asset('storage/app/public/blogs/'.$blog->image) }}" style="width: 100%; height: 200px;">
                    </a>
                    <h3><a href="{{ route('blogdetails', $blog->slug) }}">{{ $blog->title }}</a></h3>
                    <h4>{{ Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}</h4>
                    <p>{{ $blog->short_description }}</p> 
                    @foreach($blog_cat as $cat)
                        @if($cat->id == $blog->category)
                            <a href="{{ route('category.blogs', $cat->slug) }}"> 
                                <span class="badge bg-primary text-light mb-4 ml-4">{{ $cat->title }}</span> 
                            </a>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>

        <a href="{{ route('blog') }}">
            <div class="text-center">
              <button type="button" class="blog-button">Show All</button>
            </div>
        </a>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
          <p><?php echo $home->content8; ?></p>
        </div>

        <div class="row" data-aos="fade-in">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>{{$personal->location}}</p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p><a href="mailto:{{$personal->email1}}">{{$personal->email1}}</a> <br> <a href="mailto:{{$personal->email2}}">{{$personal->email2}}</a></p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p><a href="tel:{{$personal->phone1}}">{{$personal->phone1}}</a> <br> <a href="tel:{{$personal->phone2}}">{{$personal->phone2}}</a></p>
              </div>
              
              <div class="phone">
                <i class="icofont-whatsapp"></i>
                <h4>Whatsapp:</h4>
                <p><a href="https://wa.me/{{$personal->whatsapp}}">{{$personal->whatsapp}}</a></p>
              </div>

              <?php echo $personal->map; ?>
            </div>

          </div>

            <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                <form class="bhawesh-contact" method="Post" action="{{ route('insertContact') }}">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="name">Your Name</label>
                      <input type="text" name="name" class="form-control" id="name" required="">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="name">Your Email</label>
                      <input type="email" class="form-control" name="email" id="email" required="">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="name">Contact</label>
                      <input type="number" class="form-control" name="phone" id="phone" required="">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="name">Subject</label>
                      <input type="text" class="form-control" name="subject" id="subject" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name">Message</label>
                    <textarea class="form-control" name="message" id="message" rows="10" required=""></textarea>
                  </div>
                  <div class="g-recaptcha" data-sitekey="6Ldy9x0mAAAAAL_SfrntCnAGwDT74zELtzlofq4K"></div>
                  <div class="text-left">
                    <button type="submit" class="submit-button mt-4">Send Message</button>
                  </div>
                </form>
            </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
  </main><!-- End #main -->
  
<div class="container-fluid mt-5 text-center" id="loading_spinner">
    <img src="{{ asset('public/assets/img/loading.gif') }}">
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    
<script>
    $(function() {
        $( "form" ).submit(function() {
            $('#loading_spinner').show();
            $('#main').hide();
            $('#main_slider').hide();
            $('#header').hide();
            $('#footer').hide();
        });
    });
</script>

@if(session()->has('success'))
    <script type="text/javascript">
        $(function () {
            swal({
                title: "Success",
                text: "{{ session()->get('success') }}",
                type: "success",
                confirmButtonColor: "#000",
                confirmButtonText: "Close",
                closeOnConfirm: false, 
            })
        });
    </script>
@endif
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>

@endsection