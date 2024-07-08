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

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bx-rss"></i>
                    <span key="t-bulksms"> License Application </span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('manage-applications')}}" key="t-bulksms">Manage Applications</a></li>
                    <li><a href="{{route('show-application-status', 'pending')}}" key="t-bulksms">Pending</a></li>
                    <li><a href="{{route('show-application-status', 'approved')}}" key="t-bulksms">Approved</a></li>
                    <li><a href="{{route('show-application-status', 'declined')}}" key="t-bulksms">Declined</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bx-check-double"></i>
                    <span key="t-bulksms"> Frequency Assignment </span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('show-application-status', 'verified')}}" key="t-bulksms">New Assignment</a></li>
                    <li><a href="{{route('show-application-status', 'assigned')}}" key="t-bulksms">Assigned Frequencies</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bx-certification"></i>
                    <span key="t-bulksms"> Certificates </span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('certificates', 'all')}}" key="t-bulksms">All</a></li>
                    <li><a href="{{route('certificates', 'valid')}}" key="t-bulksms">Valid</a></li>
                    <li><a href="{{route('certificates', 'expired')}}" key="t-bulksms">Expired</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bx-briefcase"></i>
                    <span key="t-bulksms"> Companies </span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('list-companies', 'all') }}" key="t-bulksms">All</a></li>
                    <li><a href="{{ route('list-companies', 'valid') }}" key="t-bulksms">Valid License</a></li>
                    <li><a href="{{ route('list-companies', 'expired') }}" key="t-bulksms">Expired License</a></li>
                </ul>
            </li>
        <li class="menu-title" key="t-menu">Invoicing</li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-wallet-alt"></i>
                <span key="t-bulksms"> Invoice </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('manage-invoices', 'invoices')}}" key="t-bulksms">All</a></li>
                <li><a href="{{route('manage-invoices', 'paid')}}" key="t-bulksms">Paid</a></li>
                <li><a href="{{route('manage-invoices', 'pending')}}" key="t-bulksms">Pending</a></li>
                <li><a href="{{route('manage-invoices', 'verified')}}" key="t-bulksms">Verified</a></li>
                <li><a href="{{route('manage-invoices', 'declined')}}" key="t-bulksms">Declined</a></li>
            </ul>
        </li>
        <li>
            <a href="{{route('tickets')}}" class="waves-effect">
                <i class="bx bx-support"></i>
                <span key="t-chat">Support Ticket</span>
            </a>
        </li>
        <li>
            <a href="{{route('faqs')}}" class="waves-effect">
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
        <li class="menu-title">Reports</li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="bx bx-chart"></i>
                    <span key="t-bulksms"> Reports </span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('report-handler', 'inflow')}}" key="t-bulksms">Inflow</a></li>
                    <li><a href="{{route('report-handler', 'certificate')}}" key="t-bulksms">Certificate</a></li>
                    <li><a href="{{route('report-handler', 'company')}}" key="t-bulksms">Company</a></li>
                </ul>
            </li>
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
