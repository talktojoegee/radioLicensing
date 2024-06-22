<div class="main-settings__sidebar-container">
    <div class="modal-header">
        <h6 class="modal-title text-uppercase">Settings</h6>
    </div>
    <div class="sidebar-section mt-5">
        <div class="settings-section-header">
            <div class="section-title text-uppercase">
                <h6>Features</h6>
            </div>
        </div>
        <a href="{{route('sms-settings')}}" class="{{  Request::routeIs('sms-settings') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span class="">SMS Settings</span>
            </div>
        </a>
        <a href="{{route('branches-settings')}}" class="{{  Request::routeIs('branches-settings') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span class="">Section Settings</span>
            </div>
        </a>
        <a href="{{route('workflow-settings')}}" class="{{  Request::routeIs('workflow-settings') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span class="">Workflow Settings</span>
            </div>
        </a>
        <a href="{{route('church-branches')}}" class="{{  Request::routeIs('church-branches') ? 'is-active-setting' : ''}}">
            <div class="sidebar-item">
                <span class="">Section Heads Settings</span>
            </div>
        </a>
    </div>
</div>
