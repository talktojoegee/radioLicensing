@extends('layouts.master-layout')
@section('current-page')
    Account Activity
@endsection
@section('extra-styles')
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    @if(session()->has('success'))
        <div class="row" role="alert">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-2"></i>

                            {!! session()->get('success') !!}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header  text-white" style="background: #DC4F04;">Filter</div>
                <div class="card-body">
                    <form method="get" action="{{route('search-account-activity')}}">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="">Account</label>
                            <select name="account" id="account" class="form-control">
                                <option disabled selected>--Select account--</option>
                                @foreach($accounts as $account)
                                    <option value="{{$account->id}}">{{$account->account_name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">From</label>
                            <input name="startDate" type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">To</label>
                            <input type="date" name="endDate" class="form-control">
                        </div>
                        <div class="form-group d-flex justify-content-center mt-2">
                            <button class="btn btn-custom bootstrap-touchspin-up" type="submit">Submit <i class="bx bx-right-arrow"></i> </button>
                        </div>
                    </form>
                    @if($search == 1)
                        <h6 class="text-center mt-4"> Time period from <label for="" class="text-success">{{date('d M, Y', strtotime($startDate))}}</label> to <label for="" class="text-danger">{{date('d M, Y', strtotime($endDate))}}</label></h6>
                    @else

                    @endif
                </div>
            </div>
        </div>
        @if($search == 1)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-custom text-white"> <i class="bx bx-wallet"></i> Total Income</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 d-flex justify-content-center">
                                <div style=" height: 70px;" class="d-flex align-middle">
                                    <h3>env('APP_CURRENCY')}}number_format($receipts->sum('total'),2)}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @if($search == 1)
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="">#</th>
                                    <th class="wd-15p">Date</th>
                                    <th class="sorting">Invoice No.</th>
                                    <th class="sorting">Receipt No.</th>
                                    <th class="sorting">Amount</th>
                                    <th class="sorting">Trans. Ref</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $serial = 1; @endphp

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('extra-scripts')

    <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/js/pages/datatables.init.js"></script>


@endsection
