@extends('admin.template.master') 
@section('title', $title)
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
				<h3 class="content-header-title mb-0 d-inline-block">Permissions</h3>
				<div class="row breadcrumbs-top d-inline-block">
					<div class="breadcrumb-wrapper col-12">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
							<li class="breadcrumb-item active">Permissions List</li>
						</ol>
					</div>
				</div>
            </div>
			<div class="col-md-4 text-right">
				<a href="{{ route('admin.permissions.create') }}">
					<button class="btn btn-primary"><i class="fa fa-plus"></i> Add Permission</button>
                </a>
			</div>
        </div>
        <div class="content-body">
	      <section id="html5">
	      	<div class="row">
	      		<div class="col-12">
	      			<div class="card">
	      				<div class="card-header">
	      					<h4 class="card-title">Permissions List</h4>
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
	      						<table class="table table-striped table-bordered dataex-html5-export">
	      							<thead>
	      								<tr>
	      									<th>S.No</th>
	      									<th>Group</th>
	      									<th>Display Name</th>
											<th>User Type</th>
											<th>Status</th>
	      								</tr>
	      							</thead>
	      							<tbody>
										@if(count($permissions) > 0)
											@foreach($permissions as $k=>$u)
												<tr>
													<td>{{ ++$k }}</td>
													<td>{{ $u->group }}</td>
													<td>{{ $u->display_name }}</td>
													<td>{{ $u->user_type }}</td>
													<td>
														@if($u->status == '1')
															<span class="badge badge-success">Active</span>
														@else
														    <span class="badge badge-warning">Inactive</span>
														@endif
													</td>
												</tr>
											@endforeach	 
										@else
										    <tr>
												<td colspan="6" class="text-center">No Permissions Found</td>
											</tr>
										@endif       								 
	      							</tbody>
	      						</table>				
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