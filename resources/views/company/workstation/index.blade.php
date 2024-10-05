@extends('layouts.master-layout')
@section('title')
    Locations
@endsection
@section('current-page')
    Locations
@endsection
@section('extra-styles')
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <style>
        .text-danger{
            color: #ff0000 !important;
        }
    </style>
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('show-create-workstation') }}"  class="btn btn-primary  mb-3">Add Location <i class="bx bx bx-highlight"></i> </a>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="modal-header">Locations</h4>

                                <!-- Tab panes -->
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="home1" role="tabpanel">
                                        <div class="row mt-4">
                                            <div class="col-xxl-6 col-sm-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row mb-1">
                                                            <div class="col">
                                                                <p class="mb-2">Location</p>
                                                                <h5 class="mb-0 number-font">{{number_format($stations->where('status',1)->count())}}</h5>
                                                            </div>
                                                            <div class="col-auto mb-0">
                                                                <div class="dash-icon text-orange"> <i class="bx bx-broadcast text-success fs-22"></i></div>
                                                            </div>
                                                        </div>
                                                        <span class="fs-12 text-success"> <strong>Active</strong> </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-sm-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row mb-1">
                                                            <div class="col"> <p class="mb-2">Workstations</p><h5 class="mb-0 number-font">{{number_format($stations->where('status',0)->count())}}</h5> </div>
                                                            <div class="col-auto mb-0">
                                                                <div class="dash-icon text-secondary1"> <i class="bx bx-broadcast text-warning fs-22"></i> </div>
                                                            </div>
                                                        </div>
                                                        <span class="fs-12 text-warning"> <strong>Inactive</strong>  </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <h4 class="card-title">Manage Workstations</h4>
                                            <p>Here is a list of all your registered workstations.</p>
                                            @if(session()->has('success'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <i class="mdi mdi-check-all me-2"></i>
                                                    {!! session()->get('success') !!}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif
                                            @if($errors->any())
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <i class="mdi mdi-close me-2"></i>
                                                    @foreach($errors->all() as $error)
                                                        <li>{{$error}}</li>
                                                    @endforeach
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif


                                            <div class="row">
                                                <div class="col-md-12 col-lx-12">
                                                    <div class="table-responsive mt-3">
                                                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                            <thead>
                                                            <tr>
                                                                <th class="">#</th>
                                                                <th class="wd-15p">Date</th>
                                                                <th class="wd-15p">Name</th>
                                                                <th class="wd-15p">Long.</th>
                                                                <th class="wd-15p">Lat.</th>
                                                                <th class="wd-15p">Location</th>
                                                                <th class="wd-15p">Status</th>
                                                                <th class="wd-15p">Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($stations as $key=> $station)
                                                                <tr>
                                                                    <td>{{$key +1}}</td>
                                                                    <td>{{ date('d M, Y', strtotime($station->created_at)) }}</td>
                                                                    <td>{{ $station->name ?? '' }}</td>
                                                                    <td>{{ $station->long ?? '' }}</td>
                                                                    <td>{{ $station->lat ?? '' }}</td>
                                                                    <td>{{ $station->getLocation->name ?? '' }}</td>
                                                                    <td>
                                                                        @if($station->status == 1)
                                                                            <span class="text-success">Active</span>
                                                                        @else
                                                                            <span class="text-danger">Inactive</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                                            <div class="dropdown-menu">
                                                                                <a class="dropdown-item" href="{{route('show-workstation-details', $station->slug)}}" > <i class="bx bxs-book-open"></i> View</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra-scripts')
    <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="/assets/js/pages/datatables.init.js"></script>
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
