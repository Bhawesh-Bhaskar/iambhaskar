@extends('admin.template.master') 
@section('title', $title)
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
				<h3 class="content-header-title mb-0 d-inline-block">Email Templates</h3>
				<div class="row breadcrumbs-top d-inline-block">
					<div class="breadcrumb-wrapper col-12">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
							</li>
							<li class="breadcrumb-item active">Email Templates List
							</li>
						</ol>
					</div>
				</div>
            </div>          
        </div>
        <div class="content-body">
	      <section id="html5">
	      	<div class="row">
	      		<div class="col-12">
	      			<div class="card">
	      				<div class="card-header">
	      					<h4 class="card-title">Email Templates List</h4>
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
	      				<div class="card-content collapse show">
	      					<div class="card-body card-dashboard">
	      						@include('admin.partials.flash_message') 
	      						<div class="row">
									<div class="col-md-3">
										@include('admin.partials.mail_menu')
									</div>
									<div class="col-md-9">									
										<form action="{{ route('admin.templates.update', $tempId)}}" method="post" enctype="multipart/form-data" class="form form-horizontal">
											@csrf()
											<div class="form-body"> 
												<h4 class="form-section"><i class="fa fa-eye"></i>
													@if($tempId == 1)
														New User
													@elseif($tempId == 2)
														Verification Link
													@endif
											    </h4>
												@foreach($tempData as $temp)
												    <div class="row">
														<div class="col-md-12">
															<div class="form-group row">
																<label class="col-md-2 label-control text-left" for="subject">Subject : <span class="danger">*</span></label>
																<div class="col-md-10">
																	<input type="text" id="subject" class="form-control border-primary" placeholder="Subject" name="subject" value="{{$temp->subject}}" required="">
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group" style="display: none;">
																<button id="edit"></button>
																<button id="save"></button>
															</div>
															<div class="form-group row">
																<label class="col-md-2 label-control text-left" for="userinput3"> Body <span class="text-danger">*</span> :</label>
																<div class="col-md-10">      
																	<textarea class="summernote" name="body">{{$temp->body}}</textarea>
																</div>
															</div>
														</div>
													</div>
												@endforeach	
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
	      		</div>
	      	</div>
	      </section>
        </div>
      </div>
    </div>
@endsection