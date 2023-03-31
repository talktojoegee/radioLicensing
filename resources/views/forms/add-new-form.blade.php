@extends('layouts.master-layout')
@section('current-page')
    Add New Form
@endsection
@section('extra-styles')
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
                <div class="col-md-12 mt-4">
                    <div class="h4 text-center">Add New Form</div>
                    <div class="container">
                        <form action="">
                            @csrf
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <div class="form-group">
                                        <label for="">Form Name <span class="text-danger">*</span></label>
                                        <input type="text" name="formName" id="formName" placeholder="Form Name"  class="form-control">
                                        @error('formName') <i class="text-danger mt-2">{{$message}}</i> @enderror
                                    </div>
                                </div>
                                <div class="col-md-12" id="formBuilder">
                                </div>
                                <div class="form-group mb-3 d-flex justify-content-center">
                                    <button type="submit" id="saveForm" class="btn btn-primary">Submit <i class="bx bx-right-arrow"></i> </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')
    <script src="/js/axios.min.js"></script>
    <script src="/js/nprogress.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="/assets/js/form-builder.min.js"></script>
    <script>
        $(document).ready(function(){

            const options = {
                disableFields:['file', 'hidden', 'autocomplete'],
                disabledActionButtons: ['data'],
            };
            const formBuilder = $('#formBuilder').formBuilder(options);
            document.getElementById("saveForm").addEventListener("click", (e) => {
                e.preventDefault();
                const result = formBuilder.actions.save();
                NProgress.start();
                axios.post("{{route('process-form')}}", {
                    structure:result,
                    formName:$('#formName').val(),
                    type:"create",
                })
                .then(res=>{
                    NProgress.done();
                })
                .catch(err=>{
                    NProgress.done();
                });
            });
        });
    </script>
@endsection
