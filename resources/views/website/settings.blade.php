
@extends('layouts.master-layout')
@section('current-page')
    Website
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/nprogress.css">
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header bg-primary text-white">Website Settings</div>
                    <div class="card-body">
                        <form action="{{route('update-organization-settings')}}" method="post" enctype="multipart/form-data">
                        <div class="row {{Auth::user()->getUserOrganization->publish_site == 1 ? 'bg-success' : 'bg-warning'}} p-2 text-white" style="border-radius: 5px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5 class="text-white">Status</h5>
                                    <p>Visitors will not be able to access your website until you publish it.</p>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <div class="form-group">
                                    <label for="" class="h5 text-white text-uppercase">Published</label>
                                    <div>
                                        <input type="checkbox" id="switch6" switch="primary" name="publishSite" {{Auth::user()->getUserOrganization->publish_site == 1 ? 'checked' : '' }} >
                                        <label for="switch6" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                            @csrf
                            <div class="row mt-3">
                                <h5>Website Address</h5>
                                <p>Pick a web address for your website. You can use a subdomain.</p>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="">Sub-domain <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="subDomain" value="{{Auth::user()->getUserOrganization->sub_domain ?? ''}}" aria-describedby="option-date" placeholder="SubDomain">
                                    </div>
                                    @error('subDomain') <i class="text-danger">{{$message}}</i>@enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Custom Domain</label>
                                    <p>
                                        <a href="#" target="_blank">{{Auth::user()->getUserOrganization->sub_domain ?? ''}}.{{env('APP_URL2')}}</a>
                                    </p>
                                </div>
                                <input type="hidden" name="orgId" value="{{Auth::user()->org_id}}">
                                <div class="card-deck-wrapper mt-2">
                                    <div class="card-group">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h4 class="card-title">Website Navigation</h4>
                                                <p class="card-text">Adjust the order and appearance of the website navigation links.</p>
                                            </div>
                                        </div>
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h4 class="card-title">Social Accounts</h4>
                                                <p class="card-text">Social accounts appear on the website footer and the contact page.</p>
                                                <div class="form-group">
                                                    <label for="">Facebook Page(Link)</label>
                                                    <input type="text" class="form-control" name="facebookPage" value="{{old('facebookPage', Auth::user()->getUserOrganization->facebook_handle)}}" placeholder="Facebook Page">
                                                    @error('facebookPage') <i class="text-danger">{{$message}}</i> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Twitter Account(Link)</label>
                                                    <input type="text" class="form-control" name="twitterAccount" value="{{old('twitterAccount', Auth::user()->getUserOrganization->twitter_handle)}}" placeholder="Twitter Account">
                                                    @error('twitterAccount') <i class="text-danger">{{$message}}</i> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Instagram(Link)</label>
                                                    <input type="text" class="form-control" name="instagram" value="{{old('instagram', Auth::user()->getUserOrganization->instagram_handle)}}" placeholder="Instagram">
                                                    @error('instagram') <i class="text-danger">{{$message}}</i> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Youtube Channel(Link)</label>
                                                    <input type="text" class="form-control" name="youtubeChannel" value="{{old('youtubeChannel', Auth::user()->getUserOrganization->youtube_handle)}}" placeholder="Youtube Channel">
                                                    @error('youtubeChannel') <i class="text-danger">{{$message}}</i> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-group" style="margin-top: -25px;">
                                        <div class="card mb-0">
                                            <div class="card-body">
                                                <h4 class="card-title">Color Scheme</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-check form-radio-outline form-radio-primary mb-3">
                                                            <input class="form-check-input" type="radio" value="2" name="themeChoice" id="formRadio1" {{Auth::user()->getUserOrganization->theme_choice == 2 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="formRadio1">
                                                                Light Theme
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-radio-outline form-radio-primary mb-3">
                                                            <input class="form-check-input" type="radio" value="1" name="themeChoice" id="formRadio2" {{Auth::user()->getUserOrganization->theme_choice == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="formRadio2">
                                                                Dark Theme
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">UI Color(Buttons, Borders)</label>
                                                            <input type="color" id="uiColor" name="uiColor" value="#2A3041" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Button Text Color</label>
                                                            <input type="color" id="btnTextColor" name="uiButtonTextColor" value="#FFFFFF" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-12 d-flex justify-content-center">
                                                        <button id="exampleBtn" class="btn btn-primary btn-block btn-lg" style="border-radius: 0px; width: 350px;">EXAMPLE</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-0">
                                            <div class="card-body">
                                                <h4 class="card-title">Website logo</h4>
                                                <p class="card-text">Upload a logo for the website. The default logo would be used otherwise.
                                                </p>
                                               <div class="row">
                                                   <div class="col-md-6">
                                                       <div class="form-group">
                                                           <label for="">Upload Logo</label> <br>
                                                           <input type="file" name="logo" class="form-control-file">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-6">
                                                       <div class="form-group ">
                                                           <label for="">Upload Favicon</label> <br>
                                                           <input type="file" name="favicon" class="form-control-file">
                                                       </div>
                                                   </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <label for="">Organization Name</label>
                                    <input type="text" name="organizationName" value="{{Auth::user()->getUserOrganization->organization_name ?? '' }}" placeholder="Organization Name" class="form-control">
                                    @error('organizationName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <label for="">Organization Code</label>
                                    <input type="text" name="organizationCode" value="{{Auth::user()->getUserOrganization->organization_code ?? '' }}" placeholder="Organization Code" class="form-control">
                                    @error('organizationCode') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <label for="">Tax ID Type <span class="text-danger">*</span></label>
                                    <select name="taxIDType" id="" class="form-control">
                                        <option disabled selected>--Select Tax ID Type--</option>
                                        <option value="1">SSN</option>
                                        <option value="1">EIN</option>
                                    </select>
                                    @error('taxIDType') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <label for="">Organization Tax ID Number <span class="text-danger">*</span></label>
                                    <input type="text" name="organizationTaxIDNumber" placeholder="Organization Tax ID Number" class="form-control">
                                    @error('organizationTaxIDNumber') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <label for="">Organization Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" name="organizationPhoneNumber" value="{{Auth::user()->getUserOrganization->phone_no ?? '' }}" placeholder="Organization Phone Number" class="form-control">
                                    @error('organizationPhoneNumber') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <label for="">Organization Email Address <span class="text-danger">*</span></label>
                                    <input type="text" name="organizationEmail" readonly value="{{Auth::user()->getUserOrganization->email ?? '' }}" placeholder="Organization Email Address" class="form-control">
                                    @error('organizationEmail') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-8 mt-3">
                                    <label for="">Address Line  <span class="text-danger">*</span></label>
                                    <input type="text" name="addressLine" value="{{Auth::user()->getUserOrganization->address ?? '' }}" placeholder="Address Line " class="form-control">
                                    @error('addressLine') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    <label for="">City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" placeholder="City" value="{{Auth::user()->getUserOrganization->city ?? '' }}" class="form-control">
                                    @error('city') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    <label for="">Zip Code </label>
                                    <input type="text" name="zipCode" value="{{Auth::user()->getUserOrganization->zip_code ?? '' }}" placeholder="Address Line 2" class="form-control">
                                    @error('zipCode') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                            </div>
                            <div class="form-group d-flex mt-3 justify-content-center">
                                <button type="submit" class="btn btn-primary">Save Settings <i class="bx bx-right-arrow"></i> </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('extra-scripts')
    <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <!-- Datatable init js -->
    <script src="/assets/js/pages/datatables.init.js"></script>
    <script>
        $(document).ready(function(){
            changeExampleBtnView();
        });
        $('#uiColor').on('change', function(){
            changeExampleBtnView();
        });
        $('#btnTextColor').on('change', function(){
            changeExampleBtnView();
        });
        function changeExampleBtnView(){
            $('#exampleBtn').css('background', $('#uiColor').val());
            $('#exampleBtn').css('border', $('#uiColor').val());
            $('#exampleBtn').css('color', $('#btnTextColor').val());
        }
    </script>
@endsection
