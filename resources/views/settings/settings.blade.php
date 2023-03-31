@extends('layouts.master-layout')
@section('current-page')
     Settings
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
                    <div class="h4 text-center">Your Account</div>
                    <div class="container pb-5">
                        <form action="{{route('save-account-settings')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">First Name <span class="text-danger">*</span></label>
                                <input type="text"  name="firstName" placeholder="First Name" value="{{Auth::user()->first_name ?? '' }}"  class="form-control">
                                @error('firstName') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="lastName" value="{{Auth::user()->last_name ?? '' }}" placeholder="Last Name" class="form-control">
                                @error('lastName') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Email <span class="text-danger">*</span></label>
                                <input readonly type="text" value="{{Auth::user()->email ?? '' }}" name="email" placeholder="Email" class="form-control">
                                @error('email') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Cellphone Number</label>
                                <input type="text" name="cellphoneNumber" value="{{Auth::user()->cellphone_no ?? '' }}" placeholder="Cellphone Number" class="form-control">
                                @error('cellphoneNumber') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Profile Picture</label> <br>
                                <input type="file" name="profilePicture" class="form-control-file">
                                @error('profilePicture') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Country<span class="text-danger">*</span></label>
                                <select name="country" id="country" class="form-control select2">
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" {{$country->id == Auth::user()->country_id ? 'selected' : ''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @error('country') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3" id="stateWrapper">

                            </div>
                            <div class="form-group mt-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Save changes <i class="bx bx-right-arrow"></i> </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')
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
