@extends('layouts.master-layout')
@section('current-page')
    {{$user->is_admin == 1 ? "Admin" : 'Practitioner' }} Account
@endsection
@section('extra-styles')
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
    <div class="card">
        <div class="card-header">
            @if($user->is_admin == 2)
                <a href="{{route('practitioners')}}"  class="btn btn-primary  mb-3">All Practitioners <i class="bxs-first-aid bx"></i> </a>
            @else
                <a href="{{route('pastors')}}"  class="btn btn-primary  mb-3">All Administrators <i class="bx bx-first-aid"></i> </a>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-xl-4">
                    <div class="card">
                        <div class="card-body" style="overflow-y: scroll; height: 500px;">
                            <div class="mt-4 mt-md-0 d-flex justify-content-center">
                                <img class="img-thumbnail rounded-circle avatar-xl" alt="200x200" src="{{url('storage/'.$user->image)}}" data-holder-rendered="true">
                            </div>
                            <div class="justify-content-center d-flex mt-1">
                                <h6>{{$user->first_name ?? '' }} {{$user->last_name ?? '' }}</h6>
                            </div>
                            <div class="justify-content-center d-flex" style="margin-top: -7px;">
                                <p> <span class="bx bx-message mr-2 text-danger"></span> {{$user->email ?? '' }}</p>
                            </div>
                            <div class="justify-content-center d-flex" style="margin-top: -10px;">
                                <p> <span class="bx bx-phone mr-2 text-success"></span> {{$user->cellphone_no ?? '' }}</p>
                            </div>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Basic Information
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                <table class="table table-nowrap mb-0">
                                                    <tbody>
                                                    <tr>
                                                        <td><i class="bx bx-phone mr-5 text-primary" style="font-size: 20px"></i></td>
                                                        <td>
                                                            Phone Number <br>
                                                            {{$user->cellphone_no ?? '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="bx bxs-calendar-check mr-5 text-primary" style="font-size: 20px;"></i>
                                                        </td>
                                                        <td>
                                                            Date of Birth <br>
                                                            {{!is_null($user->birth_date) ? date('d M, Y', strtotime($user->birth_date)) : ''}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="bx bxs-map mr-5 text-primary" style="font-size: 20px;"></i>
                                                        </td>
                                                        <td>
                                                            Country <br>
                                                            {{$user->getUserCountry->name ?? '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="bx bxs-map-pin mr-5 text-primary" style="font-size: 20px;"></i>
                                                        </td>
                                                        <td>
                                                            Address <br>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="bx bxs-timer mr-5 text-primary" style="font-size: 20px;"></i>
                                                        </td>
                                                        <td>
                                                            Timezone <br>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="bx bxs-calendar-check mr-5 text-primary" style="font-size: 20px;"></i>
                                                        </td>
                                                        <td>
                                                            Member Since <br>
                                                            {{!is_null($user->created_at) ? date('d M, Y', strtotime($user->created_at)) : ''}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                           Quick Note
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="text-muted">
                                               {!! $user->note ?? '' !!}

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Appointments</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Tasks</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Access Level</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="home1" role="tabpanel">
                                    <div class="card-header bg-primary text-white mb-3">All Appointments</div>
                                    <div class="table-responsive mt-3">
                                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th class="">#</th>
                                                <th class="wd-15p">Client</th>
                                                <th class="wd-15p">Phone No.</th>
                                                <th class="wd-15p">Email</th>
                                                <th class="wd-15p">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $a = 1; @endphp
                                            @foreach($user->getUserAppointments as $appointment)
                                                <tr>
                                                    <td>{{$a++}}</td>
                                                    <td>{{$appointment->getClient->first_name ?? '' }} {{$appointment->getClient->last_name ?? '' }}</td>
                                                    <td>{{$appointment->getClient->mobile_no ?? '' }}</td>
                                                    <td>{{$appointment->getClient->email ?? '' }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="#"> <i class="bx bxs-book-open"></i> View Details</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile1" role="tabpanel">
                                    <div class="card-header bg-primary text-white mb-3">All Tasks</div>
                                    <div class="table-responsive mt-3">
                                        <table id="datatable1" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th class="">#</th>
                                                <th class="wd-15p">Title</th>
                                                <th class="wd-15p">Start</th>
                                                <th class="wd-15p">Status</th>
                                                <th class="wd-15p">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $index = 1; @endphp


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="messages1" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <p><strong class="text-danger">Note:</strong> Only the permissions that pertains to your subscription will reflect.</p>
                                            <div class="card-header bg-primary text-white"> {{$user->first_name}}'s   Access Control Level
                                            </div>
                                            <div class="card-body">
                                                <form action="{{route('grant-permission')}}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        @foreach($modules as $key => $module)
                                                            <div class="col-md-6">
                                                                <h6 class="card-title text-uppercase text-custom"> <span class="badge rounded-pill bg-danger">{{$key+1}}</span> {{$module->module_name}}</h6>
                                                                <hr>
                                                                <div class="row">
                                                                    @foreach($module->getPermissions as $permission)
                                                                        <div class="col-md-6">
                                                                            <div class="form-check form-check-primary mb-3">
                                                                                <input class="form-check-input" name="permission[]" {{$user->hasPermissionTo($permission->name) ? 'checked' : '' }} value="{{$permission->name}}" type="checkbox" >
                                                                                <label class="form-check-label" for="formCheckcolor1">
                                                                                    {{ ucfirst(str_replace("-", " ", $permission->name)) ?? '' }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <input type="hidden" name="user" value="{{$user->id}}">
                                                        <div class="col-md-12 d-flex justify-content-center">
                                                            <button class="btn btn-primary" type="submit">Save changes <i class="bx bx-right-arrow"></i> </button>
                                                        </div>
                                                    </div>
                                                </form>
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

    </div>


@endsection

@section('extra-scripts')
    <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/js/pages/datatables.init.js"></script>
@endsection
