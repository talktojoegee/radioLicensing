<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>{{config('app.name')}} | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{env('APP_NAME')}}" name="description" />
    <meta content="{{config('app.name')}}" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/drive/logo/arm.png">
    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <style>
        .error{
            color: #ff0000 !important;
        }
    </style>
</head>

<body>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        {!! session()->get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session()->has('error'))

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-outline me-2"></i>
                        {!! session()->get('error') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Welcome Back!</h5>
                                    <p>Start Your {{env('APP_NAME')}} Registration Today!</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="/assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="auth-logo">
                            <a href="#" class="auth-logo-light">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="/assets/drive/logo/arm.png" alt="" class="rounded-circle" height="64">
                                    </span>
                                </div>
                            </a>

                            <a href="{{route('login')}}" class="auth-logo-dark">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <span class="avatar-title rounded-circle bg-light">
                                        <img src="/assets/drive/logo/arm.png" alt="" class="rounded-circle" height="64">
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form action="{{ route('e-registration') }}" method="post" autocomplete="off">
                                @php $securityCode = substr(sha1(time()),34,40) @endphp
                                <input type="hidden" name="validScode" value="{{$securityCode ?? '' }}">
                                @csrf
                                <p><strong class="text-danger" style="color: #ff0000 !important;">Note: </strong>Use a valid email address for this registration. We'll send a link to the email address for you to complete this registration.</p>
                                <div class="form-group">
                                    <label class=" "><strong>Email Address</strong></label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email Address">
                                    @error('email') <i class="text-danger error">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group p-3 text-center">
                                    <h3 class="text-danger text-center" style="font-weight: 700"><code>Security Code:</code> {{$securityCode ?? '' }}</h3>
                                </div>
                                <div class="form-group">
                                    <label class=""><strong>Enter Security Code</strong></label>
                                    <input type="text" name="security_code" class="form-control" placeholder="Enter the Security Code shown above here...">
                                    @error('security_code') <i class="text-danger error">{{$message}}</i> @enderror
                                </div>
                                <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                    <div class="form-group">
                                        <a class="text-white" href="{{route('login')}}">Already Have An Account? Login here</a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary  btn-block">Verify Email <i class="bx bx-check-double"></i> </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                @include('partials._auth-footer-note')

            </div>
        </div>
    </div>
</div>
<!-- end account-pages -->

<!-- JAVASCRIPT -->
<script src="/assets/libs/jquery/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- App js -->
<script src="/assets/js/app.js"></script>
</body>
</html>

