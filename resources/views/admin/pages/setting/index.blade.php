@extends('admin.template.master') 
@section('title', $title)
@section('content')

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			<div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
				<h3 class="content-header-title mb-0 d-inline-block">Genearl Settings</h3>
				<div class="row breadcrumbs-top d-inline-block">
					<div class="breadcrumb-wrapper col-12">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
							</li>
							<li class="breadcrumb-item active">Genearl Settings
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
				                <h4 class="card-title" id="horz-layout-colored-controls">Genearl Settings</h4>
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

									<form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
										@csrf()
				                    	<div class="form-body">
				                    		<h4 class="form-section"><i class="fa fa-eye"></i> Genearl Settings</h4>
				                    		<div class="row">
				                    			<div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Name : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Name" name="name" value="{{$settings->name}}">
							                            </div>
							                        </div>
							                    </div>
                                        		<div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="userinput1">Logo : <span class="danger">*</span></label>
                                                        <div class="col-md-9">
                                                        <input type="file" name="logo" id="imageUpload" class="hide"> 
                                                        <label for="imageUpload" class="upload-poster mr-5">Select file</label> Max Size 2 mb<br>
                                                        @if(trim($settings->logo))
                                                            <img src="{{ asset('assets/img/setting/'.$settings->logo) }}" id="imagePreview" class="organisation-logo">
                                                        @else
                                                            <img src="{{ asset('assets/admin/images/dummy-logo.jpg')}}" id="imagePreview" class="organisation-logo" alt="Your image will appear here.">
                                                        @endif
                                                    </div>
                                                    </div>
                                                </div>                                                
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="userinput3">Favicon : <span class="danger">*</span></label>
                                                        <div class="col-md-9">
                                                        <input type="file" name="favicon" id="imageUpload1" class="hide"> 
                                                        <label for="imageUpload1" class="upload-poster mr-5">Select file</label> Max Size 2 mb<br>
                                                        @if(trim($settings->favicon))
                                                            <img src="{{ asset('assets/img/setting/'.$settings->favicon) }}" id="imagePreview1" class="organisation-logo">
                                                        @else
                                                            <img src="{{ asset('assets/admin/images/dummy-logo.jpg')}}" id="imagePreview1" class="organisation-logo" alt="Your image will appear here.">
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Google Recaptcha Key : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Google Recaptcha Key" name="google_recaptcha_key" value="{{$settings->google_recaptcha_key}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Google Recaptcha Secret : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Google Recaptcha Secret" name="google_recaptcha_secret" value="{{$settings->google_recaptcha_secret}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Google Analytics Code : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Google Analytics Code" name="google_analytics_code" value="{{$settings->google_analytics_code}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Google Firebase Key : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Google Firebase Key" name="google_firebase_key" value="{{$settings->google_firebase_key}}">
							                            </div>
							                        </div>
							                    </div>
												<div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Version : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Version" name="version" value="{{$settings->version}}">
							                            </div>
							                        </div>
							                    </div>
					                        </div>
										</div>

				                        <div class="form-actions right">
				                            <button type="submit" class="btn btn-primary">
				                                <i class="fa fa-check-square-o"></i> Update
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
@endsection