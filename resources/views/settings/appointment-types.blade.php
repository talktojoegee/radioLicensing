@extends('layouts.master-layout')
@section('current-page')
    Appointment Types
@endsection
@section('extra-styles')
    <link href="/assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
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
        <div class="card-body" style="padding: 2px;">
            <div class="row">
                <div class="col-md-3">
                    @include('settings.partial._sidebar-menu')
                </div>
                <div class="col-md-9 mt-4">
                    <div class="h4 card-header bg-primary text-white mb-4">Appointment Types</div>
                    <div class="container pb-5">
                        <div class="mb-3">
                            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addAppointmentType">Add New Type <i class="bx bxs-plus-circle"></i> </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">

                                <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Length</th>
                                    <th>Telehealth</th>
                                    <th>In Person</th>
                                    <th>Phone Call</th>
                                    <th>All Client</th>
                                    <th>Client Can Book</th>
                                    <th>Group Appointment</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $serial = 1;@endphp
                                @foreach($appointmentTypes as $type)
                                <tr>
                                    <th scope="row">{{$serial++}}</th>
                                    <td>{{$type->name ?? '' }}</td>
                                    <td>{{$type->length ?? '' }}</td>
                                    <td>{!! $type->telehealth == 1 ? "<i class='bx bxs-check-circle text-success'></i>" : "<i class='bx bxs-x-circle text-danger'></i>" !!}</td>
                                    <td>{!! $type->in_person == 1 ? "<i class='bx bxs-check-circle text-success'></i>" : "<i class='bx bxs-x-circle text-danger'></i>" !!}</td>
                                    <td>{!! $type->phone_call == 1 ? "<i class='bx bxs-check-circle text-success'></i>" : "<i class='bx bxs-x-circle text-danger'></i>" !!}</td>
                                    <td>{!! $type->all_client_book == 1 ? "<i class='bx bxs-check-circle text-success'></i>" : "<i class='bx bxs-x-circle text-danger'></i>" !!}</td>
                                    <td>{!! $type->client_can_book == 1 ? "<i class='bx bxs-check-circle text-success'></i>" : "<i class='bx bxs-x-circle text-danger'></i>" !!}</td>
                                    <td>{!! $type->group_appt == 1 ? "<i class='bx bxs-check-circle text-success'></i>" : "<i class='bx bxs-x-circle text-danger'></i>" !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-target="#editAppointmentTypeModal_{{$type->id}}" data-bs-toggle="modal"> <i class="bx bxs-book-open"></i> View</a>
                                            </div>
                                        </div>
                                        <div class="modal right fade" id="editAppointmentTypeModal_{{$type->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" >
                                                        <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        <h4 class="modal-title" id="myModalLabel2">Edit Appointment Type</h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form action="{{route('edit-appointment-types')}}" method="post" >
                                                            @csrf
                                                            <div class="form-group mb-3">
                                                                <label for="">Name</label>
                                                                <input type="text" name="name" value="{{$type->name ?? ''}}" required data-parsley-required-message="Give a name to this appointment type..." placeholder="Ex: Nutrition Consultation" class="form-control">
                                                            </div>
                                                            <div class="form-check form-checkbox-outline form-check-primary mb-3">
                                                                <input class="form-check-input" type="checkbox"  {{$type->group_appt == 1 ? 'checked' : '' }} name="groupAppointment">
                                                                <label class="form-check-label" for="customCheckcolor1">
                                                                    Group Appointment
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-checkbox-outline form-check-primary mb-3">
                                                                <input class="form-check-input" type="checkbox" name="clientCanBook" {{$type->client_can_book == 1 ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="customCheckcolor1">
                                                                    Clients can book this appointment type
                                                                </label>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="form-check form-radio-outline form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" name="allClientBook" {{$type->all_client_book == 1 ? 'checked' : '' }}>
                                                                    <label class="form-check-label" >
                                                                        All clients can book
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-radio-outline form-radio-primary mb-3">
                                                                    <input class="form-check-input" type="radio" name="allClientBook" {{$type->all_client_book == 2 ? 'checked' : ''}}>
                                                                    <label class="form-check-label" >
                                                                        Only visible to specific clients
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">LENGTH</label>
                                                                        <select name="length" id="" class="form-control">
                                                                            @for($i = 5; $i<=750; $i+=15)
                                                                                <option value="{{$i}}" {{$type->length == $i ? 'selected' : '' }}>{{$i}}</option>
                                                                            @endfor
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Contact Types</label>
                                                                        <div class="form-check mb-3">
                                                                            <input class="form-check-input" name="telehealth" type="checkbox" {{$type->telehealth == 1 ? 'checked' : '' }}>
                                                                            <label class="form-check-label">
                                                                                <i class="bx bx-video mr-2"></i> Telehealth
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check mb-3">
                                                                            <input class="form-check-input" name="inPerson" type="checkbox" {{$type->in_person == 1 ? 'checked' : '' }}>
                                                                            <label class="form-check-label">
                                                                                <i class="bx bx-building-house mr-2"></i> In Person
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check mb-3">
                                                                            <input class="form-check-input" name="phoneCall" type="checkbox" {{$type->phone_call == 1 ? 'checked' : '' }}>
                                                                            <label class="form-check-label">
                                                                                <i class="bx bx-phone-call mr-2"></i> Phone Call
                                                                            </label>
                                                                        </div>
                                                                        <input type="hidden" name="apptId" value="{{$type->id}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group d-flex justify-content-center mt-5">
                                                                <button class="btn btn-primary">Save changes <i class="bx bx-right-arrow"></i> </button>
                                                            </div>
                                                        </form>
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
    <div class="modal right fade" id="addAppointmentType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title" id="myModalLabel2">New Appointment Type</h4>
                </div>

                <div class="modal-body">
                    <form action="{{route('appointment-types-settings')}}" method="post" id="appointmentType" data-parsley-validate="">
                        @csrf
                       <div class="form-group mb-3">
                           <label for="">Name</label>
                           <input type="text" name="name" required data-parsley-required-message="Give a name to this appointment type..." placeholder="Ex: Nutrition Consultation" class="form-control">
                       </div>
                        <div class="form-check form-checkbox-outline form-check-primary mb-3">
                            <input class="form-check-input" type="checkbox"  checked="" name="groupAppointment">
                            <label class="form-check-label" for="customCheckcolor1">
                                Group Appointment
                            </label>
                        </div>
                        <div class="form-check form-checkbox-outline form-check-primary mb-3">
                            <input class="form-check-input" type="checkbox" name="clientCanBook" id="clientCanBook" checked="">
                            <label class="form-check-label" for="customCheckcolor1">
                                Clients can book this appointment type
                            </label>
                        </div>
                        <div class="ml-4">
                            <div class="form-check form-radio-outline form-radio-primary mb-3">
                                <input class="form-check-input" type="radio" name="allClientBook" checked="">
                                <label class="form-check-label" >
                                   All clients can book
                                </label>
                            </div>
                            <div class="form-check form-radio-outline form-radio-primary mb-3">
                                <input class="form-check-input" type="radio" name="allClientBook">
                                <label class="form-check-label" >
                                    Only visible to specific clients
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">LENGTH</label>
                                    <select name="length" id="" class="form-control">
                                        @for($i = 5; $i<=750; $i+=15)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Contact Types</label>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" name="telehealth" type="checkbox" id="formCheck2" checked="">
                                        <label class="form-check-label">
                                            <i class="bx bx-video mr-2"></i> Telehealth
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" name="inPerson" type="checkbox" id="formCheck2" checked="">
                                        <label class="form-check-label">
                                            <i class="bx bx-building-house mr-2"></i> In Person
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" name="phoneCall" type="checkbox" id="formCheck2" checked="">
                                        <label class="form-check-label">
                                            <i class="bx bx-phone-call mr-2"></i> Phone Call
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center mt-5">
                            <button class="btn btn-primary">Save <i class="bx bx-right-arrow"></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('right-sidebar')

@endsection
@section('extra-scripts')
    <script src="/assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="/js/parsley.js"></script>
    <script>
        $(document).ready(function(){
            $('#appointmentType').parsley().on('field:validated', function() {
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
