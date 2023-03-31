@extends('layouts.master-layout')
@section('current-page')
    Appointment Locations
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
                    <div class="h4 card-header bg-primary text-white mb-4">Appointment Locations</div>
                    <div class="container pb-5">
                        <div class="mb-3">
                            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addAppointmentLocationModal">Add New Location <i class="bx bxs-plus-circle"></i> </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">

                                <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Can be Booked By Client</th>
                                    <th>Has Rooms</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $serial = 1;@endphp
                                @foreach($locations as $location)
                                    <tr>
                                        <th scope="row">{{$serial++}}</th>
                                        <td>{{$location->location_name ?? '' }}</td>
                                        <td>{!! $location->booked_by_client == 1 ? "<i class='bx bxs-check-circle text-success'></i>" : "<i class='bx bxs-x-circle text-danger'></i>" !!}</td>
                                        <td>{!! $location->has_rooms == 1 ? "<i class='bx bxs-check-circle text-success'></i>" : "<i class='bx bxs-x-circle text-danger'></i>" !!}</td>
                                        <td>
                                            <div class="btn-group">
                                                <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-target="#editAppointmentLocationsModal_{{$location->id}}" data-bs-toggle="modal"> <i class="bx bxs-book-open"></i> View</a>
                                                </div>
                                            </div>
                                            <div class="modal right fade" id="editAppointmentLocationsModal_{{$location->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header" >
                                                            <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            <h4 class="modal-title" id="myModalLabel2">Edit Appointment Location</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('edit-appt-locations')}}" method="post" id="appointmentLocation" data-parsley-validate="">
                                                                @csrf
                                                                <div class="form-group mb-3">
                                                                    <label for="">Location Name</label>
                                                                    <input type="text" name="locationName" value="{{$location->location_name ?? '' }}" required data-parsley-required-message="What's the name of this location?" placeholder="Ex: Main Office" class="form-control">
                                                                </div>
                                                                <div class="form-check form-checkbox-outline form-check-primary mb-3">
                                                                    <input class="form-check-input" type="checkbox"  {{$location->booked_by_client == 1 ? 'checked' : '' }} name="bookedByClient">
                                                                    <label class="form-check-label" >
                                                                        Can be booked by clients
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-checkbox-outline form-check-primary mb-3">
                                                                    <input class="form-check-input" type="checkbox" name="locationHasRoom" {{$location->has_rooms == 1 ? 'checked' : '' }}>
                                                                    <label class="form-check-label">
                                                                        Location has rooms
                                                                    </label>
                                                                    <input type="hidden" name="locationId" value="{{$location->id}}">
                                                                </div>
                                                                <div class="form-group d-flex justify-content-center mt-5">
                                                                    <button class="btn btn-primary">Save <i class="bx bx-right-arrow"></i> </button>
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
    <div class="modal right fade" id="addAppointmentLocationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title" id="myModalLabel2">New Appointment Location</h4>
                </div>

                <div class="modal-body">
                    <form action="{{route('appt-locations')}}" method="post" id="appointmentLocation" data-parsley-validate="">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Location Name</label>
                            <input type="text" name="locationName" required data-parsley-required-message="What's the name of this location?" placeholder="Ex: Main Office" class="form-control">
                        </div>
                        <div class="form-check form-checkbox-outline form-check-primary mb-3">
                            <input class="form-check-input" type="checkbox"  checked name="bookedByClient">
                            <label class="form-check-label" >
                                Can be booked by clients
                            </label>
                        </div>
                        <div class="form-check form-checkbox-outline form-check-primary mb-3">
                            <input class="form-check-input" type="checkbox" name="locationHasRoom" >
                            <label class="form-check-label" for="customCheckcolor1">
                                Location has rooms
                            </label>
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
            $('#appointmentLocation').parsley().on('field:validated', function() {
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
