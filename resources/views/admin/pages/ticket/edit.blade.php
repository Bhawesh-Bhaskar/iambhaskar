@extends('admin.template.master') 
@section('title', $title)
@section('content')

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Tickets</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.ticket.index') }}">Tickets List</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Ticket
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-right">
				<a href="{{ route('admin.ticket.index') }}">
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
				                <h4 class="card-title" id="horz-layout-colored-controls">Tickets</h4>
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
									<form action="{{ route('admin.ticket.update', $ticketData->slug) }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
										@csrf()
                                        <div class="form-body">
                                        	<h4 class="form-section"><i class="fa fa-eye"></i>Edit Ticket</h4>
                                        	<div class="row">
                                        		<div class="col-md-12">
                                                    <div class="form-group row">
                                                    	<label class="col-md-3 label-control" for="subject">Subject : <span class="danger">*</span></label>
                                                    	<div class="col-md-9">
                                                        	<input type="text" id="subject" class="form-control border-primary" placeholder="Subject" name="subject" value="{{ $ticketData->subject }}" required="">
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
                                                        <label class="col-md-3 label-control" for="message"> Message <span class="text-danger">*</span> :</label>
                                                        <div class="col-md-9">      
                                                            <textarea class="summernote" name="message">{{ $ticketData->message }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											<div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="userinput1">Image : <span class="danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <input type="file" name="image" id="imageUpload" class="hide"> 
                                                            <label for="imageUpload" class="upload-poster mr-5">Select file</label> Max Size 50 kb<br>
                                                            @if(trim($ticketData->image))
                                                                <img src="{{ asset('assets/img/tickets/'.$ticketData->image) }}" id="imagePreview" class="organisation-logo">
                                                            @else
                                                                <img src="{{ asset('assets/admin/images/dummy-logo.jpg')}}" id="imagePreview" class="organisation-logo" alt="Your image will appear here.">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                        		<div class="col-md-12">
                                                    <div class="form-group row">
                                                    	<label class="col-md-3 label-control" for="priority">Priority : <span class="danger">*</span></label>
                                                    	<div class="col-md-9">
                                                        	<select class="form-control select2" name="priority">
                                                        	    <option value="low" @if($ticketData->priority == 'low') selected @endif>Low</option>
                                                        	    <option value="medium" @if($ticketData->priority == 'medium') selected @endif>Medium</option>
																<option value="high" @if($ticketData->priority == 'high') selected @endif>High</option>
                                                        	</select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="type">Type : <span class="danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <select class="form-control select2" name="type">
                                                        	    <option value="bug" @if($ticketData->type == 'bug') selected @endif>Bug</option>
                                                        	    <option value="feature" @if($ticketData->type == 'feature') selected @endif>Feature</option>
																<option value="question" @if($ticketData->type == 'question') selected @endif>Question</option>
                                                        	</select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											<div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="userinput1">Status : <span class="danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <select class="form-control select2" name="status">
                                                        	    <option value="open" @if($ticketData->status == 'open') selected @endif>Open</option>
                                                        	    <option value="closed" @if($ticketData->status == 'closed') selected @endif>Closed</option>
																<option value="pending" @if($ticketData->status == 'pending') selected @endif>Pending</option>
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