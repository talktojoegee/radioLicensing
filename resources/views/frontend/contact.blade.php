@extends('layouts.frontend-layout')
@section('orgName')
    Org
@endsection

@section('title')
    Home
@endsection

@section('extra-styles')

@endsection

@section('main-content')
    <!-- Start Subheader -->
    <div class="sub-header p-relative">
        <div class="overlay overlay-bg-black"></div>
        <div class="pattern"></div>
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="sub-header-content p-relative">
                            <h1 class="text-custom-white lh-default fw-600">Contact Us</h1>
                            <ul class="custom">
                                <li>
                                    <a href="index.html" class="text-custom-white">Home</a>
                                </li>
                                <li class="text-custom-white active">Contact Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Subheader -->
    <!-- Start Contact -->
    <section class="section-padding bg-light-white contact-us">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-4 mb-md-80">
                    <div class="contact-form full-height align-self-center bx-wrapper bg-custom-white">
                        <h4 class="text-custom-black fw-600">Get In Touch</h4>
                        <p class="text-light-white no-margin">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                        <form class="form-layout-1">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="text-left">First Name</label>
                                        <input type="text" name="#" class="form-control" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="text-left">Last Name</label>
                                        <input type="text" name="#" class="form-control" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-12 mb-xl-20">
                                    <div class="form-group">
                                        <label class="text-left">Email Address</label>
                                        <input type="email" name="#" class="form-control" placeholder="Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-left">Message</label>
                                        <textarea rows="5" name="#" class="form-control" placeholder="Write Something"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-first btn-submit text-light-blue full-width">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-8">
                    <iframe class="full-width full-height" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"></iframe>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding bg-light-white contact-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="contact-info bx-wrapper bg-custom-white text-center mb-md-40">
                        <div class="contact-info-wrapper">
                            <div class="icon mb-xl-20">
                                <i class="flaticon-telephone"></i>
                            </div>
                            <h5 class="text-custom-black fw-600">Phone</h5>
                            <p class="text-light-white">Start working with Genmed that can provide everything</p>
                            <a href="javascript:void(0);" class="fs-14">{{$account->phone_no ?? '' }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="contact-info bx-wrapper bg-custom-white text-center mb-md-40">
                        <div class="contact-info-wrapper">
                            <div class="icon mb-xl-20">
                                <i class="flaticon-email"></i>
                            </div>
                            <h5 class="text-custom-black fw-600">Email</h5>
                            <p class="text-light-white">Start working with Genmed that can provide everything</p>
                            <a href="#" class="fs-14">{{$account->email ?? '' }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="contact-info bx-wrapper bg-custom-white text-center">
                        <div class="contact-info-wrapper">
                            <div class="icon mb-xl-20">
                                <i class="flaticon-pin"></i>
                            </div>
                            <h5 class="text-custom-black fw-600">Address</h5>
                            <p class="text-light-white">Start working with Genmed that can provide everything</p>
                            <a href="#" class="fs-14">View on Google map</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('extra-scripts')

@endsection
