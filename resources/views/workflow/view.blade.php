@extends('layouts.master-layout')
@section('title')
    Workflow Overview
@endsection
@section('current-page')
    Workflow Overview
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/assets/libs/owl.carousel/assets/owl.carousel.min.css">

    <link rel="stylesheet" href="/assets/libs/owl.carousel/assets/owl.theme.default.min.css">
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary "> <i
                                class="bx bx bxs-left-arrow"></i> Go back</a>
                        <a href="#" class="btn btn-primary">Process Workflow <i class="bx bxs-timer"></i> </a>
                    </div>

                    @if(session()->has('success'))
                        <div class="card-body">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-check-all me-2"></i>
                                {!! session()->get('success') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-close me-2"></i>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Workflow Timeline</h4>

                        <div class="hori-timeline">
                            <div class="owl-carousel owl-theme navs-carousel events owl-loaded owl-drag"
                                 id="timeline-carousel">


                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                         style="transform: translate3d(-587px, 0px, 0px); transition: all 0.25s ease 0s; width: 1761px;">
                                        <div class="owl-item" style="width: 293.5px;">
                                            <div class="item event-list">
                                                <div>
                                                    <div class="d-flex justify-content-center">
                                                        <img src="/assets/images/users/avatar-3.jpg" style="height: 64px; width: 64px;" alt="" class="rounded-circle avatar-sm">
                                                        <i class="bx bx-right-arrow-circle font-size-22" style="margin-top: 15px; margin-left: 10px;"></i>
                                                    </div>

                                                    <div class="mt-3 px-3">
                                                        <p class="text-muted">It will be as simple as occidental in fact
                                                            it will be Cambridge</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 293.5px;">
                                            <div class="item event-list">
                                                <div>
                                                    <div class="event-down-icon">
                                                        <i class="bx bx-check-circle h1 text-success down-arrow-icon"></i>
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <img src="/assets/images/users/avatar-3.jpg" style="height: 64px; width: 64px;" alt="" class="rounded-circle avatar-sm">
                                                    </div>

                                                    <div class="mt-3 px-3">
                                                        <p class="text-muted">To an English person, it will seem like
                                                            simplified English existence.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 293.5px;">
                                            <div class="item event-list">
                                                <div>
                                                    <div class="event-down-icon">
                                                        <i class="bx bx-x-circle h1 text-warning down-arrow-icon"></i>
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <img src="/assets/images/users/avatar-3.jpg" style="height: 64px; width: 64px;" alt="" class="rounded-circle avatar-sm">
                                                    </div>

                                                    <div class="mt-3 px-3">
                                                        <p class="text-muted">To an English person, it will seem like
                                                            simplified English existence.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item active" style="width: 293.5px;">
                                            <div class="item event-list">
                                                <div>
                                                    <div class="event-down-icon">
                                                        <i class="bx bx-check-double h1 text-success down-arrow-icon"></i>
                                                    </div>

                                                    <div class="mt-3 px-3">
                                                        <p class="text-muted">yes It will be as simple as occidental in fact
                                                            it will be Cambridge</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item active" style="width: 293.5px;">
                                            <div class="item event-list active">
                                                <div>
                                                    <div class="event-down-icon">
                                                        <i class="bx bx-down-arrow-circle h1 text-primary down-arrow-icon"></i>
                                                    </div>

                                                    <div class="mt-3 px-3">
                                                        <p class="text-muted">For science, music, sport, etc, Europe
                                                            uses the same vocabulary.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item active" style="width: 293.5px;">
                                            <div class="item event-list">
                                                <div>
                                                    <div class="event-down-icon">
                                                        <i class="bx bx-down-arrow-circle h1 text-primary down-arrow-icon"></i>
                                                    </div>

                                                    <div class="mt-3 px-3">
                                                        <p class="text-muted">New common language will be more simple
                                                            than existing.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item active" style="width: 293.5px;">
                                            <div class="item event-list">
                                                <div>
                                                    <div class="event-down-icon">
                                                        <i class="bx bx-down-arrow-circle h1 text-primary down-arrow-icon"></i>
                                                    </div>

                                                    <div class="mt-3 px-3">
                                                        <p class="text-muted">To an English person, it will seem like
                                                            simplified English existence.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="text-truncate font-size-15">{{$workflow->p_title ?? '' }}</h5>
                                <p class="text-muted">
                                    <strong>Date: </strong>{{date('d M, Y', strtotime($workflow->created_at))}}</p>
                            </div>
                        </div>
                        <h5 class="font-size-15 mt-4"> Details :</h5>
                        {!! $workflow->p_content ?? '' !!}

                        <div class="row task-dates">
                            <div class="col-sm-4 col-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-primary"></i> Start Date
                                    </h5>
                                    <p class="text-muted mb-0">08 Sept, 2019</p>
                                </div>
                            </div>

                            <div class="col-sm-4 col-6">
                                <div class="mt-4">
                                    <h5 class="font-size-14"><i class="bx bx-calendar-check me-1 text-primary"></i> Due
                                        Date</h5>
                                    <p class="text-muted mb-0">12 Oct, 2019</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Leave comment</h4>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap">
                                <tbody>
                                <tr>
                                    <td style="width: 50px;"><img src="assets/images/users/avatar-2.jpg"
                                                                  class="rounded-circle avatar-xs" alt=""></td>
                                    <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Daniel
                                                Canales</a></h5></td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);"
                                               class="badge bg-primary bg-soft text-primary font-size-11">Frontend</a>
                                            <a href="javascript: void(0);"
                                               class="badge bg-primary bg-soft text-primary font-size-11">UI</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xs"
                                             alt=""></td>
                                    <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Jennifer
                                                Walker</a></h5></td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);"
                                               class="badge bg-primary bg-soft text-primary font-size-11">UI / UX</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="avatar-xs">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                                    C
                                                                </span>
                                        </div>
                                    </td>
                                    <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Carl
                                                Mackay</a></h5></td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);"
                                               class="badge bg-primary bg-soft text-primary font-size-11">Backend</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="assets/images/users/avatar-4.jpg" class="rounded-circle avatar-xs"
                                             alt=""></td>
                                    <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Janice
                                                Cole</a></h5></td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);"
                                               class="badge bg-primary bg-soft text-primary font-size-11">Frontend</a>
                                            <a href="javascript: void(0);"
                                               class="badge bg-primary bg-soft text-primary font-size-11">UI</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="avatar-xs">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                                    T
                                                                </span>
                                        </div>
                                    </td>
                                    <td><h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Tony
                                                Brafford</a></h5></td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);"
                                               class="badge bg-primary bg-soft text-primary font-size-11">Backend</a>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    </div>



@endsection

@section('extra-scripts')
    <script src="/assets/libs/owl.carousel/owl.carousel.min.js"></script>
    <script src="/assets/js/pages/timeline.init.js"></script>
@endsection
