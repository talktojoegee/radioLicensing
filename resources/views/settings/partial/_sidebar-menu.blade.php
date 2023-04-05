<div class="main-settings__sidebar-container">
    <div class="main-title">Settings</div>
    <div class="sidebar-section">
        <div class="settings-section-header">
            <div class="section-title">General</div>
        </div>
        <a href="{{route('settings')}}" class="{{  Request::routeIs('settings') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span class="">Cells</span>
            </div>
        </a>
        <a href="{{route('settings')}}" class="{{  Request::routeIs('settings') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span class="">Regions</span>
            </div>
        </a>
        <a href="{{route('branches-settings')}}" class="{{  Request::routeIs('branches-settings') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span class="">Branches</span>
            </div>
        </a>
        <a href="{{route('settings')}}" class="{{  Request::routeIs('settings') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span class="">Workflow</span>
            </div>
        </a>
        <a href="{{route('settings')}}" class="{{  Request::routeIs('settings') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span class="">Departments</span>
            </div>
        </a>
        <a href="{{route('settings')}}" class="{{  Request::routeIs('settings') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span>Account</span>
            </div>
        </a>
        <a href="{{route('notification-settings')}}" class=" {{  request()->routeIs('notification-settings') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span>Notifications</span>
            </div>
        </a>
    </div>
    <div class="sidebar-section">
        <div class="settings-section-header">
            <div class="section-icon">
                <i class="bx bx-calendar"></i>
            </div>
            <div class="section-title">Calendar</div>
        </div>
        <a href="{{route('appointment-settings')}}" class=" {{  request()->routeIs('appointment-settings') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span>Appointments</span>
            </div>
        </a>
        <a href="{{route('appointment-types-settings')}}" class=" {{  request()->routeIs('appointment-types-settings') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span>Appointment Types</span>
            </div>
        </a>
        <a href="{{route('appt-locations')}}" class=" {{  request()->routeIs('appt-locations') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span>Appt. Locations</span>
            </div>
        </a>
        <a href="{{route('change-password')}}" class=" {{  request()->routeIs('change-password') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span>Change Password</span>
            </div>
        </a>
    </div>
</div>
