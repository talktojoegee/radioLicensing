
@extends('layouts.master-layout')
@section('title')
    {{$station->name ?? ''}} Workstation
@endsection
@section('current-page')
{{$station->name ?? ''}} Workstation
@endsection
@section('extra-styles')
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6  col-sm-6 col-lg-6 ">
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
                <div class="row ">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="modal-header ">{{$station->name ?? ''}} Workstation</h5>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-1" >
                                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Station Name</label>
                                                <p class="text-muted">{{$station->name ?? ''}} </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mt-1" >
                                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Station Contact Mobile No.</label>
                                                <p class="text-muted">{{$station->mobile_no ?? ''}} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-1" >
                                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Longitude</label>
                                                <p class="text-muted">{{$station->long ?? ''}} </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mt-1" >
                                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Latitude</label>
                                                <p class="text-muted">{{$station->lat ?? ''}} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-1" >
                                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Location</label>
                                                <p class="text-muted">{{$station->getLocation->name ?? ''}} </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mt-1" >
                                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Status</label>
                                                <p class="text-muted">{{ $station->status == 1 ? 'Active' : 'Inactive'}} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-1" >
                                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Operation Schedule</label>
                                                <p class="text-muted">
                                                    @if($station->operation_schedule == 1)
                                                        Day
                                                    @elseif($station->operation_schedule == 2)
                                                        Night
                                                    @else
                                                        Both(Day & Night)
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mt-1" >
                                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Address</label>
                                                <p class="text-muted">{{ $station->address ?? null }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-1" >
                                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Created By</label>
                                                <p class="text-muted">
                                                    {{$station->getCreatedBy->title ?? '' }} {{$station->getCreatedBy->first_name ?? '' }} {{$station->getCreatedBy->last_name ?? '' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d787.428939493416!2d144.98094691990784!3d-37.866940738858574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzfCsDUyJzAxLjEiUyAxNDTCsDU4JzUwLjIiRQ!5e0!3m2!1sen!2sng!4v1718116188983!5m2!1sen!2sng" width="550" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="modal-header bg-warning text-white ">Edit {{$station->name ?? ''}} Workstation</h5>
                        <form action="{{ route('edit-workstation') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="stationId" value="{{$station->id}}" class="form-control">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mt-3 from-message">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Name <sup class="text-danger">*</sup></label>
                                                <input type="text" value="{{ old('stationName', $station->name) }}" name="stationName" placeholder="Enter workstation name" class="form-control">
                                                @error('stationName') <i class="text-danger">{{ $message }}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 from-message">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Mobile No. <sup class="text-danger">*</sup></label>
                                                <input type="text" value="{{ old('mobileNo', $station->mobile_no) }}" name="mobileNo" placeholder="Contact mobile no." class="form-control">
                                                @error('mobileNo') <i class="text-danger">{{ $message }}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 from-message">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Longitude <sup class="text-danger">*</sup></label>
                                                <input type="text" value="{{ old('long',$station->long) }}" name="long" placeholder="Enter longitude" class="form-control">
                                                @error('long') <i class="text-danger">{{ $message }}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 from-message">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Latitude <sup class="text-danger">*</sup></label>
                                                <input type="text" value="{{ old('lat',$station->lat) }}" name="lat" placeholder="Enter latitude" class="form-control">
                                                @error('lat') <i class="text-danger">{{ $message }}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 from-message">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Location <sup class="text-danger">*</sup></label>
                                                <select name="location" id="location"  class="form-control select2">
                                                    @foreach($locations as $location)
                                                        <option {{ $location->id == $station->transmitter_location ? 'selected' : null }} value="{{$location->id}}">{{ $location->name ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                @error('lat') <i class="text-danger">{{ $message }}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 from-message">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Is this a workstation active? <sup class="text-danger">*</sup></label>
                                                <select name="status"  class="form-control">
                                                    <option value="1" {{ $station->status == 1 ? 'selected' : null }}>Yes</option>
                                                    <option value="0" {{ $station->status == 0 ? 'selected' : null }}>No</option>
                                                </select>
                                                @error('status') <i class="text-danger">{{ $message }}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 from-message">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Operation Schedule<sup class="text-danger">*</sup></label>
                                                <select name="dayTime"  class="form-control">
                                                    <option value="1" {{ $station->operation_schedule == 1 ? 'selected' : null }}>Day</option>
                                                    <option value="2" {{ $station->operation_schedule == 2 ? 'selected' : null }}>Night</option>
                                                    <option value="3" {{ $station->operation_schedule == 3 ? 'selected' : null }}>Both</option>
                                                </select>
                                                @error('dayTime') <i class="text-danger">{{ $message }}</i> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 from-message">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Address <sup class="text-danger">*</sup></label>
                                                <input type="text" name="address" value="{{ old('address', $station->address) }}" placeholder="Enter address" class="form-control">
                                                @error('address') <i class="text-danger">{{ $message }}</i> @enderror
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="card-footer text-right d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary ">Save changes <i class="bx bxs-right-arrow"></i> </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>


@endsection

@section('extra-scripts')
    <script src="/assets/libs/select2/js/select2.min.js"></script>
    <script src="/assets/js/pages/form-advanced.init.js"></script>

@endsection
