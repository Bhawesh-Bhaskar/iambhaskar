@extends('admin.template.master') 
@section('title', $title)
@section('content')

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			<div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
				<h3 class="content-header-title mb-0 d-inline-block">Personal Details</h3>
				<div class="row breadcrumbs-top d-inline-block">
					<div class="breadcrumb-wrapper col-12">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
							</li>
							<li class="breadcrumb-item active">Personal Details
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
				                <h4 class="card-title" id="horz-layout-colored-controls">Personal Details</h4>
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

									<form action="{{ route('admin.personal.update') }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
										@csrf()
				                    	<div class="form-body">
				                    		<h4 class="form-section"><i class="fa fa-eye"></i> Personal Details</h4>
				                    		<div class="row">
				                    			<div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Name : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Name" name="name" value="{{$personals->name}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Experience : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Experience" name="experience" value="{{$personals->experience}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Email1 : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Email1" name="email1" value="{{$personals->email1}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Email2 : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Email2" name="email2" value="{{$personals->email2}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Phone1 : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Phone1" name="phone1" value="{{$personals->phone1}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Phone2 : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Phone2" name="phone2" value="{{$personals->phone2}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Whatsapp : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Whatsapp" name="whatsapp" value="{{$personals->whatsapp}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">D.O.B : </label>
							                        	<div class="col-md-9">
														<input type="date" class="form-control border-primary" placeholder="dob" name="dob" value="{{ \Carbon\Carbon::parse($personals->dob)->format('Y-m-d') }}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Website : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Website" name="website" value="{{$personals->website}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Age : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Age" name="age" value="{{ $personals->age }}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Qualification : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Qualification" name="qualification" value="{{$personals->qualification }}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Location : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Location" name="location" value="{{$personals->location}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Map : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Map" name="map" value="{{$personals->map}}">
							                            </div>
							                        </div>
							                    </div>
												<div class="col-md-12">
													<div class="form-group row">
														<label class="col-md-3 label-control" for="userinput1">Freelance : <span class="danger">*</span></label>
														<div class="col-md-9">
															<select class="form-control select2" name="freelance">
																<option value="1" @if($personals->freelance == '1') selected @endif>Available</option>
																<option value="0" @if($personals->freelance == '0') selected @endif>Not Available</option>
															</select>
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