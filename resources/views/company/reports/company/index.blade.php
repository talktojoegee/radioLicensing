@extends('layouts.master-layout')
@section('current-page')
    Company Report
@endsection
@section('extra-styles')

    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')

    <div class="container-fluid">
        <div class="row">
            @if($search == 0)
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        {!! session()->get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @include('company.reports.company._search-form')
            @else
                @include('company.reports.company._search-form')
                <div class="row">
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-1">
                                    <div class="col">
                                        <p class="mb-1">All-time</p>

                                        <h5 class="mb-0 number-font">{{ number_format($records->count()) }}</h5>
                                    </div>
                                    <div class="col-auto mb-0">
                                        <div class="dash-icon text-secondary1">
                                            <i class="bx bxs-briefcase-alt-2"></i>
                                        </div>
                                    </div>
                                </div>
                                <span class="fs-12 text-muted"> <span class="text-muted fs-12 ml-0 mt-1">Overall </span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6" >
                        <div class="card" >
                            <div class="card-body" >
                                <div class="row mb-1" >
                                    <div class="col" >
                                        <p class="mb-1">Active</p>
                                        <h5 class="mb-0 number-font">{{number_format( $records->where('account_status', '=',1)->count() )}}</h5>
                                    </div>
                                    <div class="col-auto mb-0" >
                                        <div class="dash-icon text-orange" >
                                            <i class="bx bxs-book-open"></i>
                                        </div>
                                    </div>
                                </div>
                                <span class="fs-12 text-muted"> <span class="text-muted fs-12 ml-0 mt-1">Total Active</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6" >
                        <div class="card" >
                            <div class="card-body" >
                                <div class="row mb-1" >
                                    <div class="col" >
                                        <p class="mb-1">Expired</p>
                                        <h5 class="mb-0 number-font">{{number_format( $records->where('account_status',2)->count() )}}</h5>
                                    </div>
                                    <div class="col-auto mb-0" >
                                        <div class="dash-icon text-secondary" >
                                            <i class="bx bx-check-double"></i>
                                        </div>
                                    </div>
                                </div>
                                <span class="fs-12 text-muted">  <span class="text-muted fs-12 ml-0 mt-1">Total Expired</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title"> Company Report</h4>
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                <span class="d-none d-sm-block">Company Report</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content p-3 text-muted">
                                        <div class="tab-pane active" id="home1" role="tabpanel">
                                            <div class="row mt-4">
                                                <div class="col-md-12 col-lg-12">
                                                    @if(session()->has('success'))
                                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                            <i class="mdi mdi-check-all me-2"></i>
                                                            {!! session()->get('success') !!}
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    @endif
                                                        @if(session()->has('error'))
                                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                            <i class="mdi mdi-check-all me-2"></i>
                                                            {!! session()->get('error') !!}
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

                                                        <form action="#" method="#">
                                                        @csrf
                                                        <input type="hidden" name="collectionFrom" value="{{$from}}">
                                                        <input type="hidden" name="collectionTo" value="{{$to}}">
                                                        <p class="text-center">Showing company registration report between <code>{{date('d M, Y', strtotime($from))}}</code> to <code>{{date('d M, Y', strtotime($to))}}</code></p>

                                                            <div class="table-responsive mt-3">
                                                                <table id="datatable1" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="complex-header_info" style="width: 100%; margin:0px auto;">
                                                                    <thead style="position: sticky;top: 0">
                                                                    <tr role="row">
                                                                        <th class="sorting_asc text-left text-uppercase header" tabindex="0" >S/No.</th>
                                                                        <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Name</th>
                                                                        <th class="sorting_asc text-left text-uppercase header" tabindex="0" >RC. No.</th>
                                                                        <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Mobile No.</th>
                                                                        <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Email</th>
                                                                        <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Status</th>
                                                                        <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($records as $key => $record)
                                                                        <tr>
                                                                            <td>{{ $key + 1 }}</td>
                                                                            <td><a href="{{ route('show-company-profile', $record->slug) }}">{{ $record->organization_name ?? ''  }}</a> </td>
                                                                            <td>{{ $record->organization_code ?? ''  }}</td>
                                                                            <td>{{ $record->phone_no ?? ''  }}</td>
                                                                            <td>{{ $record->email ?? ''  }}</td>
                                                                            <td>
                                                                                @if($record->account_status == 1)
                                                                                    <span class="text-success">Active</span>
                                                                                @else
                                                                                    <span class="text-danger" style="color: #ff0000 !important;">Inactive</span>
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                <div class="btn-group">
                                                                                    <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                                                    <div class="dropdown-menu">
                                                                                        <a class="dropdown-item" target="_blank" href="{{ route('show-company-profile', $record->slug) }}" > <i class="bx bxs-book-open"></i> View</a>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection

@section('extra-scripts')
    <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="/assets/js/pages/datatables.init.js"></script>

@endsection
