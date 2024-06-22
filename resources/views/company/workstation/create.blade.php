
@extends('layouts.master-layout')
@section('title')
    New Workstation
@endsection
@section('current-page')
    New Workstation
@endsection
@section('extra-styles')
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-6 offset-sm-3 col-lg-6 offset-lg-3">
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
                <div class="row mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="modal-header ">New Work Station</h5>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <form action="{{ route('show-create-workstation') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row mt-3 from-message">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Name <sup class="text-danger">*</sup></label>
                                                            <input type="text" value="{{ old('stationName') }}" name="stationName" placeholder="Enter workstation name" class="form-control">
                                                            @error('stationName') <i class="text-danger">{{ $message }}</i> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3 from-message">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Mobile No. <sup class="text-danger">*</sup></label>
                                                            <input type="text" value="{{ old('mobileNo') }}" name="mobileNo" placeholder="Contact mobile no." class="form-control">
                                                            @error('mobileNo') <i class="text-danger">{{ $message }}</i> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3 from-message">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Longitude <sup class="text-danger">*</sup></label>
                                                            <input type="text" value="{{ old('long') }}" name="long" placeholder="Enter longitude" class="form-control">
                                                            @error('long') <i class="text-danger">{{ $message }}</i> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3 from-message">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Latitude <sup class="text-danger">*</sup></label>
                                                            <input type="text" value="{{ old('lat') }}" name="lat" placeholder="Enter latitude" class="form-control">
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
                                                                    <option value="{{$location->id}}">{{ $location->name ?? '' }}</option>
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
                                                                <option value="1">Yes</option>
                                                                <option value="0">No</option>
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
                                                                <option value="1">Day</option>
                                                                <option value="2">Night</option>
                                                                <option value="3">Both</option>
                                                            </select>
                                                            @error('dayTime') <i class="text-danger">{{ $message }}</i> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3 from-message">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Address <sup class="text-danger">*</sup></label>
                                                            <input type="text" name="address" value="{{ old('address') }}" placeholder="Enter address" class="form-control">
                                                            @error('address') <i class="text-danger">{{ $message }}</i> @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="card-footer text-right d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary ">Submit <i class="bx bxs-right-arrow"></i> </button>
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


@endsection

@section('extra-scripts')
    <script src="/assets/libs/select2/js/select2.min.js"></script>
    <script src="/assets/js/pages/form-advanced.init.js"></script>

@endsection
