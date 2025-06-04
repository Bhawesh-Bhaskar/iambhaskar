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
                            <li class="breadcrumb-item active">Reply Ticket
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
									<form action="{{ route('admin.ticket.reply.store', $ticketData->id) }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
										@csrf()
                                        <div class="form-body">
                                        	<h4 class="form-section"><i class="fa fa-eye"></i>Reply Ticket</h4>                                        	
                                            <div class="row">
                                        		<div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <span class="badge badge-warning badge-lg mr-3">Ticket Id : {{ $ticketData->code }}</span>
                                                            <span class="badge badge-info badge-lg mr-3">Priority : {{ $ticketData->priority }}</span>
                                                            <span class="badge badge-primary badge-lg mr-3">Type : {{ $ticketData->type }}</span>
                                                            <span class="badge badge-success badge-lg mr-3">Assignee : {{ optional(App\Models\Admin::find($ticketData->assignee))->name ?? 'Deleted' }}</span>
                                                            <span class="badge badge-danger badge-lg mr-3">Ticket Status : {{ $ticketData->status }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                        		<div class="col-md-12">
                                                    <div class="form-group row mb-0">
                                                    	<h3 class="col-md-12 label-control text-left" for="subject">Subject : {{ $ticketData->subject }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
											<div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" style="display: none;">
                                                        <button id="edit"></button>
                                                        <button id="save"></button>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="message"> Message <span class="text-danger">*</span> :</label>
                                                        <div class="col-md-9">      
                                                            <textarea class="summernote" name="message"></textarea>
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
                                                            <img src="{{ asset('assets/admin/images/dummy-logo.jpg')}}" id="imagePreview" class="organisation-logo" alt="Your image will appear here.">
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
				                                <i class="fa fa-check-square-o"></i> Reply
				                            </button>
				                        </div>
				                    </form>
				                </div>

                                <div class="card-body">
                                    <div class="form-body">
                                        <h2 class="form-section text-center">Conversations</h2>
                                        <div class="chat-container">
                                            <div class="row mb-0">
                                                <div class="col-md-12">
                                                    <div class="chat-message user">
                                                        <div class="d-flex align-items-start">
                                                            <img src="{{ asset('assets/admin/images/dummy-logo.jpg')}}" alt="Admin" class="chat-user-avatar">
                                                            <div class="chat-message-content">
                                                                <p>{!! $ticketData->message !!}</p>
                                                                <span class="message-time">{{ $ticketData->created_at->format('d M, Y H:i') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @foreach($ticket_replies as $ticket_reply)
                                                <div class="row mb-0">
                                                    <div class="col-md-12 @if($ticket_reply->user_type == 'admin') text-right @else text-left @endif">
                                                        <div class="chat-message @if($ticket_reply->user_type == 'admin') admin @else user @endif">
                                                            <div class="d-flex @if($ticket_reply->user_type == 'admin') flex-row-reverse @else flex-row @endif align-items-start">
                                                                <img src="{{ $ticket_reply->user_type == 'admin' ? asset('assets/admin/images/dummy-logo.jpg') : asset('assets/admin/images/dummy-logo.jpg') }}" alt="User" class="chat-user-avatar">
                                                                <div class="chat-message-content">
                                                                    <p>{!! $ticket_reply->message !!}</p>
                                                                    <span class="message-time">{{ $ticket_reply->created_at->format('d M, Y H:i') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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