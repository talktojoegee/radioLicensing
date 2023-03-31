<div>
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success'))
                <div class="alert alert-success mb-4">
                    <strong>Great!</strong>
                    <hr class="message-inner-separator">
                    <p>{!! session()->get('success') !!}</p>
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-warning mb-4">
                    <strong>Whoops!</strong>
                    <hr class="message-inner-separator">
                    <p>{!! session()->get('error') !!}</p>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-custom text-white">Add New Module</div>
                <div class="card-body">
                    <form wire:submit.prevent="addNewModule">
                        @csrf
                        <div class="form-group">
                            <label for="">Module Name <span class="text-danger">*</span></label> <br>
                            <input placeholder="Enter Module Name" disabled type="text" class="form-control" wire:model.defer="moduleName">
                            @error('moduleName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Area</label> <br>
                            <select wire:model.defer="area" disabled id="" class="form-control">
                                <option selected disabled>--Select Area--</option>
                                <option value="0">General</option>
                                <option value="1">Super-admin/Admin</option>
                            </select>
                            @error('area') <i class="text-danger mt-2">{{$message}}</i> @enderror
                        </div>
                        <div class="form-group d-flex justify-content-center mt-3">
                            <button disabled type="submit" class="btn btn-custom">Submit <i class="bx bx-right-arrow"></i> </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-custom text-white">Published Modules</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Module Name</th>
                                <th>Area</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $serial = 1; @endphp
                            @foreach($modules as $module)
                                <tr>
                                    <th scope="row">{{$serial++}}</th>
                                    <td>{{$module->module_name ?? '' }}</td>
                                    <td>{{$module->area == 0 ? "General" : "Super-admin"}}</td>
                                    <td>No-action</td>
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

