<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Reset Password" name="description" />
    <meta content="{{env('APP_NAME')}}" name="author" />
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="//assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-5 text-muted">
                    <a href="index.html" class="d-block auth-logo">
                        <img src="/assets/images/logo-dark.png" alt="" height="20" class="auth-logo-dark mx-auto">
                        <img src="/assets/images/logo-light.png" alt="" height="20" class="auth-logo-light mx-auto">
                    </a>
                    <p class="mt-3 h4">You're doing well!</p>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-8 col-xl-8">
                <div class="card">

                    <div class="card-body">

                        <div class="p-2">
                            <div class="text-center">
                                <div class="p-2 mt-4">
                                    <h4>Reset Password</h4>
                                    <p class="text-muted">Now that you're here, choose a new password. Then confirm to reset your password for this account.</p>
                                    @if (session('status'))
                                        <p class="alert alert-success">{{ session('status') }}</p>
                                    @endif
                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" readonly type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Re-type Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Reset Password') }}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mt-4 text-center">
                                             <a href="{{ route('login') }}" class="text-muted"> Login Here</a>  | <a href="{{ route('password.request') }}" class="text-muted"> Reset Password</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">

                    <p>© <script>document.write(new Date().getFullYear())</script>
                        {{env('APP_NAME')}}.</p>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="/assets/libs/jquery/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/libs/node-waves/waves.min.js"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>

