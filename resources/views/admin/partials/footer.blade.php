    <footer class="footer footer-static footer-light navbar-border">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="d-block d-md-inline-block">Copyright  &copy; {{ date('Y') }} <a class="text-bold-800 grey darken-2" href="https://i-am-bhaskar.com/" target="_blank"> Bhawesh Bhaskar </a>, All rights reserved. </span></p>
    </footer>    

    <script src="{{ asset('assets/admin/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/core/app.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts/forms/select/form-select2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/js/editors/summernote/summernote.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts/editors/editor-summernote.min.js') }}"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script>  
        $('#imageUpload').change(function(){      
            readImgUrlAndPreview(this);
            function readImgUrlAndPreview(input){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {                    
                        $('#imagePreview').attr('src', e.target.result);
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }  
        });
        
        $('#imageUpload1').change(function(){      
            readImgUrlAndPreview(this);
            function readImgUrlAndPreview(input){
                if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {                    
                            $('#imagePreview1').attr('src', e.target.result);
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }  
        });
        
        $('#imageUpload2').change(function(){      
            readImgUrlAndPreview(this);
            function readImgUrlAndPreview(input){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {                    
                        $('#imagePreview2').attr('src', e.target.result);
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }  
        });
        
        $('#imageUpload3').change(function(){      
            readImgUrlAndPreview(this);
            function readImgUrlAndPreview(input){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {                    
                        $('#imagePreview3').attr('src', e.target.result);
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }  
        });
        
        $('#imageUpload4').change(function(){      
            readImgUrlAndPreview(this);
            function readImgUrlAndPreview(input){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {                    
                        $('#imagePreview4').attr('src', e.target.result);
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }  
        });

        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        }
    </script>
  </body>
</html>