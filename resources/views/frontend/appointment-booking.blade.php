<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Book an Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Book for an appointment" name="description" />
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
                        <img src="assets/images/logo-dark.png" alt="" height="20" class="auth-logo-dark mx-auto">
                        <img src="assets/images/logo-light.png" alt="" height="20" class="auth-logo-light mx-auto">
                    </a>
                    <p class="mt-3">We make the process as seamless as possible.</p>
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
                                    <h4>Book Appointment</h4>
                                    <p class="text-muted">We'll notify the concern persons of your...</p>
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">New Client</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                        <span class="d-none d-sm-block">Existing Client</span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content p-3 text-muted">
                                                <div class="tab-pane active" id="home1" role="tabpanel">
                                                    <p class="mb-0">
                                                        Raw denim you probably haven't heard of them jean shorts Austin.
                                                        Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
                                                        cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
                                                        butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
                                                        qui irure terry richardson ex squid. Aliquip placeat salvia cillum
                                                        iphone. Seitan aliquip quis cardigan american apparel, butcher
                                                        voluptate nisi qui.
                                                    </p>
                                                </div>
                                                <div class="tab-pane" id="profile1" role="tabpanel">
                                                    <p class="mb-0">
                                                        Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                                                        single-origin coffee squid. Exercitation +1 labore velit, blog
                                                        sartorial PBR leggings next level wes anderson artisan four loko
                                                        farm-to-table craft beer twee. Qui photo booth letterpress,
                                                        commodo enim craft beer mlkshk aliquip jean shorts ullamco ad
                                                        vinyl cillum PBR. Homo nostrud organic, assumenda labore
                                                        aesthetic magna delectus.
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
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
