@include('partials._header')
<body data-sidebar="dark">
<div id="layout-wrapper">
    @if(\Illuminate\Support\Facades\Auth::user()->type == 1)
        @include('partials._admin-top-bar')
    @else
        @include('partials._top-bar')
    @endif

    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            @if(\Illuminate\Support\Facades\Auth::user()->type == 1)
                @include('partials._admin-sidebar')
            @else
                @include('partials._sidebar')
            @endif
        </div>
    </div>
  <!--  #1916FC-->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18 text-uppercase">@yield('current-page')</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item "><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">@yield('current-page')</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                @yield('main-content')
            </div>
        </div>
        @include('partials._footer')
    </div>

</div>
@yield('right-sidebar')
@include('partials._footer-scripts')
</body>
</html>
