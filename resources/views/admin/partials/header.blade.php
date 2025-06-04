<!DOCTYPE html>
<html class="loading attachment" lang="en" data-textdirection="ltr">
<head>
    @php 
        use App\Models\Setting;
        $setting = Setting::where('id', '1')->first();
    @endphp
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Admin Panel') | Admin Panel</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/setting/'.$setting->favicon) }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/setting/'.$setting->favicon) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/app.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/style.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
</head>
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item"><a class="navbar-brand" href="{{ route('admin.dashboard') }}"><img class="brand-logo" alt="robust admin logo" src="{{ asset('assets/admin/images/logo/logo-light-sm.png') }}">
                        <h3 class="brand-text">Admin Panel</h3></a></li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>              
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-link" href="{{ route('admin.change.passsword') }}" style="padding: 1.4rem 1rem; font-size: 20px;"><i class="fa fa-cog"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right">   
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.logout') }}" style="padding: 1.4rem 1rem;"><i class="ft-power"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>