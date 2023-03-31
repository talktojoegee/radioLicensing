
@extends('layouts.master-layout')
@section('current-page')
    <small>Create Task</small>
@endsection
@section('extra-styles')
    <link href="/css/parsley.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12">
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
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('manage-tasks')}}"  class="btn btn-primary"> Tasks <i class="bx bx-task"></i> </a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Add Task
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <form autocomplete="off" class="mt-3" action="{{route('create-task')}}" enctype="multipart/form-data" method="post" id="leadForm">
                                        @csrf
                                        <div class="form-group mt-1">
                                            <label for="">Title <span class="text-danger">*</span></label>
                                            <input type="text" data-parsley-required-message="What's the title of this task?" required name="title" value="{{old('title')}}" placeholder="Title" class="form-control">
                                            @error('title') <i class="text-danger">{{$message}}</i>@enderror
                                        </div>
                                        <div class="form-group mt-1">
                                            <label for="">Client(s): </label>
                                            <select name="clients[]" data-parsley-required-message="Which client identifies with this task?" multiple   class="form-control select2">
                                                @foreach($clients as $client)
                                                    <option value="{{$client->id}}">{{$client->first_name ?? '' }} {{$client->last_name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            @error('clients') <i class="text-danger">{{$message}}</i>@enderror
                                        </div>
                                        <div class="form-group mt-1">
                                            <label for="">Practitioner(s): <span class="text-danger">*</span></label>
                                            <select name="assigned_to[]" data-parsley-required-message="Who is responsible for this task? You can choose more than one person." multiple required  class="form-control select2">
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->first_name ?? '' }} {{$user->last_name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            @error('assigned_to') <i class="text-danger">{{$message}}</i>@enderror
                                        </div>
                                        <div class="form-group mt-1">
                                            <label for="">Due Date </label> <br>
                                            <input type="datetime-local" name="due_date" value="{{date('Y-m-d')}}" class="form-control">
                                            @error('due_date') <i class="text-danger">{{$message}}</i>@enderror
                                        </div>
                                        <div class="form-group mt-1">
                                            <label for="">Description <span class="text-danger">*</span></label>
                                            <textarea name="description"  id="description" style="resize: none;" placeholder="Type description here..." class="form-control">{{old('description')}}</textarea>
                                            @error('description') <i class="text-danger">{{$message}}</i>@enderror
                                        </div>
                                        <div class="form-group d-flex justify-content-center mt-3">
                                            <div class="btn-group">
                                                <button type="submit"  class="btn btn-primary  waves-effect waves-light">Add Task <i class="bx bx-task"></i> </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <div class="card-header">
                                        How to it works
                                    </div>
                                    <p class="mt-3">
                                        Use the various fields to create a new task.
                                    </p>
                                    <ul>
                                        <li>Enter a title for your task</li>
                                        <li>Select client or clients that pertains to this task</li>
                                        <li>You can equally assign the task to more than one persons.</li>
                                        <li>Enter when the task is due for completion or submission</li>
                                        <li>Lastly, enter a brief description of the task.</li>
                                    </ul>
                                    <p>How simple is that? Very... right?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')
    <script src="/js/parsley.js"></script>
    <script src="/js/tinymce/tinymce.min.js"></script>
    <script src="/assets/libs/select2/js/select2.min.js"></script>
    <script src="/assets/js/pages/form-advanced.init.js"></script>
    <script>
        $(document).ready(function(){
            $('#leadForm').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
                .on('form:submit', function() {
                    return true;
                });
            tinymce.init({
                selector: 'textarea',
                height: 350,
                promotion: false,
                menu: {

                },
            });
        })


    </script>
@endsection
