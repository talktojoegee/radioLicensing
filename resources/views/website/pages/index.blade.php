
@extends('layouts.master-layout')
@section('current-page')
    Web Pages
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
                    <div class="card-header bg-primary text-white">Website Content</div>
                    <div class="card-body">
                        <a href="{{route('create-web-page')}}" class="btn btn-primary btn-rounded waves-effect waves-light mb-3">Create A Page</a>
                        <p>Create standalone pages for your website. Provide information about seminars, special events, monthly specials, the disciplines taught at the gym and more.</p>
                        <div class="table-responsive mt-3">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="">#</th>
                                    <th class="wd-15p">Title</th>
                                    <th class="wd-15p">Status</th>
                                    <th class="wd-15p">In Menu</th>
                                    <th class="wd-15p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $index = 1; @endphp
                                @foreach($pages as $page)
                                    <tr>
                                        <td>{{$index++}}</td>
                                        <td>{{$page->page_title ?? '' }}</td>
                                        <td>{!! $page->status == 1 ? "<span class='text-success'>Active</span>" : "<span class='text-danger'>Archived</span>" !!}</td>
                                        <td>{!! $page->show_in_menu == 1 ? "<span class='text-success'>Yes</span>" : "<span class='text-danger'>No</span>" !!}</td>
                                        <td>
                                            <div class="btn-group">
                                                <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="" target="_blank"> <i class="bx bx-world text-primary"></i> Visit Page</a>
                                                    <a class="dropdown-item" href="javascript:void(0);" target="_blank"> <i class="bx bxs-pencil text-warning"></i> Edit Page</a>
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



@endsection

@section('extra-scripts')
    <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <!-- Datatable init js -->
    <script src="/assets/js/pages/datatables.init.js"></script>
@endsection
