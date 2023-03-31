@extends('layouts.master-layout')
@section('current-page')
    Accounts
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
                <div class="card-body">
                    <form action="{{route('show-accounts')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header text-white bg-primary mb-2">
                                    Add New Account
                                </div>
                                <div class="form-group">
                                    <label for="">Account Name<sup class="text-danger">*</sup></label>
                                    <input type="text"  placeholder="Account Name" name="accountName" id="accountName" value="{{old('accountName')}}" class="form-control">
                                    <br> @error('accountName')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Account Number<sup class="text-danger">*</sup></label>
                                    <input type="number"  placeholder="Account Number" name="accountNumber" id="accountNumber" value="{{old('accountNumber')}}" class="form-control">
                                    <br> @error('accountNumber')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Bank Name<sup class="text-danger">*</sup></label>
                                    <input type="text"  placeholder="Bank Name" name="bankName" id="accountNumber" value="{{old('bankName')}}" class="form-control">
                                    <br> @error('bankName')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Swift Code <small>(Optional)</small></label>
                                    <input type="text"  placeholder="Swift Code " name="swiftCode" id="swiftCode" value="{{old('swiftCode')}}" class="form-control">
                                    <br> @error('swiftCode')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Description <small>(Optional)</small></label>
                                    <textarea name="description" style="resize: none;" placeholder="Description" class="form-control">{{old('description')}}</textarea>
                                    <br> @error('description')<i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="form-group d-flex justify-content-center mb-3 mt-2">
                                    <button type="submit" class="btn btn-custom btn-lg waves-effect waves-light"> Submit <i class="bx bx-right-arrow ml-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 ">
            <div class="card text-white text-center p-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="wd-15p">Account Name</th>
                                <th class="wd-15p">Account Number</th>
                                <th class="wd-15p">Bank</th>
                                <th class="wd-15p">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $serial = 1; @endphp
                                @foreach($accounts as $account)
                                    <tr>
                                        <td>{{$serial++}}</td>
                                        <td>{{$account->account_name ?? '' }}</td>
                                        <td>{{$account->account_number ?? '' }}</td>
                                        <td>{{$account->bank_name ?? '' }}</td>
                                        <td>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#accountModal_{{$account->id}}" class="btn btn-sm btn-info">View</a>
                                            <div id="accountModal_{{$account->id}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel">Edit Account Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('update-account')}}" method="post" autocomplete="off">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group" style="text-align:left;">
                                                                            <label for="">Account Name<sup class="text-danger">*</sup></label>
                                                                            <input type="text"  placeholder="Account Name" name="accountName" id="accountName" value="{{old('accountName', $account->account_name)}}" class="form-control">
                                                                            <br> @error('accountName')<i class="text-danger">{{$message}}</i>@enderror
                                                                        </div>
                                                                        <div class="form-group" style="text-align:left;">
                                                                            <label for="">Account Number<sup class="text-danger">*</sup></label>
                                                                            <input type="number"  placeholder="Account Number" name="accountNumber" id="accountNumber" value="{{old('accountNumber',$account->account_number)}}" class="form-control">
                                                                            <br> @error('accountNumber')<i class="text-danger">{{$message}}</i>@enderror
                                                                        </div>
                                                                        <div class="form-group" style="text-align:left;">
                                                                            <label for="">Bank Name<sup class="text-danger">*</sup></label>
                                                                            <input type="text"  placeholder="Bank Name" name="bankName" id="accountNumber" value="{{old('bankName',$account->bank_name)}}" class="form-control">
                                                                            <br> @error('bankName')<i class="text-danger">{{$message}}</i>@enderror
                                                                        </div>
                                                                        <div class="form-group" style="text-align:left;">
                                                                            <label for="">Swift Code <small>(Optional)</small></label>
                                                                            <input type="text"  placeholder="Swift Code " name="swiftCode" id="swiftCode" value="{{old('swiftCode',$account->swift_code)}}" class="form-control">
                                                                            <br> @error('swiftCode')<i class="text-danger">{{$message}}</i>@enderror
                                                                        </div>
                                                                        <div class="form-group" style="text-align:left;">
                                                                            <label for="">Description <small>(Optional)</small></label>
                                                                            <textarea name="description" style="resize: none;" placeholder="Description" class="form-control">{{old('description',$account->description)}}</textarea>
                                                                            <br> @error('description')<i class="text-danger">{{$message}}</i>@enderror
                                                                            <input type="hidden" name="accountId" value="{{$account->id}}">
                                                                        </div>
                                                                        <div class="form-group d-flex justify-content-center mb-3 mt-2">
                                                                            <button type="submit" class="btn btn-custom btn-lg waves-effect waves-light"> Save changes <i class="bx bx-right-arrow ml-2"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
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
@endsection

@section('extra-scripts')
    <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="/assets/js/pages/datatables.init.js"></script>


@endsection
