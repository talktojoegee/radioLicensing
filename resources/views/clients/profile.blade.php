@extends('layouts.master-layout')
@section('current-page')
{{$client->first_name ?? '' }}'s Profile
@endsection
@section('extra-styles')
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/parsley.css" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    @if(session()->has('success'))
        <div class="row" role="alert">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {!! session()->get('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a href="{{route('clients')}}"  class="btn btn-primary  mb-3">All Clients <i class="bx bxs-group"></i> </a>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-3">
                                    <h5 class="text-primary">Client Details</h5>
                                    <p>Explore client profile</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="/assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="avatar-md profile-user-wid mb-4" style="width: 120px; height: 120px;" >
                                    <img style="width: 120px; height: 120px;" src="{{url('storage/'.$client->avatar)}}" alt="" class="img-thumbnail rounded-circle">
                                </div>
                                <h5 class="font-size-15">{{$client->first_name ?? '' }} {{$client->last_name ?? '' }}</h5>
                                <p class="text-muted mb-0"><span class="badge rounded-pill bg-success float-start" key="t-new">{{$client->getClientGroup->group_name ?? '' }}</span></p>
                            </div>

                            <div class="col-sm-8">
                                <div class="pt-4">

                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="font-size-15">{{number_format($client->getClientAppointments->count())}}</h5>
                                            <p class="text-muted mb-0">Appointments</p>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="font-size-15">{{number_format($files->count())}}</h5>
                                            <p class="text-muted mb-0">Documents</p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#editClientModal" class="btn btn-warning waves-effect waves-light btn-sm">Edit Profile <i class="bx bxs-pencil ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Personal Information</h4>
                        <h5>Note :</h5>
                        <p class="text-muted mb-4">{{$client->quick_note ?? 'No note...' }}</p>
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                <tr>
                                    <th scope="row">Full Name :</th>
                                    <td>{{$client->first_name ?? '' }} {{$client->last_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile :</th>
                                    <td>{{$client->mobile_no ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">E-mail :</th>
                                    <td>{{$client->email ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Address :</th>
                                    <td>{{$client->address ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Registered By :</th>
                                    <td>{{$client->getAddedBy->first_name  ?? '' }} {{$client->getAddedBy->last_name  ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Archived? :</th>
                                    <td>
                                        <input type="checkbox" id="archivedToggler" switch="primary" {{$client->status == 2 ? 'checked' : '' }}>
                                        <label for="archivedToggler" data-on-label="Yes" data-off-label="No"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Assigned To <span style="cursor: pointer;" id="clientAssignmentToggler"><i class="bx bxs-pencil text-warning"></i></span> :</th>
                                    <td>{{$client->getAssignedTo->first_name  ?? '' }} {{$client->getAssignedTo->last_name  ?? '' }}</td>
                                </tr>
                                <tr class="bg-light" id="clientAssignmentWrapper">
                                    <td colspan="2">
                                        <form action="{{route('assign-client-to')}}" method="post">
                                            @csrf
                                            <h6 class="card-header bg-custom text-white mb-3">Assign Client To...</h6>
                                            <div class="form-group">
                                                <label for="">Practitioners & Admins</label>
                                                <select name="assignTo" id="assignTo" class="form-control">
                                                    <option disabled selected>--Choose someone--</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->first_name ?? '' }} {{$user->last_name ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="client" value="{{$client->id}}">
                                            </div>
                                            <div class="form-group mt-3 d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary btn-sm">Save changes <i class="bx bxs-right-arrow"></i> </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Appointments</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#medication" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Medication</span>
                                </a>
                            </li>
                            <li class="nav-item" style="display: none;">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Message</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#documents" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">Documents</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="home1" role="tabpanel">
                                <div class="card-header bg-custom text-white mb-3">Appointments</div>
                                <div class="table-responsive mt-3">
                                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th class="">#</th>
                                            <th class="wd-15p">Date & Time</th>
                                            <th class="wd-15p">Type</th>
                                            <th class="wd-15p">Contact</th>
                                            <th class="wd-15p">Status</th>
                                            <th class="wd-15p">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $index = 1; @endphp
                                        @foreach($client->getClientAppointments as $appoint)
                                            <tr>
                                                <td>{{$index++}}</td>
                                                <td>
                                                    @if($appoint->getCalendar->session_type != 3)
                                                        {{date('d M, Y', strtotime($appoint->getCalendar->event_date))}} <u class="text-info">{{date('h:ia', strtotime($appoint->getCalendar->event_date))}}</u>
                                                    @else
                                                        <strong>From: </strong>{{date('d M, Y', strtotime($appoint->getCalendar->event_date))}} <u class="text-info">{{date('h:ia', strtotime($appoint->getCalendar->event_date))}}</u>
                                                        <br>
                                                        <strong>To: </strong>{{date('d M, Y', strtotime($appoint->getCalendar->end_date))}} <u class="text-info">{{date('h:ia', strtotime($appoint->getCalendar->end_date))}}</u>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($appoint->getCalendar->session_type != 3)
                                                        {{$appoint->getCalendar->getAppointmentType->name ?? '' }}
                                                    @else
                                                        <span class="text-warning">Block Session</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if($appoint->getCalendar->session_type != 3)
                                                        @switch($appoint->getCalendar->contact_type)
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
                                                    @switch($appoint->getCalendar->status)
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
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('show-appointment-details', $appoint->getCalendar->slug)}}"> <i class="bx bxs-book-open"></i> View</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile1" role="tabpanel">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#composeMessage">Compose Message <i class="bx bxs-pencil"></i> </button>
                                <div class="card-header bg-custom text-white mb-3 mt-3">Messages</div>
                                <div class="table-responsive mt-3">
                                    <table id="datatable1" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th class="">#</th>
                                            <th class="wd-15p">Drug Name</th>
                                            <th class="wd-15p">Prescribed By</th>
                                            <th class="wd-15p">Start Date</th>
                                            <th class="wd-15p">Reports</th>
                                            <th class="wd-15p">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $index = 1; @endphp
                                        @foreach($client->getClientMedications as $med)
                                            <tr>
                                                <td>{{$index++}}</td>
                                                <td>
                                                    {{$med->drug_name ?? '' }}
                                                </td>
                                                <td>
                                                    {{$med->getPrescribedBy->first_name ?? '' }}  {{$med->getPrescribedBy->last_name ?? '' }}

                                                </td>
                                                <td>
                                                    {{date('d M, Y', strtotime($med->start_date))}}
                                                </td>
                                                <td>
                                                    <span class="badge rounded-pill bg-success"> {{number_format($med->getClientMedicationReports->count())}} </span> <abbr title="Number of reports">?</abbr>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('medication-details', ['slug'=>$med->slug])}}"> <i class="bx bxs-book-open"></i> View Details</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="medication" role="tabpanel">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMedication">Add New <i class="bx bxs-plus-circle"></i> </button>
                                <div class="card-header bg-custom text-white mb-3 mt-3">Medications</div>
                                <div class="table-responsive mt-3">
                                    <table id="datatable2" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th class="">#</th>
                                            <th class="wd-15p">Drug Name</th>
                                            <th class="wd-15p">Prescribed By</th>
                                            <th class="wd-15p">Start Date</th>
                                            <th class="wd-15p">Reports</th>
                                            <th class="wd-15p">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $index = 1; @endphp
                                        @foreach($client->getClientMedications as $med)
                                            <tr>
                                                <td>{{$index++}}</td>
                                                <td>
                                                   {{$med->drug_name ?? '' }}
                                                </td>
                                                <td>
                                                    {{$med->getPrescribedBy->first_name ?? '' }}  {{$med->getPrescribedBy->last_name ?? '' }}

                                                </td>
                                                <td>
                                                   {{date('d M, Y', strtotime($med->start_date))}}
                                                </td>
                                                <td>
                                                   <span class="badge rounded-pill bg-success"> {{number_format($med->getClientMedicationReports->count())}} </span> <abbr title="Number of reports">?</abbr>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('medication-details', ['slug'=>$med->slug])}}"> <i class="bx bxs-book-open"></i> View Details</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="documents" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-xl-12 col-md-12 col-lg-12">
                                            <div class="card-header bg-custom text-white mb-3">Upload New Document(s)</div>
                                            <p class="card-title-desc">Upload <strong>{{$client->first_name ?? '' }}'s</strong> documents here. Below are other documents previously uploaded relating to <strong>{{$client->first_name ?? '' }}</strong></p>
                                            <div class="tab-content p-3 text-muted">
                                                <div class="tab-pane active" id="home1" role="tabpanel">
                                                    <form action="{{route('upload-files')}}" autocomplete="off" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group mb-3">
                                                            <label for="">File Name</label>
                                                            <input type="text" name="fileName" placeholder="File Name" class="form-control">
                                                            @error('fileName')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Attachment</label>
                                                            <input type="file" name="attachments[]" class="form-control-file" multiple>
                                                            @error('attachment')
                                                            <i class="text-danger mt-2">{{$message}}</i>
                                                            @enderror
                                                            <input type="hidden" name="folder" value="0">
                                                            <input type="hidden" name="client" value="{{$client->id}}">
                                                        </div>
                                                        <hr>
                                                        <div class="form-group d-flex justify-content-center">
                                                            <div class="btn-group">
                                                                <button type="submit" class="btn btn-custom"><i class="bx bx-cloud-upload mr-2"></i> Upload File(s)</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="card-header bg-custom text-white mb-3 mt-3">{{$client->first_name ?? '' }}'s Documents</div>
                                                    @foreach ($files as $file)
                                                        @switch(pathinfo($file->filename, PATHINFO_EXTENSION))
                                                            @case('pptx')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}" style="cursor: pointer;">
                                                                    <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>

                                                            @break
                                                            @case('pdf')
                                                            <div class="col-md-2 mb-4">
                                                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}" style="cursor: pointer;">
                                                                    <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"> <br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break

                                                            @case('csv')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/csv.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('xls')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('xlsx')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('doc')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('doc')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('docx')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('jpeg')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/jpg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('jpg')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/jpg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('png')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/png.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('gif')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/gif.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('ppt')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('txt')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/txt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('css')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/css.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"> <br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('mp3')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/mp3.png" height="64" width="64" alt=""><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('mp4')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/mp4.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('svg')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/svg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('xml')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/xml.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                            @case('zip')
                                                            <div class="col-md-2">
                                                                <a href="javascript:void(0);" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                                    <img src="/assets/formats/zip.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                                </a>
                                                                @include('storage.partials._drop-menu')
                                                            </div>
                                                            @break
                                                        @endswitch
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5"> Client Activity Log</h4>
                        <div class="" style="height: 350px; overflow-y: scroll;">
                            <ul class="verti-timeline list-unstyled">
                                @foreach($client->getClientLogs->take(10) as $log)
                                    <li class="event-list">
                                        <div class="event-timeline-dot">
                                            <i class="bx bx-right-arrow-circle"></i>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="bx bx-code h4 text-primary"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark">{{$log->title ?? '' }}</a></h5>
                                                    <p>{{$log->log ?? '' }}</p>
                                                    <span class="text-primary">{{date('d M, Y h:ia', strtotime($log->created_at))}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal right fade" id="editClientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title" id="myModalLabel2">Edit Client Profile</h4>
                </div>

                <div class="modal-body">
                    <form autocomplete="off" action="{{route('edit-client-profile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-1">
                            <label for="">Profile Photo</label> <br>
                            <input type="file" name="profilePhoto" class="form-control-file">
                            @error('profilePhoto') <i class="text-danger">{{$message}}</i>@enderror
                        </div>
                        <input type="hidden" name="clientId" value="{{$client->id}}">
                        <div class="form-group mt-3">
                            <label for="">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="firstName" placeholder="First Name" value="{{$client->first_name ?? '' }}" class="form-control">
                            @error('firstName') <i class="text-danger">{{$message}}</i>@enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for="">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="lastName" value="{{$client->last_name ?? '' }}" placeholder="Last Name" class="form-control">
                            @error('lastName') <i class="text-danger">{{$message}}</i>@enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for="">Date of Birth </label>
                            <input type="date" value="{{date('Y-m-d', strtotime($client->birth_date))  }}" name="birthDate"  placeholder="Date of Birth" class="form-control">
                            @error('birthDate') <i class="text-danger">{{$message}}</i>@enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for="">Mobile Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="mobileNo" value="{{$client->mobile_no ?? '' }}" placeholder="Mobile Phone Number" class="form-control">
                            @error('mobileNo') <i class="text-danger">{{$message}}</i>@enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for="">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" readonly value="{{$client->email ?? '' }}" placeholder="Email Address" class="form-control">
                            @error('email') <i class="text-danger">{{$message}}</i>@enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for=""> Address</label>
                            <textarea name="address" style="resize: none;" placeholder="Type address here..." class="form-control">{{$client->address ?? '' }}</textarea>
                            @error('address') <i class="text-danger">{{$message}}</i>@enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for="">Current Weight </label>
                            <input type="text" name="currentWeight"  value="{{$client->current_weight ?? '' }}" placeholder="Current Weight" class="form-control">
                            @error('currentWeight') <i class="text-danger">{{$message}}</i>@enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for="">Client Group</label>
                            <select name="clientGroup" id="" class="form-control">
                                @foreach($clientGroups as $group)
                                    <option {{$group->id == $client->client_group_id ? 'selected' : ''  }} value="{{$group->id}}">{{$group->group_name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-1">
                            <label for=""> Quick Note</label>
                            <textarea name="quickNote" style="resize: none;" placeholder="Leave a quick note here..." class="form-control">{{$client->quick_note ?? '' }}</textarea>
                            @error('quickNote') <i class="text-danger">{{$message}}</i>@enderror
                        </div>
                        <div class="form-group d-flex justify-content-center mt-3">
                            <div class="btn-group">
                                <button class="btn btn-primary  waves-effect waves-light">Save changes <i class="bx bxs-right-arrow"></i> </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal right fade" id="addMedication" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <h4 class="modal-title" id="myModalLabel2">Medication</h4>
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form autocomplete="off" data-parsley-validate="" id="addMedicationForm" action="{{route('add-medication')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="clientId" value="{{$client->id}}">
                        <div class="form-group mt-3">
                            <label for="">Drug Name <span class="text-danger">*</span></label>
                            <input type="text" name="drugName" required data-parsley-required-message="Enter drug name" placeholder="Drug Name" value="{{old('drugName') }}" class="form-control">
                            @error('drugName') <i class="text-danger">{{$message}}</i>@enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for="">Quantity<span class="text-danger">*</span></label>
                            <input type="number" name="quantity" value="{{old('quantity') }}" placeholder="Quantity" class="form-control">
                            @error('quantity') <i class="text-danger">{{$message}}</i>@enderror
                        </div>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected mt-3">
                            <span class="input-group-btn input-group-prepend">
                                <button class="btn btn-primary bootstrap-touchspin-down" type="button">Start Date</button>
                            </span>
                            <input data-toggle="touchspin" required data-parsley-required-message="When should this person start this medication?" type="date" value="{{date('Y-m-d')}}" name="startDate" class="form-control">
                            <span class="input-group-btn input-group-append">
                                <button class="btn btn-primary bootstrap-touchspin-up" type="button">End Date</button>
                            </span>
                            <input data-toggle="touchspin" required data-parsley-required-message="Alright, when is the medication expected to end?" type="date" value="{{date('Y-m-d')}}" name="endDate" class="form-control">
                            @error('startDate') <i class="text-danger">{{$message}}</i>@enderror &nbsp;
                            @error('endDate') <i class="text-danger">{{$message}}</i>@enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for="">Prescription <span class="text-danger">*</span> </label>
                            <textarea name="prescription" required data-parsley-required-message="Enter prescription in the box provided" placeholder="Type prescription here..." id="prescription" style="resize: none;" class="form-control">{{old('prescription')}}</textarea>
                            @error('prescription') <i class="text-danger">{{$message}}</i>@enderror
                        </div>
                        <div class="form-group d-flex justify-content-center mt-3">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary  waves-effect waves-light">Submit <i class="bx bxs-right-arrow"></i> </button>
                            </div>
                        </div>
                    </form>

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
    <script src="/js/axios.min.js"></script>
    <script src="/js/parsley.js"></script>
    <script>
        $(document).ready(function(){
            $('#clientAssignmentWrapper').hide();
            $("#clientAssignmentToggler").click(function(){
                $("#clientAssignmentWrapper").toggle();
            });
            $('#archivedToggler').on('change',function(){
                if ($("#archivedToggler").is(':checked')){
                    axios.post("{{route('archive-unarchive-client')}}",{
                        clientId:"{{$client->id}}",
                        status:2
                    });
                } else {
                    axios.post("{{route('archive-unarchive-client')}}",{
                        clientId:"{{$client->id}}",
                        status:1
                    });
                }
            });
            $('#addMedicationForm').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
                .on('form:submit', function() {
                    return true;
                });
        });
    </script>


@endsection
