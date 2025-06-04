<style type="text/css">
     /* The dark background behind the dialogs */

.dialog-overlay{
    display: none;
    position: fixed;
    top:0;
    left:0;

    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.3);

    z-index: 10;
}

/* The dialogs themselves */

.dialog-card{
    box-sizing: border-box;
    width: 570px;
    position: absolute;
    left: 50%;
    margin-left: -285px;
    top: 50%;
    font: bold 14px sans-serif;
    border-radius: 3px;
    background-color:  #ffffff;
    box-shadow: 1px 2px 4px 0 rgba(0, 0, 0, 0.12);
    padding: 45px 50px;
}

.dialog-card .dialog-question-sign{
    float: left;
    width: 68px;
    height: 68px;
    border-radius: 50%;
    color:  #ffffff;
    text-align: center;
    line-height: 68px;
    font-size: 40px;
    margin-right: 50px;
    background-color:  #b4d8f3;
}

.dialog-card .dialog-info{
   float: left;
   width: 100%;
}

.dialog-card h5{  /* Dialog title */
    color:  #383c3e;
    font-size: 24px;
    margin: 5px 0 30px;
}

.dialog-card p{   /* Dialog text */
    color:  #595d60;
    font-weight: normal;
    line-height: 21px;
    margin: 30px 0;
}

.dialog-card .dialog-confirm-button,
.dialog-card .dialog-reject-button{
    font-weight: inherit;
    box-sizing: border-box;
    color: #ffffff;
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
    padding: 12px 40px;
    border: 0;
    cursor: pointer;
    outline: 0;
}

.dialog-card .dialog-confirm-button{
    background-color: #3a7ad2;
    margin-right: 12px;
}

.dialog-card .dialog-reject-button{
    background-color:  #e4749e;
}

.dialog-card button:hover{
    opacity:0.96;
}

.dialog-card button:active{
    position:relative;
    bottom:-1px;
}

.dialog-card .fa-check{
    color: green;
    font-size: 70px;
}

.footer-secondary{
    position: fixed;
    bottom: 0px;
    z-index: 99;
    background-color: var(--primary);
}

.header-searchbar{
    margin-top: 0px;
}
</style>
<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="{{asset('storage/app/public/cms/'.$home->image2)}}" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="#">{{$personal->name}}</a></h1>
        <div class="social-links mt-3 text-center">
          <a href="{{$social->twitter}}" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="{{$social->facebook}}" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="{{$social->instagram}}" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="{{$social->skype}}" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="{{$social->linkedin}}" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>

      <nav class="nav-menu">
        <ul>
          <li class="active"><a href="{{ route('home') }}"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <li><a href="#about"><i class="bx bx-user"></i> <span>About</span></a></li>
          <li><a href="#resume"><i class="bx bx-file-blank"></i> <span>Resume</span></a></li>
          <li><a href="#portfolio"><i class="bx bx-book-content"></i> Projects</a></li>
          <li><a href="#services"><i class="bx bx-server"></i> Career Objective</a></li>
          <li><a href="#contact"><i class="bx bx-envelope"></i> Contact</a></li>

        </ul>
      </nav><!-- .nav-menu -->
      <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

    </div>
  </header><!-- End Header -->