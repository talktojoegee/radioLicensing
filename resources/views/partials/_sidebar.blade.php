<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>
        <li>
            <a href="{{route('dashboard')}}" class="waves-effect">
                <i class="bx bx-news"></i>
                <span key="t-chat">Newsfeed</span>
            </a>
        </li>
        <li>
            <a href="{{route('dashboard')}}" class="waves-effect">
                <i class="bx bxs-dashboard"></i>
                <span key="t-chat">Dashboard</span>
            </a>
        </li>
        <li class="menu-title" key="t-pages">TIME</li>
        <li>
            <a href="{{route('calendar')}}" class="waves-effect">
                <i class="bx bx-calendar"></i>
                <span key="t-chat">Calendar</span>
            </a>
        </li>
        <li>
            <a href="{{route('show-appointments')}}" class="waves-effect">
                <i class="bx bx-timer"></i>
                <span key="t-chat">Appointments</span>
            </a>
        </li>
        <li>
            <a href="{{route('manage-tasks')}}" class="waves-effect">
                <i class="bx bx-task"></i>
                <span key="t-chat">Projects</span>
            </a>
        </li>
        <li>
            <a href="{{route('manage-tasks')}}" class="waves-effect">
                <i class="bx bx-infinite"></i>
                <span key="t-chat">Workflow</span>
            </a>
        </li>
        <li>
            <a href="{{route('manage-tasks')}}" class="waves-effect">
                <i class="bx bx-chart"></i>
                <span key="t-chat">Attendance</span>
            </a>
        </li>
        <li>
            <a href="{{route('manage-tasks')}}" class="waves-effect">
                <i class="bx bx-wallet"></i>
                <span key="t-chat">Finance</span>
            </a>
        </li>
        <li>
            <a href="{{route('manage-tasks')}}" class="waves-effect">
                <i class="bx bxs-landmark"></i>
                <span key="t-chat">Branches</span>
            </a>
        </li>
        <li class="menu-title">Persons</li>
        <li>
            <a href="{{route('pastors')}}" class="waves-effect">
                <i class="bx bxs-user-badge"></i>
                <span key="t-chat">Pastors</span>
            </a>
        </li>
        <li>
            <a href="{{route('clients')}}" class="waves-effect">
                <i class="bx bxs-user"></i>
                <span key="t-chat">Users</span>
            </a>
        </li>
        <li>
            <a href="{{route('practitioners')}}" class="waves-effect">
                <i class="bx bxs-user-plus"></i>
                <span key="t-chat">New Converts</span>
            </a>
        </li>
        <li class="menu-title">Extras</li>
        <li>
            <a href="{{route('cloud-storage')}}" class="waves-effect">
                <i class="bx bx-file"></i>
                <span key="t-chat">Documents</span>
            </a>
        </li>
        <li>
            <a href="{{route('my-notifications')}}" class="waves-effect">
                <i class="bx bx-alarm"></i>
                <span key="t-chat">Notifications</span>
            </a>
        </li>
        <li class="menu-title">Financial Accounts</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bxs-landmark"></i>
                <span key="t-crypto"> Accounting</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('chart-of-accounts')}}" key="t-wallet">Chart of Accounts</a></li>
                <li><a href="{{route('add-new-account')}}" key="t-wallet">Add New Account</a></li>
                <li><a href="{{route('sales')}}" key="t-wallet">Journal Voucher</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bxs-report"></i>
                <span key="t-report"> Reports</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('appointment-reports')}}" key="t-report">Trial Balance</a></li>
                <li><a href="{{route('practitioner-report')}}" key="t-report">Profit/Loss</a></li>
                <li><a href="{{route('show-revenue-reports')}}" key="t-report">Balance Sheet</a></li>
                <li><a href="{{route('client-report')}}" key="t-report">Client</a></li>
            </ul>
        </li>
        <li class="menu-title">Other Reports</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bxs-report"></i>
                <span key="t-report"> Reports</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('appointment-reports')}}" key="t-report">Appointments</a></li>
                <li><a href="{{route('practitioner-report')}}" key="t-report">Practitioner</a></li>
                <li><a href="{{route('show-revenue-reports')}}" key="t-report">Revenue</a></li>
            </ul>
        </li>
        <li class="menu-title">Settings</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-cog"></i>
                <span key="t-crypto">Settings</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('settings')}}" key="t-wallet">General Settings</a></li>
                <li><a href="{{route('purchase-or-upgrade-plan')}}" key="t-wallet">Purchase/Upgrade Plan</a></li>
                <li><a href="{{route('purchase-or-upgrade-plan')}}" key="t-wallet">Regions</a></li>
                <li><a href="{{route('purchase-or-upgrade-plan')}}" key="t-wallet">Branches</a></li>
                <li><a href="{{route('purchase-or-upgrade-plan')}}" key="t-wallet">Cells</a></li>
                <li><a href="{{route('purchase-or-upgrade-plan')}}" key="t-wallet">Cells</a></li>
            </ul>
        </li>

    </ul>
</div>
<!-- Sidebar -->
