@extends('admin.template.master') 
@section('title', $title)
@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Technologies</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.technology.index') }}">Technologies List</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Technology
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route('admin.technology.index') }}">
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
                        <h4 class="card-title" id="horz-layout-colored-controls">Technologies</h4>
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
                            <form action="{{ route('admin.technology.update', $techData->slug) }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
                                @csrf()
                                <div class="form-body">
                                    <h4 class="form-section"><i class="fa fa-eye"></i> Edit Technology</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="userinput1">Title : <span class="danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" id="userinput1" class="form-control border-primary" placeholder="Title" name="title" value="{{ $techData->title }}" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="icon-input">Icon : <span class="danger">*</span></label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="fa fa-image"></i></span>
                                                        <input type="text" id="icon-input" class="form-control border-primary" placeholder="Icon (e.g., fa-camera)" name="icon" value="{{ $techData->icon }}" required="">
                                                    </div>
                                                    <small class="form-text text-muted">Enter the icon class name (e.g., fa-camera, fa-laptop, etc.)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                		<div class="col-md-12">
                                            <div class="form-group row">
                                            	<label class="col-md-3 label-control" for="userinput1">Description : <span class="danger">*</span></label>
                                            	<div class="col-md-9">
                                                	<input type="text" id="userinput1" class="form-control border-primary" placeholder="Description" name="description" value="{{ $techData->description }}" required="">
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
                                                	    <option value="1" @if($techData->status == '1') selected @endif>Active</option>
                                                	    <option value="0" @if($techData->status == '0') selected @endif>Inactive</option>
                                                	</select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                		<div class="col-md-12">
                                            <div class="form-group row">
                                            	<label class="col-md-3 label-control" for="userinput1">Order : <span class="danger">*</span></label>
                                            	<div class="col-md-9">
                                                	<input type="number" id="userinput1" class="form-control border-primary" placeholder="Order" name="orderby" value="{{ $techData->orderby }}" required="">
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