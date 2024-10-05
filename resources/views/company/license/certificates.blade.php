@extends('layouts.master-layout')
@section('title')
    {{ $title ?? '' }}Certificates
@endsection
@section('current-page')
    {{ $title ?? '' }}Certificates
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
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-1">
                            <div class="col">
                                <p class="mb-1">Total</p>
                                <h5 class="mb-0 number-font">{{ number_format($certificates->count()) }}</h5>
                            </div>
                            <div class="col-auto mb-0">
                                <div class="dash-icon text-secondary1">
                                    <i class="bx bx-certification"></i>
                                </div>
                            </div>
                        </div>
                        <span class="fs-12 text-muted"> <span class="text-muted fs-12 ml-0 mt-1">Overall Requests</span></span>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6" >
                <div class="card" >
                    <div class="card-body" >
                        <div class="row mb-1" >
                            <div class="col" >
                                <p class="mb-1">Expired</p>
                                <h5 class="mb-0 number-font">{{number_format($certificates->where('status',2)->count())}}</h5>
                            </div>
                            <div class="col-auto mb-0" >
                                <div class="dash-icon text-orange" >
                                    <i class="bx bx-certification"></i>
                                </div>
                            </div>
                        </div>
                        <span class="fs-12 text-muted"> <span class="text-muted fs-12 ml-0 mt-1">Total Expired</span></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6" >
                <div class="card" >
                    <div class="card-body" >
                        <div class="row mb-1" >
                            <div class="col" >
                                <p class="mb-1">Active</p>
                                <h5 class="mb-0 number-font">{{number_format( $certificates->where('status',1)->count() )}}</h5>
                            </div>
                            <div class="col-auto mb-0" >
                                <div class="dash-icon text-secondary" >
                                    <i class="bx bx-certification"></i>
                                </div>
                            </div>
                        </div>
                        <span class="fs-12 text-muted">  <span class="text-muted fs-12 ml-0 mt-1">Total Active</span></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6" >
                <div class="card" >
                    <div class="card-body" >
                        <div class="row mb-1" >
                            <div class="col" >
                                <p class="mb-1">Renewed</p>
                                <h3 class="mb-0 number-font">{{number_format( $certificates->where('status',3)->count() )}}</h3>
                            </div>
                            <div class="col-auto mb-0" >
                                <div class="dash-icon text-warning" >
                                    <i class="bx bx-certification"></i>
                                </div>
                            </div>
                        </div>
                        <span class="fs-12 text-muted">  <span class="text-muted fs-12 ml-0 mt-1">Total Renewed </span></span>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body">
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



                        <div class="table-responsive mt-3">
                            <table id="datatable1" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="complex-header_info" style="width: 100%; margin:0px auto;">
                                <thead style="position: sticky;top: 0">
                                <tr role="row">
                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0" >S/No.</th>
                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Start Date</th>
                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Expires</th>
                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Company</th>
                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0"  >Category</th>
                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0"  >Licence No.</th>
                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0"  >Call Sign</th>
                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0"  >Status</th>
                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($certificates as $key => $cert)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{ date('d M, Y', strtotime($cert->start_date)) }}</td>
                                            <td style="color: #ff0000 !important;">{{ date('d M, Y', strtotime($cert->expires_at)) }}</td>
                                            <td>{{ $cert->getCompany->organization_name ?? '' }}</td>
                                            <td>{{ $cert->getCategory->getParentCategory->name }}</td>
                                            <td>{{ $cert->license_no ?? '' }}/{{$cert->getCategory->getParentCategory->abbr}}/{{date('y', strtotime($cert->start_date))}}</td>
                                            <td>{{ $cert->call_sign ?? '' }}</td>
                                            <td>
                                                @switch($cert->status)
                                                    @case(1)
                                                    <span class="text-success">Active</span>
                                                    @break
                                                    @case(2)
                                                    <span class="text-danger" style="color: #ff0000 !important;">Expired</span>
                                                    @break
                                                    @case(3)
                                                    <span class="text-warning">Renewed</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('certificate-details', $cert->slug) }}" > <i class="bx bxs-book-open"></i> View</a>
                                                        @if((\Illuminate\Support\Facades\Auth::user()->type == 1)  && ($cert->status == 2)  )
                                                            <a class="dropdown-item" href="{{route('generate-renew-invoice', $cert->license_no)}}" > <i class="bx bx-purchase-tag"></i> Generate Invoice</a>
                                                        @endif
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



@endsection

@section('extra-scripts')


    <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="/assets/js/pages/datatables.init.js"></script>


@endsection
