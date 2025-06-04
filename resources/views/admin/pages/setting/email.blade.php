@extends('admin.template.master') 
@section('title', $title)
@section('content')

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			<div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
				<h3 class="content-header-title mb-0 d-inline-block">Email Configs</h3>
				<div class="row breadcrumbs-top d-inline-block">
					<div class="breadcrumb-wrapper col-12">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
							</li>
							<li class="breadcrumb-item active">Email Configs
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
				                <h4 class="card-title" id="horz-layout-colored-controls">Email Configs</h4>
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

									<form action="{{ route('admin.email.update') }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
										@csrf()
				                    	<div class="form-body">
				                    		<h4 class="form-section"><i class="fa fa-eye"></i> Email Configs</h4>
				                    		<div class="row">
				                    			<div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Driver : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Driver" name="email_protocol" value="{{$configs->email_protocol}}">
							                            </div>
							                        </div>
							                    </div>
												<div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Host : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Host" name="smtp_host" value="{{$configs->smtp_host}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Port : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Port" name="smtp_port" value="{{$configs->smtp_port}}">
							                            </div>
							                        </div>
							                    </div>
												<div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">From Address : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="From Address" name="from_address" value="{{$configs->from_address}}">
							                            </div>
							                        </div>
							                    </div>
												<div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">From Name : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="From Name" name="from_name" value="{{$configs->from_name}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Encryption : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Encryption" name="email_encryption" value="{{$configs->email_encryption}}">
							                            </div>
							                        </div>
							                    </div>
												<div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Email : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Email" name="smtp_email" value="{{$configs->smtp_email}}">
							                            </div>
							                        </div>
							                    </div>
												<div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Username : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Username" name="smtp_username" value="{{$configs->smtp_username}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Password : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Password" name="smtp_password" value="{{$configs->smtp_password}}">
							                            </div>
							                        </div>
							                    </div>
												<div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Notification Email : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Notification Email" name="notification_email" value="{{$configs->notification_email}}">
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