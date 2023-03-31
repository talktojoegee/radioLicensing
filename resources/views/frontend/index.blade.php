@extends('layouts.frontend-layout')
@section('orgName')
    {{$account->organization_name ?? '' }}
@endsection

@section('title')
    Home
@endsection

@section('extra-styles')

@endsection

@section('main-content')
    <!-- Start Slider -->
    <div class="slider parallax" style="background-image: url('storage/{{$home->slider_image}}')" id="banner-animation">
        <div class="transform-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="banner-slider">
                            <div class="slide-item">
                                <div class="banner-text">
                                    <h1 class="text-custom-white fw-700">{{$home->slider_caption ?? '' }}</h1>
                                    <p class="text-custom-white">{{$home->slider_caption_detail ?? '' }}</p>
                                    <a href="#" class="btn-first btn-submit text-light-blue">
                                        {{$home->slider_cta_btn ?? '' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider -->
    <!-- Start Intro -->
    <section class="genmed-intro">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 no-padding">
                    <div class="intro-box bg-light-blue full-height">
                        <div class="intro-wrapper text-center">
                            <i class="flaticon-flag"></i>
                            <h4 class="text-custom-white fw-700">Working Time</h4>
                            <table class="table text-custom-white">
                                <tbody>
                                <tr>
                                    <td>Mon – Wed</td>
                                    <td> - </td>
                                    <td class="text-right">9:00 AM - 7:00 PM</td>
                                </tr>
                                <tr>
                                    <td>Thursday</td>
                                    <td> - </td>
                                    <td class="text-right">9:00 AM - 6:30 PM</td>
                                </tr>
                                <tr>
                                    <td>Friday</td>
                                    <td> - </td>
                                    <td class="text-right">9:00 AM - 6:00 PM</td>
                                </tr>
                                <tr class="last-tr">
                                    <td>Sun - Sun</td>
                                    <td>-</td>
                                    <td class="text-right">CLOSED</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 no-padding">
                    <div class="intro-box bg-light-blue full-height">
                        <div class="intro-wrapper text-center">
                            <i class="flaticon-flag"></i>
                            <h4 class="text-custom-white fw-700">Appointments</h4>
                            <p class="text-custom-white">{{$home->appointment_detail ?? '' }}</p>
                            <a href="#book-appointment" class="btn-first btn-submit-white fw-600 scrollbtn">{{$home->appointment_cta_btn ?? '' }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 no-padding">
                    <div class="intro-box bg-light-blue full-height">
                        <div class="intro-wrapper text-center">
                            <i class="flaticon-flag"></i>
                            <h4 class="text-custom-white fw-700">Emergency Cases</h4>
                            <p class="text-custom-white">{{$home->emergency_detail ?? '' }}</p>
                            <a href="tel:" class="btn-first btn-submit-white fw-600"><i class="fas fa-phone-alt"></i> {{$home->emergency_cta_btn ?? '' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Intro -->
    <!-- Start About -->
    <section class="section-padding-top about-sec">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-lg-6">
                    <div class="section-header">
                        <div class="section-heading">
                            <h3 class="text-custom-black fw-700">Welcome To {{$org->organization_name ?? '' }}</h3>
                        </div>
                    </div>
                    <div class="about-wrapper mb-xl-80">
                        {!! $home->welcome_message ?? '' !!}
                        <div class="signature mb-xl-40">
                            <span class="fs-14 text-light-blue fw-600">{{$home->welcome_written_by ?? ''}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 align-self-end">
                    <div class="doctor-img">
                        <img src="/storage/{{$home->welcome_featured_img ?? ''}}" class="img-fluid image-fit" alt="{{$org->organization_name ?? '' }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About -->
    <!-- Start Main Services -->
    <section class="main-services section-padding">
        <div class="container">
            <div class="section-header">
                <div class="section-heading">
                    <h3 class="text-custom-black fw-700">Our Services</h3>
                    <div class="section-description">
                        <p class="text-light-white">
                            Explore our array of services
                        </p>
                    </div>
                </div>
                <div class="section-btn">
                    <a href="#" class="btn-first btn-submit text-light-blue">View More</a>
                </div>
            </div>
            <div class="row">
                @forelse($account->getOrgServices as $service)
                    <div class="col-lg-3 col-sm-6">
                        <div class="main-services-box p-relative mb-xl-30">
                            <div class="main-service-wrapper padding-20">
                                <div class="icon-box">
                                    <i class="{{$service->icon ?? 'flaticon-dental-care' }}"></i>
                                </div>
                                <h5 class="fw-700"><a href="#" class="text-custom-black">{{$service->title ?? '' }}</a></h5>
                                <p class="text-light-white no-margin">{{strip_tags($service->description ?? '' )}}</p>
                            </div>
                        </div>
                    </div>

                @empty

                    <div class="col-lg-12 col-sm-12">
                        <p>No Service registered</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <section class="book-appointment parallax section-padding" id="book-appointment">
        <div class="overlay overlay-bg-black"></div>
        <div class="container">
            <div class="row">
                @foreach($forms as $form)
                    <div class="col-lg-12">
                    <div class="booking-form p-relative">
                        <div class="book-form-wrapper">
                            <div class="section-header">
                                <div class="section-heading mx-auto text-center">
                                    <h3 class="text-custom-black fw-700">{{$form->title ?? ''}}</h3>
                                    <div class="section-description">
                                        <p class="text-light-white">
                                            {{strip_tags($form->description ?? '' )}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                           @if(session()->has('success'))
                                <div class="row">
                                    <div class="col-8 col-md-8 offset-md-2 offset-2">
                                        <div class="alert alert-success">
                                            {!! session()->get('success') !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <form action="{{route('process-frontend-form', ['account'=>$account])}}" method="post" class="form-layout-1">
                                @csrf
                                <input type="hidden" name="formId" value="{{$form->id}}">
                                <div class="row">
                                    @foreach($form->getFormProperties as $prop)
                                        @switch($prop->getFormField->type)
                                            @case('text')
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label>{{$prop->getFormField->label ?? '' }}</label>
                                                        <input type="text" name="{{$prop->getFormField->name ?? '' }}" {{$prop->form_field_required == 1 ? 'required' : '' }} class="form-control" placeholder="{{$prop->getFormField->label}}">
                                                    </div>
                                                </div>
                                            @break
                                            @case('textarea')
                                            <div class="col-md-4 mb-xl-20">
                                                <div class="form-group">
                                                    <label>{{$prop->getFormField->label ?? '' }}</label>
                                                    <textarea class="form-control" rows="2" name="{{$prop->getFormField->name ?? '' }}" {{$prop->form_field_required == 1 ? 'required' : '' }} placeholder="{{$prop->getFormField->label}}"></textarea>
                                                </div>
                                            </div>
                                            @break
                                            @case('email')
                                            <div class="col-md-4 mb-xl-20">
                                                <div class="form-group">
                                                    <label>{{$prop->getFormField->label ?? '' }}</label>
                                                    <input type="email" name="{{$prop->getFormField->name ?? '' }}" {{$prop->form_field_required == 1 ? 'required' : '' }} class="form-control" placeholder="{{$prop->getFormField->label}}">
                                                </div>
                                            </div>
                                            @break
                                            @case('date')
                                            <div class="col-md-4 mb-xl-20">
                                                <div class="form-group">
                                                    <label>{{$prop->getFormField->label ?? '' }}</label>
                                                    <input type="date" name="{{$prop->getFormField->name ?? '' }}" {{$prop->form_field_required == 1 ? 'required' : '' }} class="form-control" placeholder="{{$prop->getFormField->label}}">
                                                </div>
                                            </div>
                                        @break
                                        @endswitch
                                    @endforeach
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn-first btn-submit text-light-blue fw-600">{{$form->button_text ?? '' }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Appointment/faqs -->

    <!-- Start Team Doctors -->
    <section class="section-padding doctors-team-style-2 ">
        <div class="container">
            <div class="section-header">
                <div class="section-heading">
                    <h3 class="text-custom-black fw-700">Our Practitioners</h3>
                    <div class="section-description">
                        <p class="text-light-white">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 no-padding">
                    <div class="doctors-slider">
                        @foreach($practitioners as $practitioner)
                            <div class="slide-item col-12">
                                <div class="team-block p-relative">
                                    <div class="inner-box">
                                        <div class="image animate-img">
                                            <img style="width: 247px; height: 177px;" src="/storage/{{$practitioner->image ?? 'avatar.png' }}" alt="{{$practitioner->first_name ?? '' }}" class="full-width">
                                            <div class="overlay-box">
                                                <div class="overlay-inner p-relative full-height">
                                                    <ul class="team-social-box custom">
                                                        <li class="linkedin"><a href="#" class="fab fa-linkedin fs-16"></a></li>
                                                        <li class="facebook"><a href="#" class="fab fa-facebook-f fs-16"></a></li>
                                                        <li class="twitter"><a href="#" class="fab fa-twitter fs-16"></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lower-content p-relative text-center">
                                            <h6><a href="javascript:void(0);" class="text-custom-black fw-600 fs-20">{{$practitioner->first_name ?? '' }} {{$practitioner->last_name ?? '' }}</a></h6>
                                            <p class="designation text-light-white">{{$practitioner->email ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Team Doctors -->

@endsection


@section('extra-scripts')

@endsection
