@extends('layouts.master-layout')
@section('current-page')
    Church Branches
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
            <div class="col-md-12 col-sm-12 mt-4">
                <div class="d-flex justify-content-between modal-header">
                    <div class="h6 text-left pl-5 text-uppercase text-primary"> Church Branches</div>
                    <a href="{{url()->previous()}}" class="btn btn-secondary mr-3" > <i class="bx bx-arrow-back"></i>  Go back</a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="">#</th>
                                    <th class="wd-15p">Name</th>
                                    <th class="wd-15p">Lead Pastor</th>
                                    <th class="wd-15p">Assistant</th>
                                    <th class="wd-15p">Email</th>
                                    <th class="wd-15p">Mobile No.</th>
                                    <th class="wd-15p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($branches as $key=>$branch)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$branch->cb_name ?? '' }}</td>
                                        <td>{!! $branch->getLeadPastor->first_name  ?? "<span class='badge badge-pill badge-soft-danger font-size-11'>Not assigned yet</span>" !!} {!! $branch->getLeadPastor->last_name  ?? "<span class='badge badge-pill badge-soft-danger font-size-11'>Not assigned yet</span>" !!}</td>
                                        <td>{!! $branch->getAssistantPastor->first_name  ?? "<span class='badge badge-pill badge-soft-danger font-size-11'>Not assigned yet</span>" !!} {!! $branch->getAssistantPastor->last_name  ?? "<span class='badge badge-pill badge-soft-danger font-size-11'>Not assigned yet</span>" !!}</td>
                                        <td>{{$branch->cb_email ?? '' }}</td>
                                        <td>{{$branch->cb_mobile_no ?? '' }}</td>
                                        <td>
                                            <a href="{{route('church-branch-details', ['slug'=>$branch->cb_slug])}}" class="btn btn-light">View</a>
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
