<!DOCTYPE html>
<html>
<head>
<title>Something Went Wrong</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    body{
    background-color: black;
    color: white;
    }

    h1 {
    color: red;
    }

    h6{
    color: red;
    text-decoration: underline;
    }
</style>
</head>
<body>
<div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top w3-center"><code>Something Went Wrong</code></h1>
    <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
    <h3 class="w3-center w3-animate-right">Oops! Something went wrong on our end. We're working to fix it.</h3>
    <h3 class="w3-center w3-animate-zoom">🚫🚫🚫🚫</h3>
    <h6 class="w3-center w3-animate-zoom">error code:505 server error</h6>

    @if(session('previous_url'))
        <h6 class="w3-center w3-animate-zoom"><a href="{{ session('previous_url') }}">Go Back</a></h6>
    @else
        <h6 class="w3-center w3-animate-zoom"><a href="{{ route('admin.dashboard') }}">Go back to Home</a></h6>
    @endif
</div>
</body>
</html>