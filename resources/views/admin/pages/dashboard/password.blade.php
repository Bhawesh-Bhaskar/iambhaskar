@extends('admin.template.master')
@section('title', 'Change Password')
@section('content')

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Change Password</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Change Password
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
			<section id="horizontal-form-layouts">
				<div class="row">
					<div class="col-md-12">
				        <div class="card">
				            <div class="card-header">
				                <h4 class="card-title" id="horz-layout-colored-controls">Change Password</h4>
				                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
			        			<div class="heading-elements">
				                    <ul class="list-inline mb-0">
				                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
				                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
				                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
				                        <li><a data-action="close"><i class="ft-x"></i></a></li>
				                    </ul>
				                </div>
				            </div>
				            <div class="card-content collpase show">
				                <div class="card-body">

				                	@if(Session::has('success'))
				                       <div class="alert alert-success">
				                           {{ Session::get('success') }}
				                        </div>
				                    @endif

				                    @if(Session::has('error'))
				                       <div class="alert alert-danger">
				                           {{ Session::get('error') }}
				                        </div>
				                    @endif

				                    @include('admin.partials.flash_message') 					

									<form action="{{ route('admin.update.passsword') }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
										@csrf()
				                    	<div class="form-body">
				                    		<h4 class="form-section"><i class="fa fa-eye"></i> Security Info</h4>
				                    		<div class="row">
				                    			<div class="col-md-6">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control" for="old_password">Old Password</label>
							                        	<div class="col-md-9">
							                            	<input type="password" name="old_password" id="old_password" placeholder="Enter Your Current Passsword" class="form-control border-primary" required="">
							                            </div>
							                        </div>
							                    </div>
							                </div>
							                <div class="row">
							                    <div class="col-md-6">
						                        	<div class="form-group row">
							                        	<label class="col-md-3 label-control" for="userinput3">New Password</label>
							                        	<div class="col-md-9">
							                            	<input type="password" name="password" id="password" placeholder="Enter Your New Password" class="form-control border-primary" required="">
						                        		</div>
						                       		</div>
						                       	</div>
					                        </div>
					                        <div class="row">
					                        	<div class="col-md-6">
					                        		<div class="form-group row">
							                        	<label class="col-md-3 label-control" for="userinput5">Confirm Password</label>
							                        	<div class="col-md-9">
															<input type="password" name="password_confirmation" id="confirm_password" placeholder="Enter Your Confirm Password" class="form-control border-primary" required="">
							                        	</div>
								                    </div>
					                        	</div>
					                        </div>
										</div>

				                        <div class="form-actions right">
				                            <button type="submit" class="btn btn-primary">
				                                <i class="fa fa-check-square-o"></i> update
				                            </button>
				                        </div>
				                    </form>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>
			</section>
        </div>
      </div>
    </div>

    <script>
        var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");

        function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
@endsection