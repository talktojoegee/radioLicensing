@extends('layouts.master-layout')
@section('current-page')
    Inflow Report
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
                @include('company.reports.inflow._search-form')
            @else
                @include('company.reports.inflow._search-form')
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title"> Inflow Report</h4>
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                <span class="d-none d-sm-block">Transactions</span>
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
                                                        <div class="row">
                                                            <div class="col-xxl-3 col-sm-6">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row mb-1">
                                                                            <div class="col">
                                                                                <p class="mb-2">Total Pending</p>
                                                                                <h5 class="mb-0 number-font text-warning">{{ env('APP_CURRENCY')  }}{{ number_format( $records->where('status',0)->sum('total') ,2) }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-3 col-sm-6">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row mb-1">
                                                                            <div class="col"> <p class="mb-2">Total Paid</p>
                                                                                <h5 class="mb-0 number-font text-info" >{{ env('APP_CURRENCY')  }}{{number_format($records->where('status',1)->sum('amount_paid'),2) }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-3 col-sm-6">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row mb-1">
                                                                            <div class="col"> <p class="mb-2">Total Verified</p>
                                                                                <h5 class="mb-0 number-font text-success">{{ env('APP_CURRENCY')  }}{{number_format($records->where('status',2)->sum('amount_paid'),2) }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xxl-3 col-sm-6">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row mb-1">
                                                                            <div class="col"> <p class="mb-2"> Total Declined</p>
                                                                                <h5 class="mb-0 number-font text-danger" style="color: #ff0000 !important;">{{ env('APP_CURRENCY')  }}{{ number_format($records->where('status',3)->sum('total'),2) ?? 0 }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <form action="#" method="#">
                                                        @csrf
                                                        <input type="hidden" name="collectionFrom" value="{{$from}}">
                                                        <input type="hidden" name="collectionTo" value="{{$to}}">
                                                        <p class="text-center">Showing inflow report between <code>{{date('d M, Y', strtotime($from))}}</code> to <code>{{date('d M, Y', strtotime($to))}}</code></p>
                                                        <div class="table-responsive mt-3">
                                                            <table id="complex-header" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="complex-header_info" style="width: 100%; margin:0px auto;">
                                                                <thead style="position: sticky;top: 0">
                                                                <tr role="row">
                                                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0" >S/No.</th>
                                                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Date</th>
                                                                    @if(\Illuminate\Support\Facades\Auth::user()->type == 1)
                                                                        <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Generated By</th>
                                                                    @endif
                                                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Ref. Code</th>
                                                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0" style="text-align: right">Amount({{env('APP_CURRENCY')}})</th>
                                                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Status</th>
                                                                    <th class="sorting_asc text-left text-uppercase header" tabindex="0" >Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($records as $key => $flow)
                                                                    <tr role="row" class="odd">
                                                                        <td class="">{{$key + 1}}</td>
                                                                        <td class="sorting_1 text-left">{{ date('d M, Y', strtotime($flow->created_at)) }}</td>
                                                                        @if(\Illuminate\Support\Facades\Auth::user()->type == 1)
                                                                            <td class="">
                                                                                {{$flow->getAuthor->title ?? '' }} {{$flow->getAuthor->first_name ?? '' }} {{$flow->getAuthor->last_name ?? '' }} {{$flow->getAuthor->other_names ?? '' }}
                                                                            </td>
                                                                        @endif
                                                                        <td class="">{{$flow->ref_no ?? ''}}</td>
                                                                        <td class="" style="text-align: right">{{number_format($flow->total,2)}}</td>
                                                                        <td class="">
                                                                            @switch($flow->status)
                                                                                @case(0)
                                                                                <span class="text-info">Pending</span>
                                                                                @break
                                                                                @case(1)
                                                                                <span class="text-info">Paid</span>
                                                                                @break
                                                                                @case(2)
                                                                                <span class="text-success">Verified</span>
                                                                                @break
                                                                                @case(3)
                                                                                <span class="text-danger" style="color: #ff0000;">Declined</span>
                                                                                @break
                                                                            @endswitch
                                                                        </td>
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item" target="_blank" href="{{route('show-invoice-detail', $flow->ref_no)}}" > <i class="bx bxs-book-open"></i> View</a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

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
