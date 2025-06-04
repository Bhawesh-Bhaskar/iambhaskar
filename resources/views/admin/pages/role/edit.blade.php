@extends('admin.template.master') 
@section('title', $title)
@section('content')

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
				<h3 class="content-header-title mb-0 d-inline-block">Roles</h3>
				<div class="row breadcrumbs-top d-inline-block">
					<div class="breadcrumb-wrapper col-12">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
							</li>
							<li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles List</a>
							</li>
							<li class="breadcrumb-item active">Edit Role
							</li>
						</ol>
					</div>
				</div>
            </div>
			<div class="col-md-4 text-right">
				<a href="{{ route('admin.roles.index') }}">
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
				                <h4 class="card-title" id="horz-layout-colored-controls">Roles</h4>
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
									<form action="{{ route('admin.roles.update',$roleData->id ) }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
										@csrf()
                                        <div class="form-body">
                                        	<h4 class="form-section"><i class="fa fa-eye"></i> Edit Role</h4>
                                        	<div class="row">
                                        		<div class="col-md-12">
                                                    <div class="form-group row">
                                                    	<label class="col-md-3 label-control" for="name">Name : <span class="danger">*</span></label>
                                                    	<div class="col-md-9">
                                                        	<input type="text" id="name" class="form-control border-primary" placeholder="Name" name="name" value="{{ $roleData->name }}" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											<div class="row">
                                        		<div class="col-md-12">
                                                    <div class="form-group row">
                                                    	<label class="col-md-3 label-control" for="display_name">Display Name : <span class="danger">*</span></label>
                                                    	<div class="col-md-9">
                                                        	<input type="text" id="display_name" class="form-control border-primary" placeholder="Display Name" name="display_name" value="{{ $roleData->display_name }}" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                        		<div class="col-md-12">
                                                    <div class="form-group row">
                                                    	<label class="col-md-3 label-control" for="description">Description : <span class="danger">*</span></label>
                                                    	<div class="col-md-9">
                                                        	<input type="text" id="description" class="form-control border-primary" placeholder="Description" name="description" value="{{ $roleData->description }}" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											<div class="row">
                                        		<div class="col-md-12">
                                                    <div class="form-group row">
                                                    	<label class="col-md-3 label-control" for="user_type">User Type : <span class="danger">*</span></label>
                                                    	<div class="col-md-9">
                                                        	<select class="form-control select2" name="user_type">
                                                        	    <option value="Admin" @if($roleData->user_type == 'Admin') selected @endif>Admin</option>
                                                        	    <option value="User" @if($roleData->user_type == 'User') selected @endif>User</option>
                                                        	</select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                        		<div class="col-md-12">
                                                    <div class="form-group row">
                                                    	<label class="col-md-3 label-control" for="status">Status : <span class="danger">*</span></label>
                                                    	<div class="col-md-9">
                                                        	<select class="form-control select2" name="status">
                                                        	    <option value="1" @if($roleData->status == '1') selected @endif>Active</option>
                                                        	    <option value="0" @if($roleData->status == '0') selected @endif>Inactive</option>
                                                        	</select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group row">
													<label class="col-md-3 label-control" for="permissions">Permissions : <span class="danger">*</span></label>
													<div class="col-md-9">
														<div class="form-group row">
															<table class="table table-striped table-bordered dataex-html5-export">
																<thead>
																	<tr>
																		<th>Permissions</th>
																		<th>View</th>
																		<th>Add</th>
																		<th>Edit</th>
																		<th>Delete</th>
																	</tr>
																</thead>
																<tbody>
																	@php
																		$i=0;
																	@endphp

																	@foreach ($perm as $key => $value)
																		<tr data-rel="{{$i}}">
																			<td>{{ $key }}</td>
																			@foreach ($value as $i => $v)
																				<input type="hidden" value="{{ $v['user_type'] }}" name="user_type" id="user_type">
																				<input type="hidden" value="{{ $roleData->id }}" name="id" id="id">
																				@if (isset($v['display_name']))
																					<td>
																						<label class="checkbox-container">
																							<input type="checkbox" name="permission[]" id="{{'view_'.$i}}" value="{{ $v['id'] }}"  {{ in_array( $v['id'], $stored_permissions) ? 'checked' : '' }} class="{{ ($i % 4 == 0) ? 'view_checkbox' :'other_checkbox' }}">
																							<span class="checkmark"></span>
																						</label>
																					</td>
																				@else
																					<td></td>
																				@endif
																			@endforeach	
																		</tr>
																		@php
																			$i++;
																		@endphp													
																	@endforeach 						 
																</tbody>
															</table>
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