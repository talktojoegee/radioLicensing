
@extends('layouts.master-layout')
@section('current-page')
    Homepage
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
                    <div class="card-header bg-primary text-white">Homepage</div>
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Settings</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Services</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="home1" role="tabpanel">
                                <form action="{{route('website-homepage-settings')}}" method="post" enctype="multipart/form-data">

                                    @csrf
                                    <div class="row mt-3">
                                        <input type="hidden" name="homepageId" value="{{ Auth::user()->getUserHomepageSettings->id}}">
                                        <div class="card-deck-wrapper mt-2">
                                            <div class="card-group">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Slider</h4>
                                                        <p class="card-text">Help us customize your slider</p>
                                                        <div class="form-group">
                                                            <label for="">Caption</label>
                                                            <input type="text" class="form-control" name="sliderCaption" value="{{old('sliderCaption', Auth::user()->getUserHomepageSettings->slider_caption)}}" placeholder="Slider Caption">
                                                            @error('sliderCaption') <i class="text-danger">{{$message}}</i> @enderror
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="">Slider Image</label> <br>
                                                            <input type="file" class="form-control-file" name="sliderImage" value="{{old('sliderImage')}}" placeholder="Slider Image">
                                                            @if(!empty(Auth::user()->getUserHomepageSettings->slider_image))
                                                                <img class="img-thumbnail" alt="200x200" width="200" src="{{url('storage/'.Auth::user()->getUserHomepageSettings->slider_image)}}" data-holder-rendered="true">
                                                            @endif
                                                            @error('sliderImage') <i class="text-danger">{{$message}}</i> @enderror
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="">Button Text</label>
                                                            <input type="text" class="form-control" name="BtnText" value="{{old('BtnText',Auth::user()->getUserHomepageSettings->slider_cta_btn)}}" placeholder="Button Text">
                                                            @error('BtnText') <i class="text-danger">{{$message}}</i> @enderror
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="">Caption Details</label>
                                                            <textarea class="form-control" style="resize: none;" name="captionDetails" placeholder="Caption Details">{{old('captionDetails',Auth::user()->getUserHomepageSettings->slider_caption_detail)}}</textarea>
                                                            @error('captionDetails') <i class="text-danger">{{$message}}</i> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Appointments</h4>
                                                        <div class="form-group mt-3">
                                                            <label for="">Button Text</label>
                                                            <input type="text" class="form-control" name="appointmentBtnText" value="{{old('appointmentBtnText',Auth::user()->getUserHomepageSettings->appointment_cta_btn)}}" placeholder="Button Text">
                                                            @error('appointmentBtnText') <i class="text-danger">{{$message}}</i> @enderror
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="">Brief Description</label>
                                                            <textarea class="form-control" style="resize: none;" name="briefDescription" placeholder="Brief Description">{{old('briefDescription', Auth::user()->getUserHomepageSettings->appointment_detail)}}</textarea>
                                                            @error('briefDescription') <i class="text-danger">{{$message}}</i> @enderror
                                                        </div>
                                                        <h4 class="card-title mt-3">Emergency</h4>
                                                        <div class="form-group">
                                                            <label for="">Button Text</label>
                                                            <input type="text" class="form-control" name="emergencyBtnText" value="{{old('emergencyBtnText',Auth::user()->getUserHomepageSettings->emergency_btn)}}" placeholder="Button Text">
                                                            @error('emergencyBtnText') <i class="text-danger">{{$message}}</i> @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Brief Description</label>
                                                            <textarea class="form-control" style="resize: none;" name="emergencyDescription" placeholder=" Description">{{old('emergencyDescription',Auth::user()->getUserHomepageSettings->emergency_detail)}}</textarea>
                                                            @error('emergencyDescription') <i class="text-danger">{{$message}}</i> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-group" style="margin-top: -25px;">
                                                <div class="card mb-0">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Welcome Message</h4>
                                                        <div class="form-group">
                                                            <label for="">Written By</label>
                                                            <input type="text" class="form-control col-md-8" name="writtenBy" value="{{old('writtenBy',Auth::user()->getUserHomepageSettings->welcome_written_by)}}" placeholder="Written By">
                                                            @error('writtenBy') <i class="text-danger">{{$message}}</i> @enderror
                                                        </div>
                                                        <div class="form-group">

                                                            @if(!empty(Auth::user()->getUserHomepageSettings->welcome_featured_img))
                                                                <img class="img-thumbnail" alt="200x200" width="200" src="{{url('storage/'.Auth::user()->getUserHomepageSettings->welcome_featured_img)}}" data-holder-rendered="true">
                                                                <br>
                                                            @endif
                                                                <label for="">Featured Image</label> <br>
                                                                <input type="file" class="form-control-file" name="featuredImage" value="{{old('featuredImage')}}" placeholder="Featured Image">
                                                                @error('featuredImage') <i class="text-danger">{{$message}}</i> @enderror
                                                        </div>

                                                        <div class="form-group mt-3">
                                                            <label for="">Message</label>
                                                            <textarea name="welcomeMessage"
                                                                      class="form-control" id="welcomeMessage" placeholder="Type welcome message here...">{{old('welcomeMessage',Auth::user()->getUserHomepageSettings->welcome_message)}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex mt-3 justify-content-center">
                                        <button type="submit" class="btn btn-primary">Save Settings <i class="bx bx-right-arrow"></i> </button>
                                    </div>

                                </form>
                            </div>
                            <div class="tab-pane" id="profile1" role="tabpanel">
                                <button class="btn btn-primary" data-bs-target="#addNewServiceModal" data-bs-toggle="modal">Add New Service <i class="bx bxs-plus-circle"></i> </button>
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">

                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Detail Excerpt</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $serial = 1; @endphp
                                        @forelse(Auth::user()->getOrgServices as $service)
                                            <tr>
                                                <th scope="row">{{$serial++}}</th>
                                                <td> {{$service->title ?? '' }}</td>
                                                <td>{{ strip_tags($service->description) ?? '' }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-target="#serviceModal_{{$service->id}}" data-bs-toggle="modal"> <i class="bx bxs-book-open"></i> View</a>
                                                        </div>
                                                    </div>
                                                    <div class="modal right fade" id="serviceModal_{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" style="width: 900px;">
                                                        <div class="modal-dialog modal-lg w-100" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header" >
                                                                    <h4 class="modal-title" style="text-align: center;" id="myModalLabel2">Service Details</h4>
                                                                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <form action="{{route('edit-website-service')}}" method="post">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label for="">Title</label>
                                                                            <input placeholder="Enter service title" type="text" name="title" value="{{$service->title ?? ''}}" class="form-control">
                                                                            @error('title') <i>{{$message}}</i> @enderror
                                                                            <input type="hidden" name="serviceId" value="{{$service->id}}">
                                                                        </div>
                                                                        <div class="form-group mt-3">
                                                                            <label for="">Service Icon</label>
                                                                            <select name="icon"  class="form-control">
                                                                                <option value="flaticon-dental-care">  Dental Care</option>
                                                                                <option value="flaticon-tablets">Tablets</option>
                                                                                <option value="flaticon-dental-care-1">Dental Care 1</option>
                                                                                <option value="flaticon-bionic-eye-1">Bionic Eye 1</option>
                                                                                <option value="flaticon-lungs">Lungs</option>
                                                                                <option value="flaticon-heart-beat">Heartbeat</option>
                                                                                <option value="flaticon-knives">Knives</option>
                                                                                <option value="flaticon-broken-leg">Broken Legs</option>
                                                                                <option value="flaticon-stethoscope">Stethoscope</option>
                                                                                <option value="flaticon-calendar">Calendar</option>
                                                                            </select>
                                                                            @error('icon') <i>{{$message}}</i> @enderror
                                                                        </div>
                                                                        <div class="form-group mt-3">
                                                                            <label for="">Service Description</label>
                                                                            <textarea name="description" style="resize: none;" placeholder="Type service description here..." class="form-control service">{{$service->description ?? ''}}</textarea>
                                                                            @error('description') <i>{{$message}}</i> @enderror
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No services registered</td>
                                            </tr>
                                        @endforelse

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


    <div class="modal fade" id="addNewServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-modal="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Add New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('add-website-service')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input placeholder="Enter service title" type="text" name="title" value="{{old('title')}}" class="form-control">
                            @error('title') <i>{{$message}}</i> @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Service Icon</label>
                            <select name="icon"  class="form-control">
                                <option value="">--Select an icon--</option>
                                <option value="flaticon-dental-care">  Dental Care</option>
                                <option value="flaticon-tablets">Tablets</option>
                                <option value="flaticon-dental-care-1">Dental Care 1</option>
                                <option value="flaticon-bionic-eye-1">Bionic Eye 1</option>
                                <option value="flaticon-lungs">Lungs</option>
                                <option value="flaticon-heart-beat">Heartbeat</option>
                                <option value="flaticon-knives">Knives</option>
                                <option value="flaticon-broken-leg">Broken Legs</option>
                                <option value="flaticon-stethoscope">Stethoscope</option>
                                <option value="flaticon-calendar">Calendar</option>
                            </select>
                            @error('icon') <i>{{$message}}</i> @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Service Description</label>
                            <textarea name="description" style="resize: none;" placeholder="Type service description here..." class="form-control service">{{old('description')}}</textarea>
                            @error('description') <i>{{$message}}</i> @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@section('extra-scripts')
    <script src="/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#welcomeMessage',
            height: 350,
            promotion: false,
            menu: {

            },
        });
        tinymce.init({
            selector: '.service',
            height: 350,
            promotion: false,
            menu: {

            },
        });
    </script>
@endsection
