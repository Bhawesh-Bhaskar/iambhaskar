<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Under Maintenance</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: red;
        }

        h6 {
            color: red;
            text-decoration: underline;
        }

        .maintenance-container {
            text-align: center;
            padding: 50px;
        }

        .maintenance-message {
            font-size: 2rem;
            margin: 20px 0;
        }

        .maintenance-time {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

@php 
    use Carbon\Carbon;

    // Use optional() to handle potential null values
    $ondate = optional($setting)->date ? Carbon::parse($setting->date)->format('d M Y') : 'N/A';
    $fromtime = optional($setting)->from_time ? Carbon::parse($setting->from_time)->format('h:i:s A') : 'N/A';
    $totime = optional($setting)->to_time ? Carbon::parse($setting->to_time)->format('h:i:s A') : 'N/A';
    $zone = Carbon::now();
@endphp

<div class="w3-display-middle maintenance-container">
    <h1 class="w3-jumbo w3-animate-top"><code>We'll Be Back Soon!</code></h1>
    <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
    <h3 class="maintenance-message w3-animate-right">We are currently undergoing scheduled maintenance. We should be back shortly. Thank you for your patience!</h3>
    <h3 class="w3-center w3-animate-zoom">🚫🚫🚫🚫</h3>
    <h6 class="maintenance-time w3-center w3-animate-zoom">Maintenance Date: {{ $ondate }}</h6>
    <h6 class="maintenance-time w3-center w3-animate-zoom">Maintenance Time: {{ $fromtime }} - {{ $totime }} ({{ $zone->tzName }}+0)</h6>

    @if(optional($setting)->message)
        <h6 class="maintenance-time w3-center w3-animate-zoom">Maintenance Reason: {{ $setting->message }}</h6>
    @else
        <h6 class="maintenance-time w3-center w3-animate-zoom">Reason not provided</h6>
    @endif

    @if(session('previous_url'))
        <h6 class="w3-center w3-animate-zoom"><a href="{{ session('previous_url') }}">Go Back</a></h6>
    @else
        <h6 class="w3-center w3-animate-zoom"><a href="{{ route('home') }}">Go to Home Page</a></h6>
    @endif
</div>

</body>
</html>
