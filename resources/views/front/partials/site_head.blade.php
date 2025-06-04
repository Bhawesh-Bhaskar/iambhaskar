<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5745610935807212"
     crossorigin="anonymous"></script>
  
    <?php
      $seo_details = DB::table('seo_details')->where('id', '1')->first();
    ?>

  <title>{{ $seo_details->seo_title }}</title>
  <meta name="description" content="{{ $seo_details->seo_description }}">
  <meta name="keywords" content="{{ $seo_details->seo_keywords }}">
  <meta name="author" content="Bhawesh Bhaskar">
  <link rel="canonical" href="{{ $seo_details->canonical }}">

  <!-- Favicons -->
  <link href="{{asset('public/assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('public/assets/img/favicon.png')}}" rel="apple-touch-icon">
  <link href="{{asset('public/assets/img/favicon.png')}}" rel="shortcut icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Vendor CSS Files -->
  <link href="{{asset('public/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('public/assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('public/assets/vendor/aos/aos.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('public/assets/css/style.css')}}" rel="stylesheet">
  
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-G8N9YN937K"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-G8N9YN937K');
    </script>

</head>