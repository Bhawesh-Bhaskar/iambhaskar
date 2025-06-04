@extends('admin.template.master') 
@section('title', $title)
@section('content')

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			<div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
				<h3 class="content-header-title mb-0 d-inline-block">Users</h3>
				<div class="row breadcrumbs-top d-inline-block">
					<div class="breadcrumb-wrapper col-12">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
							</li>
							<li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users List</a>
							</li>
							<li class="breadcrumb-item active">Add User
							</li>
						</ol>
					</div>
				</div>
			</div>
			<div class="col-md-4 text-right">
				<a href="{{ route('admin.users.index') }}">
					<button class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</button>
                </a>
			</div>
        </div>
        <div class="content-body">
			<section id="horizontal-form-layouts">
				<div class="row">
					<div class="col-md-12">
				        <div class="card">
				            <div class="card-header">
				                <h4 class="card-title" id="horz-layout-colored-controls">Users</h4>
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
				                    @include('admin.partials.flash_message') 					

									<form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
										@csrf()
				                    	<div class="form-body">
				                    		<h4 class="form-section"><i class="fa fa-eye"></i> Add User</h4>
				                    		<div class="row">
				                    			<div class="col-md-6">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control" for="name">Name</label>
							                        	<div class="col-md-9">
							                            	<input type="text" id="name" class="form-control border-primary" placeholder="Name" name="name" required="">
							                            </div>
							                        </div>
							                    </div>
					                        	<div class="col-md-6">
					                        		<div class="form-group row">
							                        	<label class="col-md-3 label-control" for="email">Email</label>
							                        	<div class="col-md-9">
															<input class="form-control border-primary" type="email" placeholder="Email" id="email" name="email" required="">
							                        	</div>
								                    </div>
					                        	</div>
						                       	<div class="col-md-6">	
													<div class="form-group row">
							                        	<label class="col-md-3 label-control" for="phone">Phone Number</label>
							                        	<div class="col-md-9">
															<input class="form-control border-primary" type="tel" placeholder="Phone Number" id="phone" name="phone" required="">
														</div>
							                        </div>
						                       	</div>
												<div class="col-md-6">
												    <div class="form-group row">
							                        	<label class="col-md-3 label-control" for="status">Status</label>
							                        	<div class="col-md-9">
															<select class="form-control border-primary" name="status" id="status" required="">
																<option value="1">Active</option>
																<option value="0">Inactive</option>
															</select>
														</div>
							                        </div>
												</div>
												<div class="col-md-6">
                                                    <div class="form-group row">
                                                    	<label class="col-md-3 label-control" for="image">Image : <span class="danger">*</span></label>
                                                    	<div class="col-md-9">
                                                        	<input type="file" name="image" id="imageUpload" class="hide"> 
                                                            <label for="imageUpload" class="upload-poster mr-5">Select file</label> Max Size 50 kb<br>
                                                            <img src="{{ asset('assets/admin/images/dummy-logo.jpg')}}" id="imagePreview" class="organisation-logo" alt="Your image will appear here.">
                                                        </div>
                                                    </div>
                                                </div>
					                        </div>

					                        <h4 class="form-section"><i class="ft-mail"></i> Security Info</h4>
					                        <div class="row">
					                        	<div class="col-md-6">					                        		
					                        		<div class="form-group row">
							                        	<label class="col-md-3 label-control" for="password">Password</label>
							                        	<div class="col-md-9">
															<input type="password" name="password" id="password" placeholder="Password" class="form-control border-primary" required="">
							                        	</div>
								                    </div>
					                        	</div>
												<div class="col-md-6">					                        		
					                        		<div class="form-group row">
							                        	<label class="col-md-3 label-control" for="confirm_password">Confirm Password</label>
							                        	<div class="col-md-9">
															<input type="password" name="password_confirmation" id="confirm_password" placeholder="Confirm Password" class="form-control border-primary" required="">
							                        	</div>
								                    </div>
					                        	</div>
					                        </div>
										</div>

				                        <div class="form-actions right">
				                            <button type="submit" class="btn btn-primary">
				                                <i class="fa fa-check-square-o"></i> Save
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