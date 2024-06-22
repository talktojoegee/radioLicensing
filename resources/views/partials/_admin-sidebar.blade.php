<div id="sidebar-menu" style="">
    <ul class="metismenu list-unstyled" id="side-menu">
        @can('access-newsfeed')
            <li>
                <a href="{{route('timeline')}}" class="waves-effect">
                    <i class="bx bx-news"></i>
                    <span key="t-chat">Newsfeed</span>
                </a>
            </li>
        @endcan
        <li class="menu-title" key="t-menu">Radio Licensing</li>
        @can('access-bulksms')
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bx-rss"></i>
                    <span key="t-bulksms"> License </span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('manage-applications')}}" key="t-bulksms">Manage Applications</a></li>
                    <li><a href="{{route('show-application-status', 'verified')}}" key="t-bulksms">Frequency Assignment</a></li>
                    <li><a href="{{route('show-application-status', 'pending')}}" key="t-bulksms">Pending</a></li>
                    <li><a href="{{route('show-application-status', 'approved')}}" key="t-bulksms">Approved</a></li>
                    <li><a href="{{route('show-application-status', 'declined')}}" key="t-bulksms">Declined</a></li>
                </ul>
            </li>
        @endcan
            <li>
                <a href="{{route('certificates')}}" class="waves-effect">
                    <i class="bx bx-certification"></i>
                    <span key="t-chat">Certificates</span>
                </a>
            </li>
            <li>
                <a href="{{route('timeline')}}" class="waves-effect">
                    <i class="bx bx-briefcase"></i>
                    <span key="t-chat">Companies</span>
                </a>
            </li>
        <li class="menu-title" key="t-menu">Invoicing</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-briefcase"></i>
                <span key="t-bulksms"> Invoice </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @can('topup-bulksms')<li><a href="{{route('manage-invoices')}}" key="t-bulksms">Manage Invoices</a></li>@endcan
                @can('access-bulksms-wallet')<li><a href="{{route('top-up-transactions')}}" key="t-bulksms">Payments</a></li>@endcan
                @can('send-bulksms')<li><a href="{{route('compose-sms')}}" key="t-bulksms">Report</a></li>@endcan
            </ul>
        </li>
        <li>
            <a href="{{route('timeline')}}" class="waves-effect">
                <i class="bx bx-support"></i>
                <span key="t-chat">Support Ticket</span>
            </a>
        </li>
        <li>
            <a href="{{route('timeline')}}" class="waves-effect">
                <i class="bx bx-question-mark"></i>
                <span key="t-chat">FAQs</span>
            </a>
        </li>
        <li>
        <li class="menu-title" key="t-pages">COMMUNICATION</li>
        @can('access-bulksms')
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bxs-message"></i>
                    <span key="t-bulksms"> Bulk SMS </span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    @can('topup-bulksms')<li><a href="{{route('top-up')}}" key="t-bulksms">Top-up</a></li>@endcan
                    @can('access-bulksms-wallet')<li><a href="{{route('top-up-transactions')}}" key="t-bulksms">Wallet</a></li>@endcan
                    @can('send-bulksms')<li><a href="{{route('compose-sms')}}" key="t-bulksms">Compose</a></li>@endcan
                    <li><a href="{{route('schedule-sms')}}" key="t-bulksms">Schedule</a></li>
                    @can('bulksms-phonegroup') <li><a href="{{route('bulksms-messages')}}" key="t-bulksms">Messages</a></li> @endcan
                    @can('bulksms-phonegroup') <li><a href="{{route('phone-groups')}}" key="t-bulksms">Phone Group</a></li> @endcan
                </ul>
            </li>
        @endcan
        <li class="menu-title" key="t-pages">TIME</li>
        @can('access-calendar')
            <li>
                <a href="{{route('calendar')}}" class="waves-effect">
                    <i class="bx bx-calendar"></i>
                    <span key="t-chat">Calendar</span>
                </a>
            </li>
        @endcan
        <li>
            <a href="{{route('show-appointments')}}" class="waves-effect">
                <i class="bx bx-timer"></i>
                <span key="t-chat">Events</span>
            </a>
        </li>
        <li class="menu-title">Persons</li>
        @can('access-branches')
            <li>
                <a href="{{route('pastors')}}" class="waves-effect">
                    <i class="bx bxs-user-badge"></i>
                    <span key="t-chat">Users</span>
                </a>
            </li>
        @endcan
        <li class="menu-title">Extras</li>
        @can('access-documents')
            <li>
                <a href="{{route('cloud-storage')}}" class="waves-effect">
                    <i class="bx bx-file"></i>
                    <span key="t-chat">Documents</span>
                </a>
            </li>
        @endcan
        <li>
            <a href="{{route('my-notifications')}}" class="waves-effect">
                <i class="bx bx-alarm"></i>
                <span key="t-chat">Notifications</span>
            </a>
        </li>
        <li class="menu-title">Financial Accounts</li>
        @can('access-finance')
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bxs-landmark"></i>
                    <span key="t-crypto"> Financials </span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    @can('access-income') <li><a href="{{route('income')}}" key="t-wallet">Income</a></li> @endcan
                    @can('access-expenses')<li><a href="{{route('expense')}}" key="t-wallet">Expenses</a></li> @endcan
                    @can('access-accounts')<li><a href="{{route('accounting.accounts')}}" key="t-wallet">Account Summary</a></li> @endcan
                    @can('access-categories')<li><a href="{{route('accounting.categories')}}" key="t-wallet">Account Categories</a></li> @endcan
                </ul>
            </li>
        @endcan
        <li class="menu-title">Bulk Operations</li>
        @can('access-finance')
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bx-spreadsheet"></i>
                    <span key="t-crypto"> Bulk Import </span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    @can('access-remittance')<li><a href="{{route('bulk-import')}}" key="t-wallet">Bulk Import</a></li> @endcan
                    @can('access-remittance')<li><a href="{{route('approve-bulk-import')}}" key="t-wallet">Approve Bulk Import</a></li> @endcan
                </ul>
            </li>
        @endcan
        @can('access-finance-report')
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bxs-report"></i>
                    <span key="t-report"> Reports</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    @can('access-income-report')<li><a href="{{route('cashbook', 'income')}}" key="t-report">Income</a></li> @endcan
                    @can('access-expense-report')<li><a href="{{route('cashbook', 'expense')}}" key="t-report">Expense</a></li> @endcan
                    @can('access-cashbook') <li><a href="{{route('cashbook', 'cashbook')}}" key="t-report">Cashbook</a></li> @endcan
                    @can('access-audit-trail') <li><a href="{{route('appointment-reports')}}" key="t-report">Audit Trail</a></li> @endcan
                </ul>
            </li>
        @endcan
        @can('access-settings')
            <li class="menu-title">Administration</li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bx-cog"></i>
                    <span key="t-settings">Settings</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('sms-settings')}}" key="t-settings">SMS</a></li>
                    <li><a href="{{route('branches-settings')}}" key="t-settings">Sections</a></li>
                    <li><a href="{{route('workflow-settings')}}" key="t-settings">Workflow</a></li>
                    <li><a href="{{route('church-branches')}}" key="t-settings">Section Heads</a></li>
                </ul>
            </li>
        @endcan
    </ul>
</div>
