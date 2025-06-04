@extends('admin.template.master')
@section('title', 'Dashboard')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Dashboard</h3>
                <div class="row breadcrumbs-top d-inline-block">
                  <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                      </li>
                      <li class="breadcrumb-item active">Dashboard
                      </li>
                    </ol>
                  </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                        <div class="pb-1">
                                            <div class="clearfix mb-1">
                                                <i class="icon-star font-large-1 blue-grey float-left mt-1"></i>
                                                <span class="font-large-2 text-bold-300 info float-right">{{ $admins }}</span>
                                            </div>
                                            <div class="clearfix">
                                                <span class="text-muted">Admins</span>
                                            </div>
                                        </div>
                                        <div class="progress mb-0" style="height: 7px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                        <div class="pb-1">
                                            <div class="clearfix mb-1">
                                                <i class="icon-user font-large-1 blue-grey float-left mt-1"></i>
                                                <span class="font-large-2 text-bold-300 danger float-right">{{ $users }}</span>
                                            </div>
                                            <div class="clearfix">
                                                <span class="text-muted">Users</span>
                                            </div>
                                        </div>
                                        <div class="progress mb-0" style="height: 7px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
          <section id="advance-examples">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                              <h4 class="card-title">Dashboard</h4>
                              <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                              <div class="heading-elements">
                                  <ul class="list-inline mb-0">
                                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                                  </ul>
                              </div>
                          </div>
                          <div class="card-content collapse show">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col-md-12">
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