
<div id="my-confirm-dialog" class="dialog-overlay">
      <div class="dialog-card">
         <div class="dialog-info cal-result text-center">
          <i class="fa fa-check"></i>
            <h2 class="mt-2">Thank You for Contacting</h2>
            <h3 class="mt-2">Bhawesh Bhaskar.</h3>
            <button class="dialog-confirm-button mt-5">OK</button> 
         </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>

      function showDialog(id){
            var dialog = $('#' + id),
            card = dialog.find('.dialog-card');
            dialog.fadeIn();
            card.css({
              'margin-top' : -card.outerHeight()/2
            });
          }

        $(document).ready(function() {          

          function hideAllDialogs(){
            $('.dialog-overlay').fadeOut();
            }

            $('.dialog-confirm-button, .dialog-reject-button').on('click', function () {
              hideAllDialogs();
            });

            $('.dialog-overlay').on('click', function (e) {
              if(e.target == this){
                hideAllDialogs();
              }
            });

            $(document).keyup(function(e) {
              if (e.keyCode == 27) {
                hideAllDialogs();
              }
            });

            $('.dialog-show-button').on('click', function () {
              var toShow = $(this).data('show-dialog');
              showDialog(toShow);
            });
          });

    </script>

   <script>
      function myFunction() {
        window.print();
      }
   </script>

   
@php 

   if(session()->has('message1')){

      $script = '<script type="text/javascript">';
      $script .= 'showDialog("my-confirm-dialog");';
      $script .= '</script>';

      echo $script;
    }

@endphp
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Bhawesh Bhaskar</span></strong>
      </div>
      <div class="credits">
        Designed & Developed by <a href="https://i-am-bhaskar.com/">Bhawesh Bhaskar</a>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>