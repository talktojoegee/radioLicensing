<ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{request()->routeIs('website-settings') ? 'active' : '' }}" href="{{route('website-settings')}}" role="tab">
            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-block">Settings</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->routeIs('website-homepage') ? 'active' : '' }}"  href="{{route('website-homepage')}}" role="tab">
            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
            <span class="d-none d-sm-block">Homepage</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->routeIs('website-forms') ? 'active' : '' }}" href="{{route('website-forms')}}" role="tab">
            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
            <span class="d-none d-sm-block">Forms</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->routeIs('web-pages') ? 'active' : '' }}" href="{{route('web-pages')}}" role="tab">
            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
            <span class="d-none d-sm-block">Content</span>
        </a>
    </li>
    <li class="nav-item" style="display: none;">
        <a class="nav-link" href="#messages1" role="tab">
            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
            <span class="d-none d-sm-block">Gallery</span>
        </a>
    </li>
    <li class="nav-item" style="display: none;">
        <a class="nav-link" href="#messages1" role="tab">
            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
            <span class="d-none d-sm-block">Pricing</span>
        </a>
    </li>
</ul>
