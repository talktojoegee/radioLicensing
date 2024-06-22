
@extends('layouts.master-layout')
@section('current-page')
    New Application
@endsection
@section('extra-styles')
    <link href="/css/parsley.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
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
                <div class="row mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="modal-header ">New License Application</h5>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12">
                                    <form action="{{ route('publish-timeline-post') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row mt-3 from-message">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Purpose <sup class="text-danger">*</sup></label>
                                                            <textarea name="postContent" rows="5" id="memo" style="resize: none" placeholder="Kindly state the purpose of your application here..." class="form-control content">{{ old('postContent') }}</textarea>
                                                            @error('postContent') <i class="text-danger">{{ $message }}</i> @enderror
                                                            <input type="hidden" name="type" value="2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3" >
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label"> Attachment(s) <small>(Optional)</small>
                                                            </label> <br>
                                                            <input type="file" name="attachments[]" multiple class="form-control-file">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <h5 class="modal-header ">Device Information</h5>
                                                    <div class="container" id="products">
                                                        <div class="row mb-3 item">
                                                            <div class="col-md-12 d-flex justify-content-end">
                                                                <a href="javascript:void(0);" class="remove-line"><i class="bx bx-trash text-danger " style="cursor: pointer; color: #ff0000 !important;"></i> Remove Item</a>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <h4>Device</h4>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="">Radio Station</label>
                                                                            <select name="workstation[]" id="workstationa" class="form-control js-example-theme-single select-workstation">
                                                                                <option selected disabled>Select workstation</option>
                                                                                {{--foreach($work_stations as $station)
                                                                                    <option value="{{$station->id}}">{{$station->work_station_name ?? '' }}</option>
                                                                                endforeach--}}
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Category</label>
                                                                            <select name="licence_category[]" id="licence_category1" class="form-control js-example-theme-single select-license-category">
                                                                                <option selected disabled>Select Licence Category</option>
                                                                                {{--foreach($licence_categories as $cat)
                                                                                    <option value="{{$cat->id}}">{{$cat->category_name ?? '' }}</option>
                                                                                endforeach--}}
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">If Others</label>
                                                                            <input type="text" name="other_category[]" placeholder="Type other category" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="">Type of Device</label>
                                                                            <select name="type_of_device[]" id="type_of_device1"  class="form-control js-example-theme-single select-device-type">
                                                                                <option selected disabled>Select type of device</option>
                                                                                <option value="1">Hand held</option>
                                                                                <option value="2">Base station</option>
                                                                                <option value="3">Repeaters station</option>
                                                                                <option value="4">Vehicular station</option>
                                                                            </select>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="">No. of Device</label>
                                                                            <input name="no_of_devices[]"  class="form-control" placeholder="No. of Devices">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h4>Frequency</h4>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="">Mode of Operation</label>
                                                                            <select name="operation_mode[]" id="modeOfOperation" class="form-control js-example-theme-single select-operation-mode">
                                                                                <option value="1">Simplex</option>
                                                                                <option value="2">Duplex</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="">Frequency Band</label>
                                                                            <select name="frequency_band[]" id="frequencyBand" class="form-control js-example-theme-single select-frequency-band">
                                                                                <option value="1">MF/HF</option>
                                                                                <option value="2">VHF</option>
                                                                                <option value="3">UHF</option>
                                                                                <option value="4">SHF</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                            <button class="btn btn-sm btn-warning add-line" type="button"> <i class="bx bx-plus-circle mr-2"></i> Add more</button>
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
    <script src="/js/parsley.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"></script>
    <script src="/assets/libs/select2/js/select2.min.js"></script>
    <script src="/assets/js/pages/form-advanced.init.js"></script>
    <script>
        $(document).ready(function(){

            $(document).on('click', '.add-line', function(e){
                e.preventDefault();
                let new_selection = $('.item').first().clone();
                $('#products').append(new_selection);

                $(".js-example-theme-single").select2({
                    placeholder: "Select product or service"
                });
                $(".select-workstation").last().next().next().remove();
                $(".select-device-type").last().next().next().remove();
                $(".select-license-category").last().next().next().remove();
                $(".select-operation-mode").last().next().next().remove();
                $(".select-frequency-band").last().next().next().remove();
            });

            $(document).on('click', '.remove-line', function(e){
                e.preventDefault();
                $(this).closest('.item').remove();
            });


            $('.content').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]

            });
        })


    </script>
@endsection
