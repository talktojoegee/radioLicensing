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
                    <div class="card-header bg-custom text-white">Create Your Organization</div>
                    <div class="card-body">
                        <form wire:submit.prevent="saveOrganizationSettings()">
                            @csrf
                            <div class="row mt-3">
                                <div class="form-group col-md-12 mb-3">
                                    <label for="">Organization Name <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="organizationName" value="{{$organizationName}}" placeholder="Organization Name" class="form-control">
                                    @error('organizationName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Organization Code</label>
                                    <input type="text" wire:model.defer="organizationCode" placeholder="Organization Code" class="form-control">
                                    @error('organizationCode') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <label for="">Tax ID Type <span class="text-danger">*</span></label>
                                    <select wire:model.defer="taxIDType" id="" class="form-control">
                                        <option disabled selected>--Select Tax ID Type--</option>
                                        <option value="1">SSN</option>
                                        <option value="1">EIN</option>
                                    </select>
                                    @error('taxIDType') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <label for="">Organization Tax ID Number <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="organizationTaxIDNumber" placeholder="Organization Tax ID Number" class="form-control">
                                    @error('organizationTaxIDNumber') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <label for="">Organization Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="organizationPhoneNumber" placeholder="Organization Phone Number" class="form-control">
                                    @error('organizationPhoneNumber') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <label for="">Organization Email Address <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="organizationEmail" placeholder="Organization Email Address" class="form-control">
                                    @error('organizationEmail') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-8 mt-3">
                                    <label for="">Address Line  <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="addressLine" placeholder="Address Line " class="form-control">
                                    @error('addressLine') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    <label for="">City <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="city" placeholder="City" class="form-control">
                                    @error('city') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    <label for="">State/Province </label>
                                    <input type="text" wire:model.defer="state" placeholder="Address Line 1" class="form-control">
                                    @error('state') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    <label for="">Zip Code </label>
                                    <input type="text" wire:model.defer="zipCode" placeholder="Address Line 2" class="form-control">
                                    @error('zipCode') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    <label for="">Country </label>
                                    <input type="text" wire:model.defer="country" placeholder="Country" class="form-control">
                                    @error('country') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                </div>
                            </div>
                            <div class="form-group d-flex mt-3 justify-content-center">
                                <button type="submit" class="btn btn-custom">Save changes <i class="bx bx-right-arrow"></i> </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-custom text-white">Logo & Favicon</div>
                    <div class="card-body">
                        <form wire:submit.prevent="saveLogo">
                            @csrf
                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                <label for="">Logo</label> &nbsp; &nbsp;
                                <input type="file" wire:model.lazy="logo" class="form-control-file">
                                <span class="input-group-btn input-group-append">
                                    <button class="btn btn-custom bootstrap-touchspin-up" type="submit"><i class="bx bxs-cloud-upload mr-2"></i>Upload Logo</button>
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
                                    <button class="btn btn-custom bootstrap-touchspin-up" type="submit"><i class="bx bxs-cloud-upload mr-2"></i>Upload Favicon</button>
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

