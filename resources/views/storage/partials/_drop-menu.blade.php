<div class="dropdown mb-2">
    <a class="font-size-16 text-muted " role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="mdi mdi-dots-horizontal"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end" style="">
        <a class="dropdown-item" style="cursor: pointer;" href="{{route('download-attachment',['slug'=>$file->filename])}}"><i class="bx bx-cloud-download mr-2 text-success"></i> Download</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#renameModal_{{$file->id}}"><i class="bx bx-pencil mr-2 text-warning"></i> Rename</a>
        <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#moveToModal_{{$file->id}}"><i class="bx bx-transfer-alt mr-2 text-info"></i> Move to...</a>
        <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#fileModal_{{$file->id}}"><i class="bx bx-trash mr-2 text-danger"></i> Delete</a>
    </div>
</div>

<div id="moveToModal_{{$file->id}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Move File</h5>
            </div>
            <form action="{{route('move-file')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Source<sup class="text-danger">*</sup></label>
                                <select name="source" id="source" class="form-control">
                                    @foreach($folders as $source)
                                        <option value="{{$source->id}}" {{$source->id == $file->folder_id ? 'selected' : null }}>{{$source->folder ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('source') <i class="text-danger mt-3">{{$message}}</i> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Destination<sup class="text-danger">*</sup></label>
                                <select name="destination" id="destination" class="form-control">
                                    @foreach($folders as $destination)
                                        <option value="{{$destination->id}}">{{$destination->folder ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('destination') <i class="text-danger mt-3">{{$message}}</i> @enderror
                            </div>
                        </div>
                        <input type="hidden" name="directory" value="{{$file->folder_id}}">
                        <input type="hidden" name="key" value="{{$file->id}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button data-bs-dismiss="modal" type="button" class="btn btn-secondary btn-mini"><i class="bx bx-block mr-2"></i>Cancel</button>
                        <button type="submit" class="btn btn-primary btn-mini"><i class="bx bx-check mr-2"></i>Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="renameModal_{{$file->id}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Rename File</h5>
            </div>
            <form action="{{route('rename-file')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">File Name<sup class="text-danger">*</sup></label>
                                <input type="text" value="{{$file->name ?? '' }}" name="newName" placeholder="Rename File" class="form-control">
                                @error('newName') <i class="text-danger mt-3">{{$message}}</i> @enderror
                            </div>
                        </div>
                        <input type="hidden" name="directory" value="{{$file->folder_id}}">
                        <input type="hidden" name="key" value="{{$file->id}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button data-bs-dismiss="modal" type="button" class="btn btn-secondary btn-mini"><i class="bx bx-block mr-2"></i>Cancel</button>
                        <button type="submit" class="btn btn-primary btn-mini"><i class="bx bx-check mr-2"></i>Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="fileModal_{{$file->id}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card-header bg-warning">
                <h5 class="modal-title text-white" id="exampleModalLabel">Warning</h5>
            </div>
            <form action="{{route('delete-file')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">This action cannot be undone. Are you sure you want to delete <strong>{{$file->name ?? '' }}</strong>?</label>
                            </div>
                        </div>
                        <input type="hidden" name="directory" value="{{$file->folder_id}}">
                        <input type="hidden" name="key" value="{{$file->id}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button data-bs-dismiss="modal" type="button" class="btn btn-secondary btn-mini"><i class="bx bx-block mr-2"></i>No, cancel</button>
                        <button type="submit" class="btn btn-danger btn-mini"><i class="bx bx-check mr-2"></i>Yes, delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
