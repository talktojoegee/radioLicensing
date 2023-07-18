<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>
        <li>
            <a href="{{route('dashboard')}}" class="waves-effect">
                <i class="bx bx-news"></i>
                <span key="t-chat">Timeline</span>
            </a>
        </li>
        <li>
            <a href="{{route('dashboard')}}" class="waves-effect">
                <i class="bx bxs-dashboard"></i>
                <span key="t-chat">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{route('church-branches')}}" class="waves-effect">
                <i class="bx bx-map"></i>
                <span key="t-chat">Branches</span>
            </a>
        </li>
        <li class="menu-title" key="t-pages">COMMUNICATION</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bxs-message"></i>
                <span key="t-crypto"> Bulk SMS </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('top-up-transactions')}}" key="t-wallet">Wallet</a></li>
                <li><a href="{{route('compose-sms')}}" key="t-wallet">Compose</a></li>
                <li><a href="{{route('schedule-sms')}}" key="t-wallet">Schedule</a></li>
                <li><a href="{{route('top-up')}}" key="t-wallet">Top-up</a></li>
                <li><a href="{{route('phone-groups')}}" key="t-wallet">Phone Group</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-phone-call"></i>
                <span key="t-crypto"> Follow-up </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('income')}}" key="t-wallet">Add New</a></li>
                <li><a href="{{route('expense')}}" key="t-wallet">Import</a></li>
                <li><a href="{{route('remittance')}}" key="t-wallet">My Task</a></li>
                <li><a href="{{route('accounting.accounts')}}" key="t-wallet">Assignment</a></li>
            </ul>
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
            <a href="{{route('workflow')}}" class="waves-effect">
                <i class="bx bx-infinite"></i>
                <span key="t-chat">Workflow</span>
            </a>
        </li>
        <li>
            <a href="{{route('attendance')}}" class="waves-effect">
                <i class="bx bx-chart"></i>
                <span key="t-chat">Attendance</span>
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
                <span key="t-crypto"> Financials </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('income')}}" key="t-wallet">Income</a></li>
                <li><a href="{{route('expense')}}" key="t-wallet">Expenses</a></li>
                <li><a href="{{route('remittance')}}" key="t-wallet">Remittance</a></li>
                <li><a href="{{route('accounting.accounts')}}" key="t-wallet">Manage Accounts</a></li>
                <li><a href="{{route('accounting.categories')}}" key="t-wallet">Manage Categories</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bxs-report"></i>
                <span key="t-report"> Reports</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('cashbook', 'income')}}" key="t-report">Income</a></li>
                <li><a href="{{route('cashbook', 'expense')}}" key="t-report">Expense</a></li>
                <li><a href="{{route('cashbook', 'cashbook')}}" key="t-report">Cashbook</a></li>
                <li><a href="{{route('show-remittance-report')}}" key="t-report">Remittance</a></li>
                <li><a href="{{route('appointment-reports')}}" key="t-report">Attendance</a></li>
                <li><a href="{{route('appointment-reports')}}" key="t-report">Audit Trail</a></li>
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
                <li><a href="{{route('purchase-or-upgrade-plan')}}" key="t-wallet">Regions</a></li>
                <li><a href="{{route('branches-settings')}}" key="t-wallet">Branches</a></li>
                <li><a href="{{route('branches-settings')}}" key="t-wallet">Branch Assignment</a></li>
            </ul>
        </li>

    </ul>
</div>
<!-- Sidebar -->
