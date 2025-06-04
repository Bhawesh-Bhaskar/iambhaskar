@extends('admin.template.master') 
@section('title', $title)
@section('content')

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			<div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
				<h3 class="content-header-title mb-0 d-inline-block">SEO Details</h3>
				<div class="row breadcrumbs-top d-inline-block">
					<div class="breadcrumb-wrapper col-12">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
							</li>
							<li class="breadcrumb-item active">SEO Details
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
				                <h4 class="card-title" id="horz-layout-colored-controls">SEO Details</h4>
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

									<form action="{{ route('admin.seo.update') }}" method="post" enctype="multipart/form-data" class="form form-horizontal">
										@csrf()
				                    	<div class="form-body">
				                    		<h4 class="form-section"><i class="fa fa-eye"></i> SEO Details</h4>
				                    		<div class="row">
				                    			<div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Title : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Title" name="seo_title" value="{{$seo_details->seo_title}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Description : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Description" name="seo_description" value="{{$seo_details->seo_description}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Keywords : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Keywords" name="seo_keywords" value="{{$seo_details->seo_keywords}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Canonical Link : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Canonical Link" name="canonical" value="{{$seo_details->canonical}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Blog Title : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Blog Title" name="blog_seo_title" value="{{$seo_details->blog_seo_title}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Blog Description : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Blog Description" name="blog_seo_description" value="{{$seo_details->blog_seo_description}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Blog Keywords : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Blog Keywords" name="blog_seo_keywords" value="{{$seo_details->blog_seo_keywords}}">
							                            </div>
							                        </div>
							                    </div>
							                    <div class="col-md-12">
							                        <div class="form-group row">
							                        	<label class="col-md-3 label-control">Blog Canonical Link : </label>
							                        	<div class="col-md-9">
							                            	<input type="text" class="form-control border-primary" placeholder="Blog Canonical Link" name="blog_canonical" value="{{$seo_details->blog_canonical}}">
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