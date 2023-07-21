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
                    <div class="modal-header ">
                        <h6 class="modal-title text-uppercase">
                            Basic Settings
                        </h6>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="saveOrganizationSettings()">
                            @csrf
                            <div class="row mt-3">
                                <div class="form-group col-md-12 mb-3">
                                    <label for="">Church Name <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="organizationName" value="{{$organizationName}}" placeholder="Church Name" class="form-control">
                                    @error('organizationName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">CAC RC. No.</label>
                                    <input type="text" wire:model.defer="organizationCode" placeholder="CAC RC. No." class="form-control">
                                    @error('organizationCode') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label for="">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="organizationPhoneNumber" placeholder=" Phone Number" class="form-control">
                                    @error('organizationPhoneNumber') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label for="">Email Address <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="organizationEmail" placeholder=" Email Address" class="form-control">
                                    @error('organizationEmail') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label for="">Address   <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="addressLine" placeholder="Address  " class="form-control">
                                    @error('addressLine') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label for="">City <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="city" placeholder="City" class="form-control">
                                    @error('city') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label for="">State </label>
                                    <input type="text" wire:model.defer="state" placeholder="Enter state" class="form-control">
                                    @error('state') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label for="">Postal Code </label>
                                    <input type="text" wire:model.defer="zipCode" placeholder="Enter postal code" class="form-control">
                                    @error('zipCode') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label for="">Country </label>
                                    <input type="text" wire:model.defer="country" placeholder="Country" class="form-control">
                                    @error('country') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                            </div>
                            <div class="form-group d-flex mt-3 justify-content-center">
                                <button type="submit" class="btn btn-primary">Save changes <i class="bx bx-right-arrow"></i> </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="modal-header ">
                        <h6 class="modal-title text-uppercase">Logo & Favicon</h6>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="saveLogo">
                            @csrf
                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                <label for="">Logo</label> &nbsp; &nbsp;
                                <input type="file" wire:model.lazy="logo" class="form-control-file">
                                <span class="input-group-btn input-group-append">
                                    <button class="btn btn-primary bootstrap-touchspin-up" type="submit"><i class="bx bxs-cloud-upload mr-2"></i>Upload Logo</button>
                                </span> <br>
                                @error('logo') <i class="text-danger mt-2">{{$message}}</i> @enderror
                            </div>
                            @if(isset($logo))
                                <div class="form-group">
                                    <label for="">Logo Preview:</label>
                                    <img src="{{ $logo->temporaryUrl() }}" width="64" height="64">
                                </div>
                            @endif
                            </form>

                        <form wire:submit.prevent="saveFavicon" class="mt-5">
                            @csrf
                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                <label for="">Favicon</label> &nbsp; &nbsp;
                                <input type="file" wire:model.lazy="favicon" class="form-control-file">
                                <span class="input-group-btn input-group-append">
                                    <button class="btn btn-primary bootstrap-touchspin-up" type="submit"><i class="bx bxs-cloud-upload mr-2"></i>Upload Favicon</button>
                                </span> <br>
                                @error('favicon') <i class="text-danger mt-2">{{$message}}</i> @enderror
                            </div>
                            @if(isset($favicon))
                                <div class="form-group">
                                    <label for="">Favicon Preview:</label>
                                    <img src="{{ $favicon->temporaryUrl() }}" width="64" height="64">
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

