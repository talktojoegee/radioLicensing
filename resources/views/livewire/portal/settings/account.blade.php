<div class="row">
   @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-all me-2"></i>
            {!! session()->get('success') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
   @if($errors->any())
       <div class="alert alert-warning alert-dismissible fade show" role="alert">
           <i class="mdi mdi-close me-2"></i>
           @foreach($errors->all() as $error)
               <li>{{$error}}</li>
           @endforeach
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
   @endif
    <div class="col-xl-9 col-md-9">
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom " role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Account</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Notification</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">Locations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-block">Permissions</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="home1" role="tabpanel">
                        <form wire:submit.prevent="saveAccountChanges">
                            @csrf
                            <div class="form-group">
                                <label for="">First Name <span class="text-danger">*</span></label>
                                <input type="text"  wire:model.defer="firstName" placeholder="First Name"  class="form-control">
                                @error('firstName') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Last Name <span class="text-danger">*</span></label>
                                <input type="text" wire:model.defer="lastName" placeholder="Last Name" class="form-control">
                                @error('lastName') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Email <span class="text-danger">*</span></label>
                                <input readonly type="text" wire:model.defer="email" placeholder="Email" class="form-control">
                                @error('email') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Cellphone Number</label>
                                <input type="text" wire:model.defer="cellphoneNumber" placeholder="Cellphone Number" class="form-control">
                                @error('cellphoneNumber') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Profile Picture</label> <br>
                                <input type="file" wire:model.defer="profilePicture" class="form-control-file">
                                @error('profilePicture') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            @if(isset($profilePicture))
                                <div class="form-group">
                                    <label for="">Profile Picture</label>
                                    <img src="{{ $profilePicture->temporaryUrl() }}" width="64" height="64">
                                </div>
                            @endif
                            <div class="form-group mt-3">
                                <label for="">Timezone<span class="text-danger">*</span></label>
                                <input type="text" wire:model.defer="timezone" placeholder="Timezone" class="form-control">
                                @error('timezone') <i class="text-danger">{{$message}}</i>@enderror
                            </div>
                            <div class="form-group mt-3 d-flex justify-content-center">
                                <button class="btn btn-custom">Save changes  </button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="profile1" role="tabpanel">
                        <form wire:submit.prevent="saveUserNotificationChanges">
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
                                                <input class="form-check-input" wire:model.defer="new_comment_posted" type="checkbox"  {{$new_comment_posted == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$new_comment_posted == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>New Journal Entry</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" wire:model.defer="new_journal_entry"  {{$new_journal_entry == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$new_journal_entry == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>A package has been purchased</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" wire:model.defer="package_purchased"  {{$package_purchased == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$package_purchased == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>An intake flow is started</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" wire:model.defer="intake_flow_started"  {{$intake_flow_started == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$intake_flow_started == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>An intake flow is completed</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" wire:model.defer="intake_flow_completed"  {{$intake_flow_completed == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$intake_flow_completed == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>A program module is completed</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" wire:model.defer="program_module_completed" {{$program_module_completed == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$program_module_completed == 1 ? "Yes" : 'No'}}
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
                                                <input class="form-check-input" type="checkbox" wire:model.defer="appointment_reminder" {{$appointment_reminder == 1 ? "checked" : ''}}>
                                                <label class="form-check-label" for="formCheckcolor1">
                                                    {{$appointment_reminder == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Client books an appointment</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" wire:model.defer="client_books_appointment"  {{$client_books_appointment == 1 ? "checked" : ''}}>
                                                <label class="form-check-label" for="formCheckcolor1">
                                                    {{$client_books_appointment == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Client cancels an appointment</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" wire:model.defer="client_cancel_appointment"  {{$client_cancel_appointment == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$client_cancel_appointment == 1 ? "Yes" : 'No'}}
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
                                                <input class="form-check-input" type="checkbox"  wire:model.defer="shared_document" {{$shared_document == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$shared_document == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>A new folder is shared with you</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" wire:model.defer="shared_folder"  {{$shared_folder == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$shared_folder == 1 ? "Yes" : 'No'}}
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
                                                <input class="form-check-input" type="checkbox" wire:model.defer="task_assigned" {{$task_assigned == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$task_assigned == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>A task status is updated.</td>
                                        <td>
                                            <div class="form-check form-check-primary mb-3">
                                                <input class="form-check-input" type="checkbox" wire:model.defer="task_status_updated"  {{$task_status_updated == 1 ? "checked" : ''}}>
                                                <label class="form-check-label">
                                                    {{$task_status_updated == 1 ? "Yes" : 'No'}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-custom">Save changes <i class="bx bx-right-arrow"></i> </button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="messages1" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-custom text-white">Add New Location</div>
                                    <div class="card-body">
                                        <form wire:submit.prevent="saveLocation">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Location Name <span class="text-danger">*</span></label> <br>
                                                <input type="text" class="form-control" placeholder="Location Name" wire:model.defer="locationName">
                                                @error('locationName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                            <div class="form-group mt-4">
                                                <label for="">Address <span class="text-danger">*</span></label> <br>
                                                <textarea wire:model.defer="address" placeholder="Type address here..." style="resize: none;"
                                                          class="form-control"></textarea>
                                                @error('address') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                            <div class="form-group d-flex justify-content-center mt-3">
                                                <button type="submit" class="btn btn-custom">Submit <i class="bx bx-right-arrow"></i> </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header bg-custom text-white">All Locations</div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table mb-0">

                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Location Name</th>
                                                    <th>Address</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $serial = 1;@endphp
                                                @foreach($locations as $location)
                                                    <tr>
                                                        <td>{{$serial++}}</td>
                                                        <td>{{$location->location_name ?? '' }}</td>
                                                        <td>{{$location->address ?? '' }}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editLocation_{{$location->id}}"> <i class="bx bx-pencil text-warning"></i> </a>
                                                            <div id="editLocation_{{$location->id}}" class="modal fade" tabindex="-1" aria-labelledby="editLocation_{{$location->id}}" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel">Edit Location</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form wire:submit.prevent="editLocation">
                                                                                @csrf
                                                                                <div class="form-group">
                                                                                    <label for="">Location Name <span class="text-danger">*</span></label> <br>
                                                                                    <input type="text" class="form-control" value="{{$location->location_name ?? '' }}" placeholder="Location Name" wire:model.defer="locationName">
                                                                                    @error('locationName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                                                </div>
                                                                                <div class="form-group mt-4">
                                                                                    <input type="hidden" wire:model.defer="locationId" value="{{$location->id}}">
                                                                                    <label for="">Address <span class="text-danger">*</span></label> <br>
                                                                                    <textarea wire:model.defer="address" placeholder="Type address here..." style="resize: none;"
                                                                                              class="form-control">{{$location->address ?? '' }}</textarea>
                                                                                    @error('address') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                                                </div>
                                                                                <div class="modal-footer d-flex justify-content-center mt-3">
                                                                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes <i class="bx bx-right-arrow"></i></button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="settings1" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-custom text-white">Add New Permission</div>
                                    <div class="card-body">
                                        <form wire:submit.prevent="savePermission">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Permission Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Permission Name" wire:model.defer="permissionName">
                                                @error('permissionName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                            <div class="form-group mt-4">
                                                <label for="">Module <span class="text-danger">*</span></label>
                                                <select class="form-control" wire:model.defer="module">
                                                    @foreach($modules as $module)
                                                        <option value="{{$module->id}}">{{$module->module_name ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                                @error('module') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                            </div>
                                            <div class="form-group d-flex justify-content-center mt-3">
                                                <button type="submit" class="btn btn-custom">Submit <i class="bx bx-right-arrow"></i> </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header bg-custom text-white">Manage Permissions</div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table mb-0">

                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Permission Name</th>
                                                    <th>Module</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $i = 1;@endphp
                                                @foreach($permissions as $permission)
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td>{{$permission->name ?? '' }}</td>
                                                        <td>{{$permission->getPermissionModule->module_name ?? '' }}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editPermission_{{$permission->id}}"> <i class="bx bx-pencil text-warning"></i> </a>
                                                            <div id="editPermission_{{$permission->id}}" class="modal fade" tabindex="-1" aria-labelledby="editPermission_{{$permission->id}}" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel">Edit Permission</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form wire:submit.prevent="editLocation">
                                                                                @csrf
                                                                                <div class="form-group">
                                                                                    <label for="">Permission Name <span class="text-danger">*</span></label> <br>
                                                                                    <input type="text" class="form-control" value="{{$permission->name ?? '' }}" placeholder="Permission Name" wire:model.defer="permissionName">
                                                                                    @error('permissionName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                                                </div>
                                                                                <div class="form-group mt-4">
                                                                                    <input type="hidden" wire:model.defer="permissionId" value="{{$permission->id}}">
                                                                                    <label for="">Address <span class="text-danger">*</span></label> <br>
                                                                                    <select class="form-control" wire:model.defer="module">
                                                                                        @foreach($modules as $module)
                                                                                            <option value="{{$module->id}}" {{$permission->module_id == $module->id ? 'selected' : '' }}>{{$module->module_name ?? ''}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('module') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                                                                </div>
                                                                                <div class="modal-footer d-flex justify-content-center mt-3">
                                                                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes <i class="bx bx-right-arrow"></i></button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card">
            <div class="card-header bg-custom text-white">Change Password</div>
            <div class="card-body">
                <form wire:submit.prevent="changePassword">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="">Current Password</label>
                        <input type="password" wire:model.defer="currentPassword" placeholder="Current Password" class="form-control">
                        @error('currentPassword') <i class="text-danger">{{$message}}</i>@enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">New Password</label>
                        <input type="password" wire:model.defer="password" placeholder="New Password" class="form-control">
                        @error('password') <i class="text-danger">{{$message}}</i>@enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Re-type Password <span class="text-danger">*</span></label>
                        <input type="password" wire:model.defer="password_confirmation" placeholder="Re-type Password" class="form-control">
                        @error('password_confirmation') <i class="text-danger">{{$message}}</i>@enderror
                    </div>
                    <div class="form-group mt-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-custom">Save changes  </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
