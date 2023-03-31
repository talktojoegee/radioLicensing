<div class="btn-group">
    <i class="bx bx-dots-vertical dropdown-toggle text-warning" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{route('download-attachment',['slug'=>$file->filename])}}"><i class="bx bxs-download text-success mr-2"></i> Download</a>
        <a class="dropdown-item deleteFile"  data-bs-toggle="modal"  data-bs-target="#deleteModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="bx bxs-trash mr-2 text-danger"></i> Delete</a>
    </div>
</div>
