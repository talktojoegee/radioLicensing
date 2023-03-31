@extends('layouts.master-layout')
@section('current-page')
    Practitioner Report
@endsection
@section('extra-styles')
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
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
            <div class="col-md-12 col-xxl-12 col-sm-12">
                <p>Use the form below to generate <code>practitioner</code> report.</p>
            </div>
            <div class="col-xxl-4 col-md-4 col-sm-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">Generate Practitioner Report</div>
                    <div class="card-header m-4">
                        <form action="{{route('filter-practitioner-report')}}" class="" method="get">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="" class="text-muted">Practitioner</label>
                                <select name="practitioner" id="practitioner" class="form-control select2">
                                    @foreach($practitioners as $practitioner)
                                        <option value="{{$practitioner->id}}">{{$practitioner->first_name ?? '' }} {{$practitioner->last_name ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('practitioner') <i class="text-danger">{{$message}}</i> @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="" class="text-muted">Feature</label>
                                <select name="feature" id="feature" class="form-control">
                                    <option value="1">Appointment</option>
                                    <option value="2">Revenue</option>
                                    <option value="3">Client</option>
                                </select>
                                @error('feature') <i class="text-danger">{{$message}}</i> @enderror
                            </div>
                            <div class="form-group mt-3">
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
                </div>
            </div>
            @if($search == 1)
                @if($feature == 2)
                    <div class="col-xxl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-1">
                                    <div class="col">
                                        <p class="mb-2">Total</p>
                                        <h5 class="mb-0 number-font">{{env('APP_CURRENCY')}}{{number_format($sales->sum('total'),2)}}</h5>
                                    </div>
                                    <div class="col-auto mb-0">
                                        <div class="dash-icon text-warning"> <i class="bx bxs-receipt text-info fs-22"></i> </div>
                                    </div>
                                </div>
                                <span class="text-muted fs-12 ms-0 mt-1">Revenue </span>
                            </div>
                        </div>
                    </div>
                @endif
                @if($feature == 3)
                    <div class="col-xxl-4 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-1">
                                    <div class="col">
                                        <p class="mb-2">Total</p>
                                        <h5 class="mb-0 number-font">{{number_format($clients->count())}}</h5>
                                    </div>
                                    <div class="col-auto mb-0">
                                        <div class="dash-icon text-warning"> <i class="bx bxs-receipt text-info fs-22"></i> </div>
                                    </div>
                                </div>
                                <span class="text-muted fs-12 ms-0 mt-1">Clients </span>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-xxl-4 col-md-4 col-sm-4">
                    <div class="card">
                    <div class="card-header bg-primary text-white">Profile Overview</div>
                    <div class="card-body">
                        <div class="mt-4 mt-md-0 d-flex justify-content-center">
                            <img class="img-thumbnail rounded-circle avatar-md" alt="200x200" src="{{url('storage/'.$user->image)}}" data-holder-rendered="true">
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                <tr>
                                    <td><strong>First Name:</strong></td>
                                    <td>{{$user->first_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Last Name:</strong></td>
                                    <td>{{$user->last_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{$user->email ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone No.:</strong></td>
                                    <td>{{$user->cellphone_no ?? '' }}</td>
                                </tr>
                                </tbody>
                            </table>
                           <div class="mt-3 d-flex justify-content-center">
                               <a target="_blank" href="{{route('user-profile', $user->slug)}}" class="btn btn-primary btn-sm">View Profile <i class="bx bx-user"></i> </a>
                           </div>
                        </div>
                    </div>
                </div>
                </div>
            @endif
        </div>
        <div class="row">
            @if($search == 1)
                @switch($feature)
                    @case(1)
                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Appointment Report <span class="badge rounded-pill bg-danger">{{number_format($appointments->count())}}</span></h4>
                                    <p>Showing result for {!!  $filterType == 1 ? "<span class='text-primary'>all appointments</span>" : "for appointments <span class='text-success'>From: </span>" .date('d M, Y', strtotime($from))."<span class='text-danger'> To: </span>".date('d M, Y', strtotime($to)) !!}</span>
                                    </p>
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
                    @break

                    @case(2)
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12 col-lx-12">
                                <h4 class="card-title">Revenue Table Report</h4>
                                <p>Showing result for {!!  $filterType == 1 ? "<span class='text-primary'>all revenue</span>" : "for revenue <span class='text-success'>From: </span>" .date('d M, Y', strtotime($from))."<span class='text-danger'> To: </span>".date('d M, Y', strtotime($to)) !!}</span>
                                </p>
                                <div class="table-responsive mt-3">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th class="">#</th>
                                            <th class="wd-15p">Date</th>
                                            <th class="wd-15p">Client</th>
                                            <th class="wd-15p">Total</th>
                                            <th class="wd-15p">Payment Method</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $index = 1; @endphp
                                        @foreach($sales as $sale)
                                            <tr>
                                                <td>{{$index++}}</td>
                                                <td>{{date('d M, Y', strtotime($sale->transaction_date))}}</td>
                                                <td>{{$sale->getClient->first_name ?? '' }} {{$sale->getClient->last_name ?? '' }}</td>
                                                <td style="text-align: right;">{{env('APP_CURRENCY')}}{{number_format($sale->sub_total ?? 0,2)}}</td>
                                                <td>
                                                    @switch($sale->payment_method)
                                                        @case(1)
                                                        Payment Card
                                                        @break
                                                        @case(2)
                                                        Bank Account
                                                        @break
                                                        @case(3)
                                                        Manual Payment
                                                        @break
                                                        @case(4)
                                                        Cash
                                                        @break
                                                        @case(5)
                                                        Cheque
                                                        @break
                                                        @case(6)
                                                        Referral Credit
                                                        @break
                                                        @case(6)
                                                        Internet
                                                        @break
                                                    @endswitch
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @break
                    @case(3)
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12 col-xl-12">
                                <h4 class="card-title">Client Table Report</h4>
                                <p>Showing result for {!!  $filterType == 1 ? "<span class='text-primary'>all clients</span>" : "for clients <span class='text-success'>From: </span>" .date('d M, Y', strtotime($from))."<span class='text-danger'> To: </span>".date('d M, Y', strtotime($to)) !!}</span>
                                </p>
                                <div class="table-responsive mt-3">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th class="">#</th>
                                            <th class="wd-15p">Name</th>
                                            <th class="wd-15p">Cellphone</th>
                                            <th class="wd-15p">Email</th>
                                            <th class="wd-15p">Group</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $index = 1; @endphp
                                        @foreach($clients->where('status',1) as $client)
                                            <tr>
                                                <td>{{$index++}}</td>
                                                <td>{{$client->first_name ?? '' }} {{$client->last_name ?? '' }}</td>
                                                <td>{{$client->mobile_no ?? '' }} </td>
                                                <td>{{$client->email ?? '' }} </td>
                                                <td><span class="badge rounded-pill bg-success float-end" key="t-new">{{$client->getClientGroup->group_name ?? '' }}</span> </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @break
                @endswitch
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

    <script src="/assets/libs/select2/js/select2.min.js"></script>
    <script src="/assets/js/pages/form-advanced.init.js"></script>

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
