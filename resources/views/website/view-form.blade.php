
@extends('layouts.master-layout')
@section('current-page')
    Form Records - {{$form->title ?? '' }}
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/nprogress.css">
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="container-fluid">
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
                        @include('website.partials._top-navigation')

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header bg-primary text-white">Form Entries</div>
                    <div class="card-body">
                        <p>Records collected via this form</p>
                        <div class="table-responsive mt-3">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="">#</th>
                                    <th class="wd-15p">Field</th>
                                    <th class="wd-15p">Value</th>
                                    <th class="wd-15p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $index = 1; @endphp
                                @foreach($records as $record)
                                    <tr>
                                        <td>{{$index++}}</td>
                                        <td>{{$record->label ?? '' }} {!! $record->getAllFormSubmissionsByRefCode($record->ref_code)->count() > 1 ? "<small class='badge rounded-pill bg-danger'>+".($record->getAllFormSubmissionsByRefCode($record->ref_code)->count()-1)." entries</small>" : "" !!} </td>
                                        <td>{{$record->value ?? '' }}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#formEntries_{{$record->id}}">View</a>
                                            <div class="modal right fade" id="formEntries_{{$record->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header" >
                                                            <h4 class="modal-title" id="myModalLabel2">Form Details</h4>
                                                            <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card-title">{{$form->title ?? '' }}</h4>
                                                                    <p class="card-title-desc">{!! $form->description ?? '' !!}</p>
                                                                    <p class="card-title-desc"><span class="rounded-pill bg-info badge">Date & Time:</span> {{date('d M, Y h:ia', strtotime($record->created_at))}}</p>
                                                                    <div class="table-responsive">
                                                                        <table class="table table-striped mb-0">
                                                                            <tbody>
                                                                                @foreach($record->getAllFormSubmissionsByRefCode($record->ref_code) as $entry)
                                                                                    <tr>
                                                                                        <td><strong>{{$entry->label ?? ''}}</strong></td>
                                                                                        <td class="text-info">{{$entry->value ?? '' }}</td>
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
    <!-- Datatable init js -->
    <script src="/assets/js/pages/datatables.init.js"></script>
@endsection
