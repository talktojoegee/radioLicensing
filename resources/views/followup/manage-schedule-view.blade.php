@extends('layouts.master-layout')
@section('current-page')
    Schedule Detail
@endsection
@section('extra-styles')
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/assets/libs/bootstrap-rating/bootstrap-rating.min.css" rel="stylesheet" type="text/css" />
    <style>
        .text-danger{
            color: #ff0000 !important;
        }
        .checked {
            color: orange;
        }
    </style>
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')

    <div class="container-fluid">
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
        <div class="row">
                <div class="col-xl-12 col-md-12">

                    <div class="card">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-12 col-lg-12 d-flex justify-content-end mb-4 mr-4">
                                        <button class="btn btn-danger btn-sm" data-bs-target="#rateSchedule" data-bs-toggle="modal" type="button">Rate <i class="bx bxs-pencil"></i> </button>
                                    </div>
                                    <div class="modal-header">
                                        <h6 class="text-uppercase modal-title"> Details</h6>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-nowrap mb-0">
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">Scheduled By:</th>
                                                        <td> {{$record->getScheduledBy->title ?? '' }} {{$record->getScheduledBy->first_name ?? '' }} {{$record->getScheduledBy->last_name ?? '' }} </td>
                                                        @if($record->status != 0)
                                                            <th scope="row">Actioned By:</th>
                                                            <td> {{$record->getScheduledBy->title ?? '' }} {{$record->getScheduledBy->first_name ?? '' }} {{$record->getScheduledBy->last_name ?? '' }} </td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Date :</th>
                                                        <td>{{ date('d M, Y', strtotime($record->entry_date)) }} </td>
                                                        @if($record->status != 0)
                                                            <th scope="row">Action Date:</th>
                                                            <td> {{ date('d M, Y', strtotime($record->action_date)) }}  </td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Period:</th>
                                                        <td> <span style="background: #f46a6a; padding:4px; color:#fff;">{{ date('F', mktime(0, 0, 0, $record->period_month, 10)) }}, {{ $record->period_year ?? '' }}</span> </td>
                                                        @if($record->status != 0)
                                                            <th scope="row">Rating:</th>
                                                            <td>
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <span class="fa fa-star {{ $i <= $record->score ? 'checked' : '' }}"></span>
                                                                @endfor
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Status: </th>
                                                        <td>
                                                            @switch($record->status)
                                                                @case(0)
                                                                <span class="text-warning">New</span>
                                                                @break
                                                                @case(1)
                                                                <span class="text-success">Open</span>
                                                                @break
                                                                @case(2)
                                                                <span class="text-danger">Closed</span>
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        @if($record->status != 0)
                                                            <th scope="row">Comment:</th>
                                                            <td>
                                                                {{ $record->comment ?? '' }}
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Title:</th>
                                                        <td>{{ $record->title ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Objectives</th>
                                                        <td>{{$record->objective ?? '' }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mt-3">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Done</th>
                                                    <th scope="col">Not Done</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>{{ number_format(count($record->getLeadScheduleDetails)) }}</td>
                                                    <td>{{ number_format(count($record->getLeadScheduleDetails->where('status',1))) }}</td>
                                                    <td>{{ number_format(count($record->getLeadScheduleDetails->where('status',0))) }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Mobile No.</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($record->getLeadScheduleDetails as $key => $rec)
                                                    <tr>
                                                        <th scope="row">{{$key + 1}}</th>
                                                        <td><a target="_blank" href="{{ route('lead-profile', $rec->getLead->slug) }}">{{$rec->getLead->first_name ?? '' }} {{$rec->getLead->last_name ?? '' }} </a> </td>
                                                        <td>{{$rec->getLead->phone ?? '' }}</td>
                                                        <td>
                                                            @if($rec->status == 1)
                                                                <span class="text-success">Done</span>
                                                            @else
                                                                <span class="text-danger">Not done</span>
                                                            @endif
                                                        </td>
                                                        <td>{!! $rec->getLead->gender == 1 ? "<span class='text-warning'>Male</span>" : "<span class='text-danger'>Female</span>" !!}</td>
                                                        <td>
                                                            @if($rec->status == 1)
                                                                ---
                                                            @else
                                                                <a href="javascript:void(0);" data-bs-target="#moreActions_{{$rec->id}}" data-bs-toggle="modal">View</a>
                                                            @endif
                                                            <div class="modal right fade " id="moreActions_{{$rec->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                                                                <div class="modal-dialog modal-lg w-100" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" >
                                                                            <h4 class="modal-title" id="myModalLabel2">Feedback & More</h4>
                                                                            <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <p>How was your interaction with <code>{{$rec->getLead->first_name ?? '' }} {{$rec->getLead->last_name ?? '' }}</code>? Kindly leave a feedback.</p>
                                                                                    <!-- Nav tabs -->
                                                                                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                                                                        <li class="nav-item">
                                                                                            <a class="nav-link active" data-bs-toggle="tab" href="#profile1" role="tab">
                                                                                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                                                                <span class="d-none d-sm-block">Notes</span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li class="nav-item" >
                                                                                            <a class="nav-link" data-bs-toggle="tab" href="#documents" role="tab">
                                                                                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                                                                <span class="d-none d-sm-block">SMS</span>
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>

                                                                                    <!-- Tab panes -->
                                                                                    <div class="tab-content p-3 text-muted">
                                                                                        <div class="tab-pane active" id="profile1" role="tabpanel">
                                                                                            <form action="{{route('leave-lead-note')}}" id="leadNoteForm" method="post">
                                                                                                @csrf
                                                                                                <div class="form-group">
                                                                                                    <label for="">Rating <sup class="text-danger" style="color: #ff0000;">*</sup> </label>
                                                                                                    <div class="rating-star">
                                                                                                        <input type="hidden" name="rating" class="rating-tooltip" data-filled="mdi mdi-star text-primary" data-empty="mdi mdi-star-outline text-muted"/>
                                                                                                    </div>
                                                                                                    @error('rating') <i class="text-danger">{{$message}}</i> @enderror
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="">Should the system mark this request as done? <sup class="text-danger" style="color: #ff0000;">*</sup> </label>
                                                                                                    <div class="form-check form-checkbox-outline form-check-primary mb-3">
                                                                                                        <input class="form-check-input" type="checkbox" id="markAsDone" name="markAsDone" checked>
                                                                                                        <label class="form-check-label" for="markAsDone">
                                                                                                            Yes, mark it as done
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="">Add Note <sup class="text-danger" style="color: #ff0000;">*</sup></label>
                                                                                                    <textarea name="addNote" data-parsley-required-message="Leave a note in the box provided above" required style="resize: none;" cols="30" rows="4" placeholder="Type Note here..." class="form-control">{{old('addNote')}}</textarea>
                                                                                                    @error('addNote') <i class="text-danger">{{$message}}</i> @enderror
                                                                                                    <input type="hidden" name="type" value="2">
                                                                                                    <input type="hidden" name="followupDetail" value="{{$rec->id}}">
                                                                                                    <input type="hidden" name="followup" value="{{$record->id}}">
                                                                                                </div>
                                                                                                <input type="hidden" value="{{$rec->getLead->id}}" name="leadId">
                                                                                                <div class="form-group mt-1 float-end">
                                                                                                    <button type="submit" class="btn btn-info btn-lg">Add Note <i class="bx bxs-note"></i> </button>
                                                                                                </div>
                                                                                            </form>
                                                                                            <div class="mt-5" style="height: 330px; overflow-y: scroll;">
                                                                                                @if($rec->getLead->getLeadNotes->count() > 0)
                                                                                                    @foreach($rec->getLead->getLeadNotes as $note)
                                                                                                        <div class="d-flex py-3">
                                                                                                            <div class="flex-shrink-0 me-3">
                                                                                                                <div class="avatar-xs">
                                                                                                                    <div class="avatar-title rounded-circle bg-light text-primary">
                                                                                                                        <i class="bx bxs-user"></i>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="flex-grow-1">
                                                                                                                <h6 class="font-size-14 mb-1">{{$note->getAddedBy->first_name ?? '' }} {{$note->getAddedBy->last_name ?? '' }} <small class="text-muted float-end">{{date('d M, Y h:ia', strtotime($note->created_at))}}</small></h6>
                                                                                                                <p class="text-muted">{{$note->note ?? '' }}</p>
                                                                                                                <div class="">
                                                                                                                    @for($i = 1; $i <= 5; $i++)
                                                                                                                        <span class="fa fa-star {{ $i <= $note->rating ? 'checked' : '' }}"></span>
                                                                                                                    @endfor
                                                                                                                </div>
                                                                                                                <div class="modal fade" id="editNote_{{$note->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                                                                                                                    <div class="modal-dialog" role="document">
                                                                                                                        <div class="modal-content">
                                                                                                                            <div class="modal-header" >
                                                                                                                                <h4 class="modal-title" id="myModalLabel2">Edit Note</h4>
                                                                                                                                <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                                            </div>
                                                                                                                            <div class="modal-body">
                                                                                                                                <form action="{{route('edit-lead-note')}}" id="leadNoteForm" method="post">
                                                                                                                                    @csrf
                                                                                                                                    <div class="form-group">
                                                                                                                                        <label for=""> Note</label>
                                                                                                                                        <textarea name="addNote" data-parsley-required-message="Leave a note in the box provided above" required style="resize: none;" cols="30" rows="4" placeholder="Type Note here..." class="form-control">{{$note->note ?? '' }}</textarea>
                                                                                                                                        @error('addNote') <i class="text-danger">{{$message}}</i> @enderror
                                                                                                                                    </div>
                                                                                                                                    <input type="hidden" value="{{$note->id}}" name="noteId">
                                                                                                                                    <input type="hidden" value="{{$rec->getLead->id}}" name="leadId">
                                                                                                                                    <div class="form-group mt-1 float-end">
                                                                                                                                        <button type="submit" class="btn btn-info btn-lg">Save changes <i class="bx bxs-note"></i> </button>
                                                                                                                                    </div>
                                                                                                                                </form>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="modal fade" id="deleteNote_{{$note->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                                                                                                                    <div class="modal-dialog" role="document">
                                                                                                                        <div class="modal-content">
                                                                                                                            <div class="modal-header" >
                                                                                                                                <h4 class="modal-title" id="myModalLabel2">Delete Note</h4>
                                                                                                                                <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                                            </div>
                                                                                                                            <div class="modal-body">
                                                                                                                                <form action="{{route('delete-lead-note')}}" id="leadNoteForm" method="post">
                                                                                                                                    @csrf
                                                                                                                                    <div class="form-group">
                                                                                                                                        <p>Are you sure you want to delete this note?</p>
                                                                                                                                    </div>
                                                                                                                                    <input type="hidden" value="{{$note->id}}" name="noteId">
                                                                                                                                    <input type="hidden" value="{{$rec->getLead->id}}" name="leadId">
                                                                                                                                    <div class="form-group mt-1 float-end">
                                                                                                                                        <button type="submit" class="btn btn-danger btn-lg">Delete <i class="bx bxs-trash"></i> </button>
                                                                                                                                    </div>
                                                                                                                                </form>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endforeach
                                                                                                @else
                                                                                                    <h6 class="text-center">Be the first to leave a note.</h6>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="tab-pane" id="documents" role="tabpanel">
                                                                                            <div class="card">
                                                                                                <div class="card-body">
                                                                                                    <div class="col-xl-12 col-md-12 col-lg-12">
                                                                                                        <form id="mainForm" >
                                                                                                            <div class="card">
                                                                                                                <div class="card-body">
                                                                                                                    <div class="row mb-3">
                                                                                                                        <div class="col-md-12">
                                                                                                                            <div class="form-group">
                                                                                                                                <label class="form-label d-flex justify-content-between">Sender ID
                                                                                                                                </label>
                                                                                                                                <input required data-parsley-required-message="Indicate the sender ID" type="text" id="senderId" value="{{env('SENDER_ID')}}" disabled class="form-control">
                                                                                                                                @error('senderId') <i class="text-danger">{{$message}}</i>@enderror
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="col-md-12 mt-3">
                                                                                                                            <div class="form-group">
                                                                                                                                <label class="form-label d-flex justify-content-between">To:
                                                                                                                                </label>
                                                                                                                                <input required data-parsley-required-message="Enter the phone number of who you want to message" type="text" value="{{$rec->getLead->phone ?? ''}}" name="phone_numbers"  id="phone_numbers" class="form-control">
                                                                                                                                @error('phone_numbers') <i class="text-danger">{{$message}}</i>@enderror
                                                                                                                                <input type="hidden" name="client" id="client" value="{{ $rec->getLead->id }}">
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group mt-3">
                                                                                                                            <label for="">Should the system mark this request as done? <sup class="text-danger" style="color: #ff0000;">*</sup> </label>
                                                                                                                            <div class="form-check form-checkbox-outline form-check-primary mb-3">
                                                                                                                                <input class="form-check-input" type="checkbox" id="markAsDone" name="markAsDone" checked>
                                                                                                                                <label class="form-check-label" for="markAsDone">
                                                                                                                                    Yes, mark it as done
                                                                                                                                </label>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <input type="hidden" name="followupDetail" value="{{$rec->id}}">
                                                                                                                    </div>
                                                                                                                    <div class="row" id="from-message">
                                                                                                                        <div class="col-md-12">
                                                                                                                            <div class="form-group">
                                                                                                                                <label class="form-label">Compose message</label>
                                                                                                                                <textarea data-parsley-required-message="Type your message in this field..." required onkeyup="getCharacterLength()" name="message" rows="5" id="message" style="resize: none" placeholder="Compose message here..."
                                                                                                                                          class="form-control">{{old('message')}}</textarea>
                                                                                                                                @error('message') <i class="text-danger">{{$message}}</i>@enderror
                                                                                                                                <p class="text-right text-danger" id="character-counter">0</p>
                                                                                                                                <span><strong class="text-danger">Note: </strong> One page of message consists of <code>160</code> characters.</span>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="card-footer text-right d-flex justify-content-center">
                                                                                                                    <button type="button" id="previewMessage" class="btn btn-primary w-50">Send Message <i class="bx bxs-right-arrow"></i> </button>
                                                                                                                </div>
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
    <div class="modal fade" id="rateSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <h6 class="modal-title text-uppercase">Rate Schedule</h6>
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" action="{{ route('rate-followup-schedule') }}" method="post">
                        @csrf
                        <div class="mt-2">
                            <div class="form-group">
                                <label for="">Status</label>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-check form-radio-outline form-radio-primary mb-3">
                                        <input class="form-check-input" type="radio" name="status" value="0" id="new" {{$record->status == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="new">
                                            New Schedule
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-check form-radio-outline form-radio-success mb-3">
                                        <input class="form-check-input" type="radio" name="status" value="1" id="open" {{$record->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="open">
                                            Open
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="form-check form-radio-outline form-radio-danger mb-3">
                                        <input class="form-check-input" type="radio" name="status" value="2" id="close" {{$record->status == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="close">
                                            Close
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Score</label>
                            <select name="score" id="" class="form-control">
                                @for($i = 1; $i<=5; $i++)
                                    <option value="{{$i}}">{{$i }} star{{$i > 1 ? 's' : ''  }}</option>
                                @endfor
                            </select>
                            <input type="hidden" value="{{ $record->id }}" name="schedule">
                            @error('score') <i class="text-danger">{{$message}}</i> @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Comment</label>
                            <textarea name="comment" style="resize: none;" placeholder="Leave comment here..." class="form-control">{{ old('comment') }}</textarea>
                            @error('comment') <i class="text-danger">{{$message}}</i> @enderror
                        </div>
                        <div class="form-group d-flex justify-content-center mt-3">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary  waves-effect waves-light">Submit <i class="bx bx-check-circle"></i> </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/assets/libs/bootstrap-rating/bootstrap-rating.min.js"></script>
    <script src="/assets/js/pages/rating-init.js"></script>
    <script>
        function getCharacterLength() {
            x =  document.getElementById("message").value;
            y = x.length;
            document.getElementById("character-counter").innerHTML = y;
        }
    </script>
@endsection
