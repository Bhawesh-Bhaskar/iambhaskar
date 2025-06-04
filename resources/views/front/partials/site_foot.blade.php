 <!-- Vendor JS Files -->

 <script src="{{asset('public/assets/vendor/jquery/jquery.min.js')}}"></script>

<script src="{{asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('public/assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>

<script src="{{asset('public/assets/vendor/php-email-form/validate.js')}}"></script>

<script src="{{asset('public/assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>

<script src="{{asset('public/assets/vendor/counterup/counterup.min.js')}}"></script>

<script src="{{asset('public/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

<script src="{{asset('public/assets/vendor/venobox/venobox.min.js')}}"></script>

<script src="{{asset('public/assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>

<script src="{{asset('public/assets/vendor/typed.js/typed.min.js')}}"></script>

<script src="{{asset('public/assets/vendor/aos/aos.js')}}"></script>



<!-- Template Main JS File -->

<script src="{{asset('public/assets/js/main.js')}}"></script>

  <?php
      $personal = DB::table('personals')->first();
  ?>

  <a href="https://wa.me/{{$personal->whatsapp}}" target="_blank">
      <img src="{{asset('public/front/images/whatsapp.png')}}" style="position: fixed; bottom: 20px; left: 15px; width: 60px; z-index: 9999;">
  </a>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5c802964a726ff2eea5afdc9/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->