@extends('admin.template.master') 
@section('title', $title)
@section('content')

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Blogs</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blogs List</a>
                            </li>
                            <li class="breadcrumb-item active">Add Blog
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-right">
				<a href="{{ route('admin.blog.index') }}">
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
				                <h4 class="card-title" id="horz-layout-colored-controls">Blogs</h4>
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

									<form action="{{ route('admin.blog.store') }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
										@csrf()
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="fa fa-eye"></i> Add Blog</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="userinput1">Title : <span class="danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="userinput1" class="form-control border-primary" placeholder="Title" name="title" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="userinput1">Short Description : <span class="danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="userinput1" class="form-control border-primary" placeholder="Short Description" name="short_description" required="">
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
                                                        <label class="col-md-3 label-control" for="userinput3"> Description <span class="text-danger">*</span> :</label>
                                                        <div class="col-md-9">      
                                                            <textarea class="summernote" name="description"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="userinput1">Category : <span class="danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <select name="category" class="form-control select2"> 
                                                                <option>--Select--</option>
                                                                @foreach($categories as $s)
                                                                    <option value="{{ $s->id }}">{{ $s->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="userinput1">Tag : <span class="danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <select name="tag" class="form-control select2"> 
                                                                <option>--Select--</option>
                                                                @foreach($tags as $s)
                                                                    <option value="{{ $s->id }}">{{ $s->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="userinput1">Blog Image : <span class="danger">*</span></label>
                                                        <div class="col-md-9">
                                                            <input type="file" name="image" id="imageUpload" class="hide"> 
                                                            <label for="imageUpload" class="upload-poster mr-5">Select file</label> Max Size 2 mb<br>
                                                            <img src="{{ asset('assets/admin/images/dummy-logo.jpg')}}" id="imagePreview" class="organisation-logo" alt="Your image will appear here.">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="userinput1">Credit : </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="userinput1" class="form-control border-primary" placeholder="Credit" name="credit">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="userinput1">Credit URL :</label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="userinput1" class="form-control border-primary" placeholder="Credit URL" name="credit_url">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="userinput1">Order :</label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="userinput1" class="form-control border-primary" placeholder="Order" name="orderby">
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
                                                        	    <option value="1">Active</option>
                                                        	    <option value="0">Inactive</option>
                                                        	</select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="userinput1">Featured :</label>
                                                    <div class="col-md-9">
                                                        <input type="checkbox" id="userinput1" name="featured">
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
@endsection