
@extends('layouts.master-layout')
@section('current-page')
    <small>Tasks</small>
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/nprogress.css">
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/css/toastify.css">
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12">
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
                    <div class="col-md-12">
                        <a href="{{route('create-task')}}"  class="btn btn-primary"> Add Task <i class="bx bx-task"></i> </a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-xl-12 col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Manage Tasks</h4>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">Incomplete</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">Complete</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="home1" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive mt-3">
                                                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                        <thead>
                                                        <tr>
                                                            <th class="">#</th>
                                                            <th class="wd-15p">Due Date</th>
                                                            <th class="wd-15p">Title</th>
                                                            <th class="wd-15p">Excerpt</th>
                                                            <th class="wd-15p">Assigned To</th>
                                                            <th class="wd-15p">Clients</th>
                                                            <th class="wd-15p">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php $index = 1; @endphp
                                                        @foreach($tasks->where('complete', 0) as $task)
                                                            <tr>
                                                                <td>{{$index++}}</td>
                                                                <td>{{date('d M, Y h:ia', strtotime($task->due_date))}}</td>
                                                                <td>{{$task->title ?? '' }}</td>
                                                                <td>{{ strlen(strip_tags($task->description)) > 50 ? substr(strip_tags($task->description),0,50).'...' : strip_tags($task->description) }}</td>
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <span class="badge rounded-pill bg-info ">{{number_format(count(json_decode($task->assigned_to)))}}</span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <span class="badge rounded-pill bg-danger ">{{number_format(count(json_decode($task->clients)))}}</span>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="btn-group">
                                                                        <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" data-bs-target="#messageDetail_{{$task->id}}" data-bs-toggle="modal" href="javascript:void(0);"> <i class="bx bxs-book-open"></i> View</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal right fade" id="messageDetail_{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header" >
                                                                                    <h4 class="modal-title" id="myModalLabel2">Task Details</h4>
                                                                                    @if($task->complete == 0)
                                                                                        <button onclick="return updateStatus({{$task->id}}, '{{route('mark-as')}}')" class="btn btn-success  btn-sm">Mark As Complete <i class="bx bx-check"></i> </button>
                                                                                    @else
                                                                                        <button onclick="return updateStatus({{$task->id}}, '{{route('mark-as')}}')" class="btn btn-warning btn-sm">Mark As Incomplete <i class="bx bx-stop"></i> </button>
                                                                                    @endif

                                                                                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>

                                                                                <div class="modal-body text-wrap">
                                                                                    <h5 class="font-size-15 mt-4">{{$task->title ?? '' }} @if($task->complete == 0) <sup class="text-white p-1 bg-warning">Incomplete</sup>@else <sup class="text-white p-1 bg-success">Complete</sup> @endif </h5>
                                                                                    <hr>
                                                                                    {!! $task->description ?? ''  !!}
                                                                                    <div class="text-muted mt-4 bg-light p-2">
                                                                                        <h6 class="font-size-12 mt-4">Clients <span class="badge rounded-pill bg-info">{{count(json_decode($task->clients))}}</span></h6>
                                                                                        @foreach($task->getClients(json_decode($task->clients))  as $client)
                                                                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i>
                                                                                                {{$client->first_name ?? '' }} {{$client->last_name ?? '' }}
                                                                                            </p>
                                                                                        @endforeach
                                                                                    </div>
                                                                                    <div class="text-muted mt-4 bg-light p-2">
                                                                                        <h6 class="font-size-12 mt-4">Assigned To <span class="badge rounded-pill bg-primary">{{count(json_decode($task->assigned_to))}}</span> </h6>
                                                                                        @foreach($task->getAssignedPersons(json_decode($task->assigned_to))  as $assigned)
                                                                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i>
                                                                                                {{$assigned->first_name ?? '' }} {{$assigned->last_name ?? '' }}
                                                                                            </p>
                                                                                        @endforeach
                                                                                    </div>
                                                                                    <div class="mt-4">
                                                                                        <h6 class="font-size-12 mt-4">Created By</h6>
                                                                                        <p class="text-muted mb-0">{{$task->getCreatedBy->first_name ?? '' }} {{$task->getCreatedBy->last_name ?? '' }}</p>
                                                                                        <h6 class="font-size-12 mt-4">Date & Time</h6>
                                                                                        <p class="text-muted mb-0">{{date('d M, Y h:ia', strtotime($task->created_at))}}</p>
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
                                    <div class="tab-pane" id="profile1" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive mt-3">
                                                    <table id="datatable2" class="table table-bordered dt-responsive  nowrap w-100">
                                                        <thead>
                                                        <tr>
                                                            <th class="">#</th>
                                                            <th class="wd-15p">Due Date</th>
                                                            <th class="wd-15p">Title</th>
                                                            <th class="wd-15p">Excerpt</th>
                                                            <th class="wd-15p">Assigned To</th>
                                                            <th class="wd-15p">Clients</th>
                                                            <th class="wd-15p">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php $index = 1; @endphp
                                                        @foreach($tasks->where('complete', 1) as $task)
                                                            <tr>
                                                                <td>{{$index++}}</td>
                                                                <td>{{date('d M, Y h:ia', strtotime($task->due_date))}}</td>
                                                                <td>{{$task->title ?? '' }}</td>
                                                                <td>{{ strlen(strip_tags($task->description)) > 50 ? substr(strip_tags($task->description),0,50).'...' : strip_tags($task->description) }}</td>
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <span class="badge rounded-pill bg-info ">{{number_format(count(json_decode($task->assigned_to)))}}</span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex justify-content-center">
                                                                        <span class="badge rounded-pill bg-danger ">{{number_format(count(json_decode($task->clients)))}}</span>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="btn-group">
                                                                        <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" data-bs-target="#messageDetail_{{$task->id}}" data-bs-toggle="modal" href="javascript:void(0);"> <i class="bx bxs-book-open"></i> View</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal right fade" id="messageDetail_{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header" >
                                                                                    <h4 class="modal-title" id="myModalLabel2">Task Details</h4>
                                                                                    @if($task->complete == 0)
                                                                                        <button onclick="return updateStatus({{$task->id}}, '{{route('mark-as')}}')" class="btn btn-success  btn-sm">Mark As Complete <i class="bx bx-check"></i> </button>
                                                                                    @else
                                                                                        <button onclick="return updateStatus({{$task->id}}, '{{route('mark-as')}}')" class="btn btn-warning btn-sm">Mark As Incomplete <i class="bx bx-stop"></i> </button>
                                                                                    @endif

                                                                                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>

                                                                                <div class="modal-body text-wrap">
                                                                                    <h5 class="font-size-15 mt-4">{{$task->title ?? '' }} @if($task->complete == 0) <sup class="text-white p-1 bg-warning">Incomplete</sup>@else <sup class="text-white p-1 bg-success">Complete</sup> @endif </h5>
                                                                                    <hr>
                                                                                    {!! $task->description ?? ''  !!}
                                                                                    <div class="text-muted mt-4 bg-light p-2">
                                                                                        <h6 class="font-size-12 mt-4">Clients <span class="badge rounded-pill bg-info">{{count(json_decode($task->clients))}}</span></h6>
                                                                                        @foreach($task->getClients(json_decode($task->clients))  as $client)
                                                                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i>
                                                                                                {{$client->first_name ?? '' }} {{$client->last_name ?? '' }}
                                                                                            </p>
                                                                                        @endforeach
                                                                                    </div>
                                                                                    <div class="text-muted mt-4 bg-light p-2">
                                                                                        <h6 class="font-size-12 mt-4">Assigned To <span class="badge rounded-pill bg-primary">{{count(json_decode($task->assigned_to))}}</span> </h6>
                                                                                        @foreach($task->getAssignedPersons(json_decode($task->assigned_to))  as $assigned)
                                                                                            <p><i class="mdi mdi-chevron-right text-primary me-1"></i>
                                                                                                {{$assigned->first_name ?? '' }} {{$assigned->last_name ?? '' }}
                                                                                            </p>
                                                                                        @endforeach
                                                                                    </div>
                                                                                    <div class="mt-4">
                                                                                        <h6 class="font-size-12 mt-4">Created By</h6>
                                                                                        <p class="text-muted mb-0">{{$task->getCreatedBy->first_name ?? '' }} {{$task->getCreatedBy->last_name ?? '' }}</p>
                                                                                        <h6 class="font-size-12 mt-4">Date & Time</h6>
                                                                                        <p class="text-muted mb-0">{{date('d M, Y h:ia', strtotime($task->created_at))}}</p>
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
    <script src="/assets/js/axios.min.js"></script>
    <script src="/js/toastify.js"></script>
    <script src="/js/nprogress.js"></script>
    <script src="/js/task.js"></script>
@endsection
