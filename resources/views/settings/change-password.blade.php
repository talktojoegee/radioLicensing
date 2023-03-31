@extends('layouts.master-layout')
@section('current-page')
    Change Password
@endsection
@section('extra-styles')

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
    @if($errors->any())
        <div class="row" role="alert">
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-alert-outline me-2"></i>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
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
                    <div class="h4 text-center">Change Password</div>
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
                    <div class="container pb-5">
                        <form action="{{route('change-password')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Current Password <span class="text-danger">*</span></label>
                                <input type="password"  name="currentPassword" placeholder="Current Password"  class="form-control">
                                @error('currentPassword') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">New Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" placeholder="New Password" class="form-control">
                                @error('password') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Re-type Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" placeholder="Re-type Password" class="form-control">
                                @error('password_confirmation') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Change Password <i class="bx bx-lock-alt"></i> </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')
    <script src="/js/axios.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#country").on("change", (e) => {
                e.preventDefault();
                axios.post("{{route('get-states')}}", {
                    countryId:$('#country').val()
                })
                    .then(res=>{
                        $('#stateWrapper').html(res.data);
                    })
                    .catch(err=>{
                    });

            });
        });
    </script>

@endsection
