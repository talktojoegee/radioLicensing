@extends('layouts.master-layout')
@section('current-page')
    Persons
@endsection
@section('extra-styles')
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="container-fluid">
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
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
            <div class="row" >
                <div class="col-xl-3 col-sm-6" >
                    <div class="card" >
                        <div class="card-body" >
                            <div class="row mb-1" >
                                <div class="col" >
                                    <p class="mb-1">Total</p>
                                    <h3 class="mb-0 number-font">{{ number_format($users->where("type",2)->where("status",1)->count())  }}</h3>
                                </div>
                                <div class="col-auto mb-0" >
                                    <div class="dash-icon text-secondary1" >
                                        <i class="bx bxs-user-badge"></i>
                                    </div>
                                </div>
                            </div>
                            <span class="fs-12 text-muted"> <span class="text-muted fs-12 ml-0 mt-1">Directors<code>(Active)</code></span></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6" >
                    <div class="card" >
                        <div class="card-body" >
                            <div class="row mb-1" >
                                <div class="col" >
                                    <p class="mb-1">Total</p>
                                    <h3 class="mb-0 number-font">{{ number_format($users->where("type",2)->where("status",2)->count())  }}</h3>
                                </div>
                                <div class="col-auto mb-0" >
                                    <div class="dash-icon text-orange" >
                                        <i class="bx bxs-user-badge"></i>
                                    </div>
                                </div>
                            </div>
                            <span class="fs-12 text-muted"> <span class="text-muted fs-12 ml-0 mt-1">Directors<code>(Inactive)</code></span></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6" >
                    <div class="card" >
                        <div class="card-body" >
                            <div class="row mb-1" >
                                <div class="col" >
                                    <p class="mb-1">Total</p>
                                    <h3 class="mb-0 number-font">{{ number_format($users->where("type",'=',3)->where("status",'=',1)->count())  }}</h3>
                                </div>
                                <div class="col-auto mb-0" >
                                    <div class="dash-icon text-secondary" >
                                        <i class="bx bxs-user-badge"></i>
                                    </div>
                                </div>
                            </div>
                            <span class="fs-12 text-muted">  <span class="text-muted fs-12 ml-0 mt-1">Contact Persons<code>(Active)</code></span></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6" >
                    <div class="card" >
                        <div class="card-body" >
                            <div class="row mb-1" >
                                <div class="col" >
                                    <p class="mb-1">Total</p>
                                    <h3 class="mb-0 number-font">{{ number_format($users->where("type",3)->where("status",2)->count())  }}</h3>
                                </div>
                                <div class="col-auto mb-0" >
                                    <div class="dash-icon text-warning" >
                                        <i class="bx bxs-user-badge"></i>
                                    </div>
                                </div>
                            </div>
                            <span class="fs-12 text-muted">  <span class="text-muted fs-12 ml-0 mt-1">Contact Persons<code>(Inactive)</code> </span></span>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('add-person')}}"  class="btn btn-primary  mb-3">Add New Person <i class="bx bxs-plus-circle"></i> </a>
                    </div>
                    <div class="card-body">
                        <p><strong class="text-danger">Note:</strong> Your account currently has a total of <code>{{ number_format($users->count() ) }} </code>users</p>
                        <div class="row">
                            <div class="col-md-12 col-lx-12">
                                <div class="table-responsive mt-3">
                                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th class="">#</th>
                                            <th class="wd-15p">Name</th>
                                            <th class="wd-15p">Mobile No.</th>
                                            <th class="wd-15p">Type</th>
                                            <th class="wd-15p">Email</th>
                                            <th class="wd-15p">Country</th>
                                            <th class="wd-5p">Status</th>
                                            <th class="wd-15p">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $index = 1; @endphp
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{$index++}}</td>
                                                <td>
                                                    <img src="{{url('storage/'.$user->image)}}" style="width: 24px; height: 24px;" alt="{{$user->first_name ?? '' }} {{$user->last_name ?? '' }}" class="rounded-circle avatar-sm">
                                                    <a href="{{route('person-profile', $user->slug)}}">{{$user->title ?? '' }} {{$user->first_name ?? '' }} {{$user->last_name ?? '' }} {{$user->other_names ?? '' }}</a> </td>
                                                <td>{{$user->cellphone_no ?? '' }} </td>
                                                <td>{!! $user->type == 2 ? "<span class='badge rounded-pill bg-success'>Director</span>" : "<span class='badge rounded-pill bg-secondary'>Contact Person</span>" !!}</td>
                                                <td>{{$user->email ?? '' }} </td>
                                                <td>{{$user->getUserCountry->name ?? '' }}</td>
                                                <td>
                                                    {!! $user->status == 1 ? "<i class='bx bxs-check-circle text-success'></i>" : "<i class='bx bxs-x-circle text-danger' style='color:#ff0000 !important;'></i>" !!}
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('person-profile', $user->slug)}}"> <i class="bx bxs-user"></i> View Profile</a>
                                                            @if($user->status == 1)
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-target="#deletePractitionerModal_{{$user->id}}" data-bs-toggle="modal"> <i class="bx bx-stop text-danger"></i> Deactivate</a>
                                                            @else
                                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-target="#deletePractitionerModal_{{$user->id}}" data-bs-toggle="modal"> <i class="bx bx-check-circle text-danger"></i> Activate</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="deletePractitionerModal_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger" style="border-radius: 0px;">
                                                                    <h4 class="modal-title text-center " id="myModalLabel2">Are you sure?</h4>
                                                                    <button type="button"  class="btn-close text-white" style="margin: 0px; padding: 0px;" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <form autocomplete="off" action="{{route('delete-user')}}" method="post" id="addNewUser" data-parsley-validate="">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <p class="text-wrap">Are you sure you want to {{ $user->status == 1 ? 'deactivate' : 'activate' }} <strong class="text-danger">{{$user->first_name ?? '' }} {{$user->last_name ?? '' }}</strong> from the system?
                                                                                {{$user->first_name ?? '' }} {{$user->last_name ?? '' }} {{ $user->status == 1 ? "won't be able to access" : 'regain access to ' }}  {{ $user->gender == 1 ? 'his' : 'her' }} account again.
                                                                            </p>
                                                                        </div>
                                                                        <div class="form-group mt-1">
                                                                            <input type="hidden" name="userId" value="{{$user->id}}"  class="form-control" >
                                                                            <input type="hidden" name="status" value="{{ $user->status == 1 ? 2 : 1 }}"  class="form-control" >
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">No, cancel</button>
                                                                            <button type="submit" class="btn btn-danger waves-effect waves-light">Yes, proceed</button>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
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

    <script>
        $(document).ready(function(){
            $('#addNewUser').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
                .on('form:submit', function() {
                    return true;
                });
        });
    </script>
@endsection
