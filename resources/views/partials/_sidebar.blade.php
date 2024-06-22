<div id="sidebar-menu">
    <ul class="metismenu list-unstyled" id="side-menu">

            <li class="menu-title" key="t-menu">Radio Licensing</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-rss"></i>
                        <span key="t-bulksms"> License </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('new-radio-application')}}" key="t-bulksms">New Application</a></li>
                        <li><a href="{{route('manage-applications')}}" key="t-bulksms">My Applications</a></li>
                        <li><a href="{{route('compose-sms')}}" key="t-bulksms">Assigned</a></li>
                        <li><a href="{{route('compose-sms')}}" key="t-bulksms">Reports</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-briefcase"></i>
                        <span key="t-bulksms"> Company </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('company-profile')}}" key="t-bulksms">Profile</a></li>
                        <li><a href="{{route('persons')}}" key="t-bulksms">Persons</a></li>
                        <li><a href="{{route('show-workstations')}}" key="t-bulksms">Work Stations</a></li>
                    </ul>
                </li>

            <li class="menu-title" key="t-menu">Invoicing</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-briefcase"></i>
                        <span key="t-bulksms"> Invoice </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('manage-invoices')}}" key="t-bulksms">Manage Invoices</a></li>
                        <li><a href="{{route('top-up-transactions')}}" key="t-bulksms">Payments</a></li>
                        <li><a href="{{route('compose-sms')}}" key="t-bulksms">Report</a></li>
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
    </ul>
</div>
