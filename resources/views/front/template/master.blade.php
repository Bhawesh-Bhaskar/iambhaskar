<!DOCTYPE html>

<html lang="en">

@include('front.partials.site_head')

<body>
	<div class="wrapper">
		@include('front.partials.header')
		@yield('content')
		@include('front.partials.footer')
	</div>
</body>

@include('front.partials.site_foot')

</html>