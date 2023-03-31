@extends('layouts.master-layout')
@section('current-page')
    Notifications
@endsection
@section('extra-styles')

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
                    <div class="h4 text-center">Notifications</div>
                    <p>Toggle which operation you should receive notifcation for when an event occurs.</p>
                    <div class="container pb-5">
                        <form action="{{route('save-notification-settings')}}" method="post">
                            @csrf
                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead>
                                    <tr>
                                        <th>Client Activity</th>
                                        <th>Choice</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>New comment posted</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" name="new_comment_posted" type="checkbox"  {{$notification->new_comment_posted == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$notification->new_comment_posted == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>New Journal Entry</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" name="new_journal_entry"  {{$notification->new_journal_entry == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$notification->new_journal_entry == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>A package has been purchased</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" name="package_purchased"  {{$notification->package_purchased == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$notification->package_purchased == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>An intake flow is started</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" name="intake_flow_started"  {{$notification->intake_flow_started == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$notification->intake_flow_started == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>An intake flow is completed</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" name="intake_flow_completed"  {{$notification->intake_flow_completed == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$notification->intake_flow_completed == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>A program module is completed</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" name="program_module_completed" {{$notification->program_module_completed == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$notification->program_module_completed == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <thead>
                                    <tr>
                                        <th>Appointment</th>
                                        <th>Choice</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>A reminder 5 minutes before a scheduled appointment</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" name="appointment_reminder" {{$notification->appointment_reminder == 1 ? "checked" : ''}}>
                                                <label class="form-check-label" for="formCheckcolor1">
                                                    {{$notification->appointment_reminder == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Client books an appointment</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" name="client_books_appointment"  {{$notification->client_books_appointment == 1 ? "checked" : ''}}>
                                                <label class="form-check-label" for="formCheckcolor1">
                                                    {{$notification->client_books_appointment == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Client cancels an appointment</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" name="client_cancel_appointment"  {{$notification->client_cancel_appointment == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$notification->client_cancel_appointment == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <thead>
                                    <tr>
                                        <th>Documents</th>
                                        <th>Choice</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>A new document is shared with you</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox"  name="shared_document" {{$notification->shared_document == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$notification->shared_document == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>A new folder is shared with you</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" name="shared_folder"  {{$notification->shared_folder == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$notification->shared_folder == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <thead>
                                    <tr>
                                        <th>Task</th>
                                        <th>Choice</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>A task is assigned to you</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" name="task_assigned" {{$notification->task_assigned == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$notification->task_assigned == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>A task status is updated.</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" name="task_status_updated"  {{$notification->task_status_updated == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$notification->task_status_updated == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-primary">Save changes <i class="bx bx-right-arrow"></i> </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')




@endsection
