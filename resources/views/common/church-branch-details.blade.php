@extends('layouts.master-layout')
@section('current-page')
    Church Branch Details
@endsection
@section('extra-styles')

@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 mt-4">
                <div class="d-flex justify-content-between modal-header">
                    <div class="h6 text-left pl-5 text-uppercase text-primary"> Church Branch Details</div>
                    <a href="{{route('church-branches')}}" class="btn btn-primary mr-3" > <i class="bx bx-food-menu"></i>  Manage Church Branches</a>
                </div>

                <div class="col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Home</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Profile</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Messages</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Settings</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="home1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-4 col-md-4">
                                            <div class="card">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-md-4">
                                                        <img class="card-img img-fluid" src="assets/images/small/img-2.jpg" alt="Card image">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Lead Pastor</h5>
                                                            <blockquote class="blockquote font-size-14 mb-0">
                                                                <p>{{$branch->getLeadPastor->first_name ?? '-'}} {{$branch->getLeadPastor->last_name ?? '-'}}</p>
                                                                <footer class="blockquote-footer mt-0 font-size-12">
                                                                     <cite title="Source Title">Source Title</cite>
                                                                </footer>
                                                            </blockquote>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                <div class="tab-pane" id="messages1" role="tabpanel">
                                    <p class="mb-0">
                                        Etsy mixtape wayfarers, ethical wes anderson tofu before they
                                        sold out mcsweeney's organic lomo retro fanny pack lo-fi
                                        farm-to-table readymade. Messenger bag gentrify pitchfork
                                        tattooed craft beer, iphone skateboard locavore carles etsy
                                        salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                                        Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                                        mi whatever gluten-free carles.
                                    </p>
                                </div>
                                <div class="tab-pane" id="settings1" role="tabpanel">
                                    <p class="mb-0">
                                        Trust fund seitan letterpress, keytar raw denim keffiyeh etsy
                                        art party before they sold out master cleanse gluten-free squid
                                        scenester freegan cosby sweater. Fanny pack portland seitan DIY,
                                        art party locavore wolf cliche high life echo park Austin. Cred
                                        vinyl keffiyeh DIY salvia PBR, banh mi before they sold out
                                        farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral,
                                        mustache readymade keffiyeh craft.
                                    </p>
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

@endsection
