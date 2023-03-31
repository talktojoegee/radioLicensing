@extends('layouts.master-layout')
@section('current-page')
    Appointment Report
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/nprogress.css">
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/parsley.css" rel="stylesheet" type="text/css" />
    <style>
        .fs-22{
            font-size: 22px;
        }
    </style>
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            @if($search == 0)
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col">
                                    <p class="mb-2">Appointments</p>
                                    <h3 class="mb-0 number-font">{{number_format($overall)}}</h3>
                                </div>
                                <div class="col-auto mb-0">
                                    <div class="dash-icon text-orange"> <i class="bx bxs-timer text-success fs-22" ></i></div>
                                </div>
                            </div>
                            <span class="fs-12 text-success"> <strong>Overall</strong> </span>
                            <span class="text-muted fs-12 ms-0 mt-1">Appointments </span>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col"> <p class="mb-2">Appointments</p><h3 class="mb-0 number-font"> {{number_format($appointments->count()) }}</h3> </div>
                                <div class="col-auto mb-0">
                                    <div class="dash-icon text-secondary1"> <i class="bx bxs-timer text-warning fs-22"></i> </div>
                                </div>
                            </div>
                            <span class="fs-12 text-warning"> <strong>Current Year</strong>  </span>
                            <span class="text-muted fs-12 ms-0 mt-1">Appointments </span>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col">
                                    <p class="mb-2">Appointments</p>
                                    <h3 class="mb-0 number-font">{{number_format($overall)}}</h3>
                                </div>
                                <div class="col-auto mb-0">
                                    <div class="dash-icon text-orange"> <i class="bx bxs-timer text-success fs-22" ></i></div>
                                </div>
                            </div>
                            <span class="fs-12 text-success"> <strong>Overall</strong> </span>
                            <span class="text-muted fs-12 ms-0 mt-1">Appointments </span>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col"> <p class="mb-2">Appointments</p><h3 class="mb-0 number-font"> {{number_format($appointments->count()) }}</h3> </div>
                                <div class="col-auto mb-0">
                                    <div class="dash-icon text-secondary1"> <i class="bx bxs-timer text-warning fs-22"></i> </div>
                                </div>
                            </div>
                            @if($filterType == 2)
                            <span class="fs-12"> <strong class="text-success">From:</strong>  {{date('d M, Y', strtotime($from))}}</span>
                            <span class="fs-12 ms-0 mt-1"><strong class="text-danger ">To:</strong>  {{date('d M, Y', strtotime($to))}}</span>
                            @else
                                <span class="fs-12 text-warning"> <strong>All Time</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header col-md-4 offset-md-4 mt-4">
                        <form action="{{route('filter-appointment-reports')}}" class="" method="get">
                            @csrf
                            <div class="form-group">
                                <label for="" class="text-muted">Filter</label>
                                <select name="filterType" id="filterType" class="form-control">
                                    <option value="1">All</option>
                                    <option value="2">Date Range</option>
                                </select>
                                @error('filterType') <i class="text-danger">{{$message}}</i> @enderror
                            </div>
                            <div class="form-group mt-3 dateInputs">
                                <label for="" class="text-success">From</label>
                                <input type="date" class="form-control" name="from">
                                @error('from') <i class="text-danger">{{$message}}</i> @enderror
                            </div>
                            <div class="form-group mt-3 dateInputs">
                                <label for="" class="text-danger">To</label>
                                <input type="date" class="form-control" name="to">
                                @error('to') <i class="text-danger">{{$message}}</i> @enderror
                            </div>
                            <div class="mt-3 form-group d-flex justify-content-center">
                                <button class="btn btn-primary btn-sm">Submit <i class="bx bx-filter"></i> </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">

                        <h4 class="card-title">All Appointments</h4>
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
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th class="">#</th>
                                            <th class="wd-15p">Client</th>
                                            <th class="wd-15p">Date & Time</th>
                                            <th class="wd-15p">Type</th>
                                            <th class="wd-15p">Contact</th>
                                            <th class="wd-15p">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $index = 1; @endphp
                                        @foreach($appointments as $appoint)
                                            <tr>
                                                <td>{{$index++}}</td>
                                                <td>
                                                    @if($appoint->session_type != 3)
                                                        @foreach($appoint->getInvitees->take(1) as $invite)
                                                            {{$invite->getClient->first_name ?? ''  }}  {{$invite->getClient->last_name ?? ''  }}
                                                        @endforeach
                                                        @if($appoint->getInvitees->count() > 1)
                                                            <small class="badge rounded-pill bg-info">+{{$appoint->getInvitees->count() - 1}} others</small>
                                                        @endif
                                                    @else
                                                        <span class="text-warning">Block Session</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if($appoint->session_type != 3)
                                                        {{date('d M, Y', strtotime($appoint->event_date))}} <u class="text-info">{{date('h:ia', strtotime($appoint->event_date))}}</u>
                                                    @else
                                                        <p>
                                                            <strong>From: </strong>{{date('d M, Y', strtotime($appoint->event_date))}} <u class="text-info">{{date('h:ia', strtotime($appoint->event_date))}}</u>
                                                            <strong>To: </strong>{{date('d M, Y', strtotime($appoint->end_date))}} <u class="text-info">{{date('h:ia', strtotime($appoint->end_date))}}</u>
                                                        </p>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if($appoint->session_type != 3)
                                                        {{$appoint->getAppointmentType->name ?? '' }}
                                                    @else
                                                        <span class="text-warning">Block Session</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($appoint->session_type != 3)
                                                        @switch($appoint->contact_type)
                                                            @case(1)
                                                            Video Call
                                                            @break
                                                            @case(2)
                                                            In Person
                                                            @break
                                                            @case(3)
                                                            Phone Call
                                                            @break
                                                        @endswitch
                                                    @else
                                                        <span class="text-warning">Block Session</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($appoint->session_type != 3)
                                                        @switch($appoint->status)
                                                            @case(1)
                                                            <label for="" class="badge badge-soft-primary">Booked</label>
                                                            @break
                                                            @case(2)
                                                            <label for="" class="badge badge-soft-success">Confirmed</label>
                                                            @break
                                                            @case(3)
                                                            <label for="" class="badge-soft-danger badge">Cancelled</label>
                                                            @break
                                                            @case(4)
                                                            <label for="" class="badge badge-soft-warning">Repeat</label>
                                                            @break
                                                        @endswitch
                                                    @else
                                                        <span class="text-warning">Block Session</span>
                                                    @endif
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
@endsection

@section('extra-scripts')
    <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/js/pages/datatables.init.js"></script>


    <script src="/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/libs/jszip/jszip.min.js"></script>
    <script src="/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>


    <script src="/js/parsley.js"></script>
    <script>
        $(document).ready(function(){
            $('.dateInputs').hide();
            $('#filterType').on('change', function(e){
                e.preventDefault();
                if($(this).val() == 1){
                    $('.dateInputs').hide();
                }else{
                    $('.dateInputs').show();
                }
            });
        });
    </script>
@endsection
