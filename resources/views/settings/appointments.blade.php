@extends('layouts.master-layout')
@section('current-page')
    Appointments
@endsection
@section('extra-styles')
    <link href="/assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/toastify.css">
    <link rel="stylesheet" href="/css/nprogress.css">
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    @if(session()->has('success'))
        <div class="row" role="alert">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>

                    {!! session()->get('success') !!}

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body" style="padding: 2px;">
            <div class="row">
                <div class="col-md-3">
                    @include('settings.partial._sidebar-menu')
                </div>
                <div class="col-md-9 mt-4">
                    <div class="h4 text-center">Appointments</div>
                    <p>You can edit all your default appointment settings here.</p>
                    <div class="container pb-5">
                        <div class="table-responsive mt-3">
                            <table class="table mb-0">

                                <thead class="table-light">
                                <tr>
                                    <th>General Availability</th>
                                    <th><button type="button" class="btn text-primary float-end mr-5" data-bs-toggle="modal" data-bs-target="#generalAvailability"> <i class="bx bx-pencil mr-2"></i> Edit</button></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Availability by Appointment Type</td>
                                    <td style="text-align: right"> <strong>{{$settings->avail_by_appt_type == 1 ? 'Enabled' : 'Disabled'}}</strong> </td>
                                </tr>
                                <tr>
                                    <td>Availability by Location</td>
                                    <td style="text-align: right"> <strong>{{$settings->avail_by_location == 1 ? 'Enabled' : 'Disabled'}}</strong> </td>
                                </tr>
                                <tr>
                                    <td>Availability by Contact Type</td>
                                    <td style="text-align: right"> <strong>{{$settings->avail_by_contact_type == 1 ? 'Enabled' : 'Disabled'}}</strong> </td>
                                </tr>

                                <thead class="table-light">
                                <tr>
                                    <th>Appointment Timing</th>
                                    <th><button type="button" class="btn text-primary float-end mr-5" data-bs-toggle="modal" data-bs-target="#appointmentTiming"> <i class="bx bx-pencil mr-2"></i> Edit</button></th>
                                </tr>
                                </thead>
                                <tr>
                                    <td>Prevent Same Day Appointments</td>
                                    <td style="text-align: right"> <strong>{{$settings->pre_same_day_appt == 1 ? 'Yes' : 'No'}}</strong> </td>
                                </tr>
                                <tr>
                                    <td>Appointment Buffer</td>
                                    <td style="text-align: right"> <strong>{{$settings->appt_buffer ?? 0 }} minutes between appointments</strong> </td>
                                </tr>
                                <tr>
                                    <td>Only Allow Appointments at Specific Intervals</td>
                                    <td style="text-align: right"> <strong>
                                            @switch($settings->only_allow_appt_spec_intervals)
                                                @case(1)
                                                Allow any Interval
                                                @break
                                                @case(2)
                                                Every 30 minutes (only :00 or :30)
                                                @break
                                                @case(3)
                                                Every hour (only :00)
                                                @break
                                            @endswitch
                                        </strong> </td>
                                </tr>
                                <tr>
                                    <td>Minimum Time in Advance</td>
                                    <td style="text-align: right"> <strong>
                                            @switch($settings->min_time_advance)
                                                @case(1)
                                                No limit
                                                @break
                                                @case(2)
                                                1 hour before
                                                @break
                                                @case(3)
                                                3 hours before
                                                @break
                                                @case(4)
                                                6 hours before
                                                @break
                                                @case(5)
                                                9 hours before
                                                @break
                                                @case(6)
                                                12 hours before
                                                @break
                                            @endswitch
                                        </strong> </td>
                                </tr>
                                <tr>
                                    <td>Maximum Days in Advance</td>
                                    <td style="text-align: right"> <strong>{{$settings->max_time_advance ?? 0}}</strong> </td>
                                </tr>
                                <tr>
                                    <td>Calendar Display Default View</td>
                                    <td style="text-align: right"> <strong>{{date('h:i A', strtotime($settings->calendar_start))}} - {{date('h:i A', strtotime($settings->calendar_end))}}</strong> </td>
                                </tr>
                                <thead class="table-light">
                                <tr>
                                    <th>Appointment Alerts</th>
                                    <th><button type="button" class="btn text-primary float-end mr-5" data-bs-toggle="modal" data-bs-target="#appointmentAlert"> <i class="bx bx-pencil mr-2"></i> Edit</button></th>
                                </tr>
                                </thead>
                                <tr>
                                    <td>Send Initial Notice Email to Clients</td>
                                    <td style="text-align: right"> <strong>{{$settings->send_init_notice_email == 1 ? 'Yes' : 'No'}}</strong> </td>
                                </tr>
                                <tr>
                                    <td>Client Email Reminders Active</td>
                                    <td style="text-align: right"> <strong>
                                            @switch($settings->client_email_reminder)
                                                @case(1)
                                                One hour before
                                                @break
                                                @case(2)
                                                Two hours before
                                                @break
                                                @case(3)
                                                One day before
                                                @break
                                                @case(4)
                                                Two days before
                                                @break
                                                @case(5)
                                                Three days before
                                                @break
                                                @case(6)
                                                Four days before
                                                @break
                                            @endswitch
                                        </strong> </td>
                                </tr>
                                <tr>
                                    <td>Client Text Reminders Active</td>
                                    <td style="text-align: right"> <strong>
                                            @switch($settings->client_sms_reminder)
                                                @case(1)
                                                One hour before
                                                @break
                                                @case(2)
                                                Two hours before
                                                @break
                                                @case(3)
                                                One day before
                                                @break
                                                @case(4)
                                                Two days before
                                                @break
                                                @case(5)
                                                Three days before
                                                @break
                                                @case(6)
                                                Four days before
                                                @break
                                            @endswitch
                                        </strong> </td>
                                </tr>
                                <tr>
                                    <td>Client Intake Form Reminder Active</td>
                                    <td style="text-align: right"> <strong>{{$settings->client_form_reminder == 1 ? 'Yes' : 'No'}}</strong> </td>
                                </tr>
                                <thead class="table-light">
                                <tr>
                                    <th>Confirmation & Cancellation</th>
                                    <th><button type="button" class="btn text-primary float-end mr-5" data-bs-toggle="modal" data-bs-target="#confirmationCancellation"> <i class="bx bx-pencil mr-2"></i> Edit</button></th>
                                </tr>
                                </thead>
                                <tr>
                                    <td>Clients Can Cancel</td>
                                    <td style="text-align: right"> <strong>{{$settings->client_can_cancel_appt == 1 ? 'Yes' : 'No'}}</strong> </td>
                                </tr>
                                <tr>
                                    <td>Clients Can Reschedule</td>
                                    <td style="text-align: right"> <strong>{{$settings->client_can_reschedule_appt == 1 ? 'Yes' : 'No'}}</strong> </td>
                                </tr>
                                <tr>
                                    <td>Require Clients to Confirm your Appointments</td>
                                    <td style="text-align: right"> <strong>{{$settings->require_client_confirm_appt == 1 ? 'Yes' : 'No'}}</strong> </td>
                                </tr>
                                <tr>
                                    <td>Automatically Confirm Appointments</td>
                                    <td style="text-align: right"> <strong>{{$settings->auto_confirm_appt == 1 ? 'Yes' : 'No'}}</strong> </td>
                                </tr>
                                <tr>
                                    <td>Clients Can Confirm or Cancel via Text Message</td>
                                    <td style="text-align: right"> <strong>{{$settings->client_can_cancel_appt_via_txt == 1 ? 'Yes' : 'No'}}</strong> </td>
                                </tr>
                                <thead class="table-light">
                                <tr>
                                    <th>Credits</th>
                                    <th><button type="button" class="btn text-primary float-end mr-5" data-bs-toggle="modal" data-bs-target="#credit"> <i class="bx bx-pencil mr-2"></i> Edit</button></th>
                                </tr>
                                </thead>
                                <tr>
                                    <td>Allow Booking Without Credits</td>
                                    <td style="text-align: right"> <strong>{{$settings->allow_book_without_credits == 1 ? 'Yes' : 'No'}}</strong> </td>
                                </tr>
                                <tr>
                                    <td>Restore Credit When an Appointment is Cancelled
                                    </td>
                                    <td style="text-align: right"> <strong>{{$settings->restore_credit_when_appt_cancelled == 1 ? 'Yes' : 'No'}}</strong> </td>
                                </tr>
                                <thead class="table-light">
                                <tr>
                                    <th>Contact Types</th>
                                    <th><button type="button" class="btn text-primary float-end mr-5" data-bs-toggle="modal" data-bs-target="#contactTypes"> <i class="bx bx-pencil mr-2"></i> Edit</button></th>
                                </tr>
                                </thead>
                                <tr>
                                    <td>Supported Contact Types</td>
                                    <td style="text-align: right"> <strong>Video Call, In Person, Phone Call</strong> </td>
                                </tr>
                                <tr>
                                    <td>Initiates Phone Call Appointments</td>
                                    <td style="text-align: right"> <strong>Provider</strong> </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal right fade" id="generalAvailability" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title" id="myModalLabel2">Edit General Availability</h4>
                </div>

                <div class="modal-body">
                    <form action="">
                        @csrf
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                <tr>
                                    <td>Set Availability by Appointment Type. Set up different availability for each of your appointment types</td>
                                    <td>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" id="availByApptType" name="availByApptType"  type="checkbox"
                                                   {{$settings->avail_by_appt_type == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="appointmentType">{{$settings->avail_by_appt_type == 1 ? 'Yes' : 'No'}}</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Set Availability by Location. Set up different availability for each of your locations (used for multi-office practices)
                                    </td>
                                    <td>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" id="availByLocation" name="availByLocation"  type="checkbox" {{$settings->avail_by_location == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="location">{{$settings->avail_by_location == 1 ? 'Yes' : 'No'}}</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Set Availability by Contact Type. Set up different availability for each of your contact types</td>
                                    <td>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" id="availByContactType" name="availByContactType"  type="checkbox" {{$settings->avail_by_contact_type == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="contactType">{{$settings->avail_by_contact_type == 1 ? 'Yes' : 'No'}}</label>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group d-flex justify-content-center mt-5">
                            <div class="btn-group">
                                <button id="generalAvailabilityChangesBtn" class="btn btn-primary  waves-effect waves-light">Save changes <i class="bx bx-right-arrow"></i> </button>
                                <button id="savingGeneralAvailabilityChangesBtn" type="button" disabled class="btn btn-primary waves-effect waves-light">
                                    <i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Saving changes...
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal right fade" id="contactTypes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title" id="myModalLabel2">Edit Contact Types</h4>
                </div>

                <div class="modal-body">
                    <h6>SUPPORTED CONTACT TYPES</h6>
                    <p>These contact types will appear as options in your appointment type settings. You can set these per appointment type. The order will influence which ones will be shown first to clients and providers.</p>
                    <form action="">
                        @csrf
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="formCheck2" checked="">
                            <label class="form-check-label">
                                <i class="bx bx-video mr-2"></i> Telehealth
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="formCheck2" checked="">
                            <label class="form-check-label">
                                <i class="bx bx-building-house mr-2"></i> In Person
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="formCheck2" checked="">
                            <label class="form-check-label">
                                <i class="bx bx-phone-call mr-2"></i> Phone Call
                            </label>
                        </div>
                        <div class="form-group mb-4">
                            <strong>NOTE: </strong> APPOINTMENTS NEED AT LEAST ONE CONTACT TYPE TO BE ENABLED IN ORDER TO BE BOOKED BY PROVIDERS AND/OR CLIENTS.
                        </div>
                        <hr>
                        <h5 class="mb-4"> <i class="bx bx-phone"></i> Phone Call Preference</h5>
                        <div class="form-check form-radio-outline form-radio-primary mb-3">
                            <input class="form-check-input" type="radio" name="formRadio1" checked="">
                            <label class="form-check-label" for="formRadio1">
                                Provider will call client
                            </label>
                        </div>
                        <div class="form-check form-radio-outline form-radio-primary mb-3">
                            <input class="form-check-input" type="radio" name="formRadio1">
                            <label class="form-check-label" for="formRadio1">
                                Client should call provider
                            </label>
                        </div>
                        <div class="form-group d-flex justify-content-center mt-5">
                            <button class="btn btn-primary">Save changes <i class="bx bx-right-arrow"></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal right fade" id="appointmentTiming" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title" id="myModalLabel2">Edit Appointment Timing</h4>
                </div>

                <div class="modal-body">
                    <div class="table table-responsive">
                        <table class="table mb-0">
                            <tbody>
                            <tr>
                                <td>Prevent Same Day Appointments. Prevent clients from booking same-day appointments? (e.g., book an appointment for today)</td>
                                <td>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" id="preSameDayAppt" name="preSameDayAppt"  type="checkbox"
                                               {{$settings->pre_same_day_appt == 1 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="appointmentType">{{$settings->pre_same_day_appt == 1 ? 'On' : 'Off'}}</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Appointment Buffer. Do you want a minimum time in between appointments? (prevents back-to-back)
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select name="apptBuffer" id="apptBuffer" class="form-control">
                                            <option value="0" {{$settings->appt_buffer == 0 ? 'selected' : '' }}>0</option>
                                            <option value="15" {{$settings->appt_buffer == 15 ? 'selected' : '' }}>15</option>
                                            <option value="30" {{$settings->appt_buffer == 30 ? 'selected' : '' }}>30</option>
                                            <option value="45" {{$settings->appt_buffer == 45 ? 'selected' : '' }}>45</option>
                                            <option value="60" {{$settings->appt_buffer == 60 ? 'selected' : '' }}>60</option>
                                            <option value="75" {{$settings->appt_buffer == 75 ? 'selected' : '' }}>75</option>
                                            <option value="90" {{$settings->appt_buffer == 90 ? 'selected' : '' }}>90</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">ONLY ALLOW APPOINTMENTS AT SPECIFIC INTERVALS
                                    <div class="form-group">
                                        <select name="onlyAllowApptSpecIntervals" id="onlyAllowApptSpecIntervals" class="form-control">
                                            <option value="1" {{$settings->only_allow_appt_spec_intervals == 1 ? 'selected' : '' }}>Allow any interval</option>
                                            <option value="2" {{$settings->only_allow_appt_spec_intervals == 2 ? 'selected' : '' }}>Every 30 minutes (only :00 or :30)</option>
                                            <option value="3" {{$settings->only_allow_appt_spec_intervals == 3 ? 'selected' : '' }}>Every Hour (only :00)</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Minimum Time in Advance. Do you want to prevent clients from booking too close to the date of the appointment?
                                    <div class="form-group">
                                        <select name="minTimeAdvance" id="minTimeAdvance" class="form-control">
                                            <option value="1" {{$settings->min_time_advance == 1 ? 'selected' : '' }}>No limit</option>
                                            <option value="2" {{$settings->min_time_advance == 2 ? 'selected' : '' }}>1 hour before</option>
                                            <option value="3" {{$settings->min_time_advance == 3 ? 'selected' : '' }}>3 hours before</option>
                                            <option value="4" {{$settings->min_time_advance == 4 ? 'selected' : '' }}>6 hours before</option>
                                            <option value="5" {{$settings->min_time_advance == 5 ? 'selected' : '' }}>9 hours before</option>
                                            <option value="6" {{$settings->min_time_advance == 6 ? 'selected' : '' }}>12 hours before</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Maximum Days in Advance. Do you want to prevent an appointment too far in the future?
                                    <div class="form-group">
                                        <input id="maxTimeAdvance" name="maxTimeAdvance" value="{{$settings->max_time_advance ?? 1 }}" type="number" placeholder="Max. days" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Calendar Display Default View. Select the hours to display when setting weekly availability and where the calendar should start by default
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">START TIME</label>
                                                <div class="input-group" id="timepicker-input-group1">
                                                    <input id="calendarStart" name="calendarStart" value="{{ date('H:i A', strtotime($settings->calendar_start))  }}" type="text" class="form-control" data-provide="timepicker">
                                                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">END TIME</label>
                                                <div class="input-group" id="timepicker-input-group1">
                                                    <input id="calendarEnd" name="calendarEnd" type="text" {{ date('H:i A', strtotime($settings->calendar_end))  }} class="form-control" data-provide="timepicker">
                                                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group d-flex justify-content-center mt-1">
                        <div class="btn-group">
                            <button id="appointmentTimingChangesBtn" class="btn btn-primary  waves-effect waves-light">Save changes <i class="bx bx-right-arrow"></i> </button>
                            <button id="savingAppointmentTimingChangesBtn" type="button" disabled class="btn btn-primary waves-effect waves-light">
                                <i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Saving changes...
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal right fade" id="appointmentAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title" id="myModalLabel2">Edit Appointment Alerts</h4>
                </div>

                <div class="modal-body">
                    <div class="table table-responsive">
                        <table class="table mb-0">
                            <tbody>
                            <tr>
                                <td>Initial Appointment Confirmation. Turn this setting on to trigger a confirmation email to your client at the time an appointment is booked.</td>
                                <td>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" id="sendInitNoticeEmail" name="sendInitNoticeEmail"  type="checkbox"
                                               {{$settings->send_init_notice_email == 1 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="appointmentType">On</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Appointment Reminder Emails. Select when you would like clients to receive reminders for upcoming appointments.
                                    <div class="form-group mt-3">
                                        <select name="clientEmailReminder" id="clientEmailReminder" class="form-control">
                                            <option value="1" {{$settings->client_email_reminder == 1 ? 'selected' : '' }}>One hour before</option>
                                            <option value="2" {{$settings->client_email_reminder == 2 ? 'selected' : '' }}>Two hours before</option>
                                            <option value="3" {{$settings->client_email_reminder == 3 ? 'selected' : '' }}>One day before</option>
                                            <option value="4" {{$settings->client_email_reminder == 4 ? 'selected' : '' }}>Two days before</option>
                                            <option value="5" {{$settings->client_email_reminder == 5 ? 'selected' : '' }}>Three days before</option>
                                            <option value="6" {{$settings->client_email_reminder == 6 ? 'selected' : '' }}>Four days before</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Appointment Reminder Texts. Select when you would like clients to receive SMS text reminders for upcoming appointments.
                                    <div class="form-group mt-3">
                                        <select name="clientSmsReminder" id="clientSmsReminder" class="form-control">
                                            <option value="1" {{$settings->client_sms_reminder == 1 ? 'selected' : '' }}>One hour before</option>
                                            <option value="2" {{$settings->client_sms_reminder == 2 ? 'selected' : '' }}>Two hours before</option>
                                            <option value="3" {{$settings->client_sms_reminder == 3 ? 'selected' : '' }}>One day before</option>
                                            <option value="4" {{$settings->client_sms_reminder == 4 ? 'selected' : '' }}>Two days before</option>
                                            <option value="5" {{$settings->client_sms_reminder == 5 ? 'selected' : '' }}>Three days before</option>
                                            <option value="6" {{$settings->client_sms_reminder == 6 ? 'selected' : '' }}>Four days before</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Client Intake Form Reminder. Send email reminder to complete intake forms two days before appointment.</td>
                                <td>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" id="clientFormReminder" name="clientFormReminder"  type="checkbox" {{$settings->client_form_reminder == 1 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="appointmentType">On</label>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group d-flex justify-content-center mt-1">
                        <div class="btn-group">
                            <button id="appointmentAlertsChangesBtn" class="btn btn-primary  waves-effect waves-light">Save changes <i class="bx bx-right-arrow"></i> </button>
                            <button id="savingAppointmentAlertsChangesBtn" type="button" disabled class="btn btn-primary waves-effect waves-light">
                                <i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Saving changes...
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal right fade" id="confirmationCancellation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title" id="myModalLabel2">Edit Confirmation & Cancellation</h4>
                </div>

                <div class="modal-body">
                    <div class="table table-responsive">
                        <table class="table mb-0">
                            <tbody>
                            <tr>
                                <td>Clients Can Cancel Appointments. Should clients be allowed to cancel appointments?</td>
                                <td>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" name="clientCanCancelAppt" id="clientCanCancelAppt"  type="checkbox"
                                               {{$settings->client_can_cancel_appt == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="appointmentType">On</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Clients Can Reschedule Appointments. Should clients be allowed to reschedule appointments?</td>
                                <td>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" name="clientCanRescheduleAppt" id="clientCanRescheduleAppt"  type="checkbox"
                                               {{$settings->client_can_reschedule_appt == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="appointmentType">On</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Require Clients to Confirm your Appointments. Should clients be asked to confirm appointments that you schedule for them?</td>
                                <td>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" name="requireClientConfirmAppt" id="requireClientConfirmAppt" type="checkbox"
                                               {{$settings->require_client_confirm_appt == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="appointmentType">On</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Automatically Confirm Appointments. Should appointments that are booked by clients automatically be set as 'confirmed' status?</td>
                                <td>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" name="autoConfirmAppt"  id="autoConfirmAppt" type="checkbox"
                                               {{$settings->auto_confirm_appt == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="appointmentType">On</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Clients Can Confirm or Cancel via Text Message. Should clients be allowed to confirm and cancel appointments via SMS text reminders?</td>
                                <td>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" name="clientCanCancelApptViaTxt" id="clientCanCancelApptViaTxt"  type="checkbox"
                                               {{$settings->client_can_cancel_appt_via_txt == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="appointmentType">On</label>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group d-flex justify-content-center mt-1">
                        <div class="btn-group">
                            <button id="confirmationCancellationChangesBtn" class="btn btn-primary  waves-effect waves-light">Save changes <i class="bx bx-right-arrow"></i> </button>
                            <button id="savingConfirmationCancellationChangesBtn" type="button" disabled class="btn btn-primary waves-effect waves-light">
                                <i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Saving changes...
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal right fade" id="credit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title" id="myModalLabel2">Edit Credits</h4>
                </div>

                <div class="modal-body">
                    <div class="table table-responsive">
                        <table class="table mb-0">
                            <tbody>
                            <tr>
                                <td>Allow Booking Without Credits. Allows clients to book appointments if they have no credits.</td>
                                <td>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" name="allowBookWithoutCredits" id="allowBookWithoutCredits"  type="checkbox"
                                               {{$settings->allow_book_without_credits == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="appointmentType">On</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Restore Credit When an Appointment is Cancelled. Give the client back the credit for the appointment when the appointment is cancelled.</td>
                                <td>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" name="restoreCreditWhenApptCancelled" id="restoreCreditWhenApptCancelled" type="checkbox" {{$settings->restore_credit_when_appt_cancelled == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="appointmentType">On</label>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group d-flex justify-content-center mt-1">
                        <div class="btn-group">
                            <button id="creditChangesBtn" class="btn btn-primary  waves-effect waves-light">Save changes <i class="bx bx-right-arrow"></i> </button>
                            <button id="savingCreditChangesBtn" type="button" disabled class="btn btn-primary waves-effect waves-light">
                                <i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Saving changes...
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('right-sidebar')

@endsection
@section('extra-scripts')
    <script src="/js/axios.min.js"></script>
    <script src="/js/nprogress.js"></script>
    <script src="/js/toastify.js"></script>
    <script src="/assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#savingGeneralAvailabilityChangesBtn').hide();
            $('#savingAppointmentTimingChangesBtn').hide();
            $('#savingAppointmentAlertsChangesBtn').hide();
            $('#savingConfirmationCancellationChangesBtn').hide();
            $('#savingCreditChangesBtn').hide();
            $('#generalAvailabilityChangesBtn').on("click", function(e){
                e.preventDefault();
                const url = "{{route('update-appointment-settings')}}";
                $('#generalAvailabilityChangesBtn').hide();
                $('#savingGeneralAvailabilityChangesBtn').show();
                NProgress.start();
                const data = {
                    availByApptType: $('#availByApptType').is(":checked"),
                    availByLocation: $('#availByLocation').is(":checked"),
                    availByContactType: $('#availByContactType').is(":checked"),
                    type:'general-availability',
                };
                updateSettings(url, data, 'generalAvailabilityChangesBtn', 'savingGeneralAvailabilityChangesBtn');

            });

            $('#appointmentTimingChangesBtn').on("click", function(e){
                e.preventDefault();
                const url = "{{route('update-appointment-settings')}}";
                $('#appointmentTimingChangesBtn').hide();
                $('#savingAppointmentTimingChangesBtn').show();
                NProgress.start();
                const data = {
                    preSameDayAppt: $('#preSameDayAppt').is(":checked"),
                    apptBuffer: $('#apptBuffer').val(),
                    onlyAllowApptSpecIntervals: $('#onlyAllowApptSpecIntervals').val(),
                    minTimeAdvance: $('#minTimeAdvance').val(),
                    maxTimeAdvance: $('#maxTimeAdvance').val(),
                    calendarStart: $('#calendarStart').val(),
                    calendarEnd: $('#calendarEnd').val(),
                    type: 'appointment-timing',
                };
                updateSettings(url, data, 'appointmentTimingChangesBtn', 'savingAppointmentTimingChangesBtn');

            });

            $('#appointmentAlertsChangesBtn').on("click", function(e){
                e.preventDefault();
                const url = "{{route('update-appointment-settings')}}";
                $('#appointmentAlertsChangesBtn').hide();
                $('#savingAppointmentAlertsChangesBtn').show();
                NProgress.start();
                const data = {
                    sendInitNoticeEmail: $('#sendInitNoticeEmail').is(":checked"),
                    clientFormReminder: $('#clientFormReminder').is(":checked"),
                    clientEmailReminder: $('#clientEmailReminder').val(),
                    clientSmsReminder: $('#clientSmsReminder').val(),
                    type: 'appointment-alerts',
                };
                updateSettings(url, data, 'appointmentAlertsChangesBtn', 'savingAppointmentAlertsChangesBtn');

            });

            $('#confirmationCancellationChangesBtn').on("click", function(e){
                e.preventDefault();
                const url = "{{route('update-appointment-settings')}}";
                $('#confirmationCancellationChangesBtn').hide();
                $('#savingConfirmationCancellationChangesBtn').show();
                NProgress.start();
                const data = {
                    clientCanCancelAppt: $('#clientCanCancelAppt').is(":checked"),
                    clientCanRescheduleAppt: $('#clientCanRescheduleAppt').is(":checked"),
                    requireClientConfirmAppt: $('#requireClientConfirmAppt').is(":checked"),
                    autoConfirmAppt: $('#autoConfirmAppt').is(":checked"),
                    clientCanCancelApptViaTxt: $('#clientCanCancelApptViaTxt').is(":checked"),
                    type: 'confirmation-cancellation',
                };
                updateSettings(url, data, 'confirmationCancellationChangesBtn', 'savingConfirmationCancellationChangesBtn');

            });

            $('#creditChangesBtn').on("click", function(e){
                e.preventDefault();
                const url = "{{route('update-appointment-settings')}}";
                $('#creditChangesBtn').hide();
                $('#savingCreditChangesBtnChangesBtn').show();
                NProgress.start();
                const data = {
                    allowBookWithoutCredits: $('#allowBookWithoutCredits').is(":checked"),
                    restoreCreditWhenApptCancelled: $('#restoreCreditWhenApptCancelled').is(":checked"),
                    type: 'credits',
                };
                updateSettings(url, data, 'creditChangesBtn', 'savingCreditChangesBtnChangesBtn');

            });
        });

        function updateSettings(url, data, activeBtn, progressBtn){
            axios.post(url, data)
            .then(res=>{
                NProgress.done();
                Toastify({
                    text: res.data.message,
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    onClick: function(){}
                }).showToast();
                $(`#${activeBtn}`).show();
                $(`#${progressBtn}`).hide();
            })
            .catch(error=>{
                NProgress.done();
                Toastify({
                    text: "Whoops! Something went wrong. Try again later",
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: "linear-gradient(to right, #ff0000, #96c93d)",
                    },
                    onClick: function(){}
                }).showToast();
                console.log(error)
                $(`#${activeBtn}`).show();
                $(`#${progressBtn}`).hide();
            });
        }
    </script>
@endsection
