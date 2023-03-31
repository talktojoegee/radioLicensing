@include('partials.frontend._header')
<body class="animated-banner">
<!-- Start Main Body -->
<div class="main-body">
    @include('partials.frontend._nav')
        @yield('main-content')
   @include('partials.frontend._footer-note')
</div>
@include('partials.frontend._footer-script')


