
@extends('layouts.master-layout')
@section('current-page')
    Create A Page
@endsection
@section('extra-styles')


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
            <div class="col-md-10 offset-1 ">
                <div class="card">
                    <div class="card-header bg-primary text-white">Create A Page</div>
                    <div class="card-body">
                        <a href="{{route('web-pages')}}" class="btn btn-primary btn-rounded waves-effect waves-light mb-3">All Pages</a>
                        <p>Create forms for capturing Email and phone leads with specific targeting, such as kids' classes or starting a free 14 day trial.</p>

                        <form action="{{route('create-web-page')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="row">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Page Title</h5>
                                        <input type="text" placeholder="Page Title" name="pageTitle" value="{{old('pageTitle')}}" class="form-control col-md-8">
                                        @error('pageTitle') <i class="text-danger">{{$message}}</i> @enderror
                                    </div>
                                    <div class="form-group mt-4">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Show in website menu?</label>
                                                    <div>
                                                        <input type="checkbox" id="switch6" switch="primary" checked="">
                                                        <label for="switch6" data-on-label="Yes" data-off-label="No"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Password protected?</label>
                                                    <div>
                                                        <input type="checkbox" id="switch7" switch="primary" >
                                                        <label for="switch7" data-on-label="Yes" data-off-label="No"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Password</label>
                                                    <input type="password" name="password" placeholder="Choose password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <h5>Feature Image <small>(Optional)</small></h5>
                                        <input type="file" name="featuredImage" value="{{old('featuredImage')}}" class="form-control-file">
                                        @error('featuredImage') <i class="text-danger">{{$message}}</i> @enderror
                                    </div>
                                    <div class="form-group mt-4">
                                        <h5>Page Description</h5>
                                        <textarea name="pageDescription" style="resize: none;" placeholder="Type page description here..." class="form-control">{{old('pageDescription')}}</textarea>
                                        @error('pageDescription') <i class="text-danger">{{$message}}</i> @enderror
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center mt-3">
                                    <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light">Create Page</button>
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
    <script src="/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 350,
            promotion: false,
            menu: {

            },
        });
    </script>
@endsection
