<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <title>Bhawesh Bhaskar</title>
    <link rel="stylesheet" href="{{ asset('assets/css/loginstyle.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="logo"> 
        <h1><i> Admin Panel</i></h1>
    </div> 

    <section class="stark-login">
        <form action="{{ route('admin_secure_login') }}" method="post">
            @csrf
            <div id="fade-box">
                <!-- Display Flash Messages -->
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Email Field -->
                <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
                
                <!-- Password Field -->
                <input type="password" name="password" id="signinPwd" placeholder="Password" required>
                
                <!-- Show Password Link -->
                <a href="#" onclick="myFunction()">
                    <i class="fa fa-eye" style="font-size: 15px; float: right; position: relative; right: 45px; bottom: 40px; color: #74ebe6;"></i>
                </a>
                
                <!-- Submit Button -->
                <button type="submit">Sign in</button> 
            </div>
        </form>

        <div class="hexagons">
            <img src="{{ asset('assets/img/jarvis.png') }}" height="768px" width="1366px"/> 
        </div>      
    </section> 
    
    <div id="circle1">
        <div id="inner-cirlce1"></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        function myFunction() {
            var x = document.getElementById("signinPwd");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>
