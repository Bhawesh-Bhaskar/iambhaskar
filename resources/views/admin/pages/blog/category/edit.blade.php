@extends('admin.template.master') 
@section('title', $title)
@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Blog Categories</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.blogcategory.index') }}">Blog Categories</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Blog Category
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <a href="{{ route('admin.blogcategory.index') }}">
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
                        <h4 class="card-title" id="horz-layout-colored-controls">Blog Categories</h4>
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

                            <form action="{{ route('admin.blogcategory.update', $blogcatData->slug) }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
                                @csrf()
                              
                                <div class="form-body">
                                    <h4 class="form-section"><i class="fa fa-eye"></i> Edit Blog Category</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">Title : <span class="danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" id="userinput1" class="form-control border-primary" placeholder="Title" name="title" value="{{ $blogcatData->title }}" required="">
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
                                                	    <option value="1" @if($blogcatData->status == '1') selected @endif>Active</option>
                                                	    <option value="0" @if($blogcatData->status == '0') selected @endif>Inactive</option>
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