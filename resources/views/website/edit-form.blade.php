
@extends('layouts.master-layout')
@section('current-page')
    Edit Form
@endsection
@section('extra-styles')


@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">

                    <div class="card-body">
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
                        @include('website.partials._top-navigation')

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header bg-primary text-white">Edit Form</div>
                    <div class="card-body">
                        <a href="{{route('website-forms')}}" class="btn btn-primary btn-rounded waves-effect waves-light mb-3">All Forms</a>
                        <p>Create forms for capturing Email and phone leads with specific targeting, such as kids' classes or starting a free 14 day trial.</p>

                        <form action="{{route('create-website-form')}}" method="post">
                            <div class="row">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Form Title</h5>
                                        <p>The title that appears above the form and conveys the purpose of the form. Examples: "14-day free trial", "Kids classes", and so forth</p>
                                        <input type="text" placeholder="Form Title" name="formTitle" value="{{old('formTitle', $form->title)}}" class="form-control">
                                        @error('formTitle') <i class="text-danger">{{$message}}</i> @enderror
                                        <div class="form-check form-check-primary mb-3">
                                            <input name="showTitle" class="form-check-input" type="checkbox" {{$form->show_title == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="formCheckcolor1">
                                                Show title on the website
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Form Location</h5>
                                        <p>On which page should this form be embedded?</p>
                                        <select name="formLocation" id="formLocation" class="form-control">
                                            @foreach($pages as $page)
                                                <option value="{{$page->id}}">{{$page->page_title ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('formLocation') <i class="text-danger">{{$message}}</i> @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <h5>Form description</h5>
                                        <p>You can optionally add a description that adds information about the purpose of the form. It would be shown below the title.</p>
                                        <textarea name="formDescription" style="resize: none;" placeholder="Type form description here..." class="form-control">{{old('formDescription', $form->description)}}</textarea>
                                    </div>
                                    <div class="form-group mt-4">
                                        <h5>Button Text</h5>
                                        <input type="text" name="buttonText" value="{{old('buttonText',$form->button_text)}}" placeholder="Get in Touch" class="form-control">
                                        @error('buttonText') <i class="text-danger">{{$message}}</i> @enderror
                                    </div>
                                    <div class="form-group mt-4">
                                        <h5>Thank You Message</h5>
                                        <p>Show after form is submitted.</p>
                                        <textarea name="thankYouMessage" style="resize: none;" placeholder="Type your thank you message here..." class="form-control">{{old('thankYouMessage',$form->thank_you_message)}}</textarea>
                                        @error('thankYouMessage') <i class="text-danger">{{$message}}</i> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5 class="card-header bg-primary text-white mb-3">Currently in Use</h5>
                                        <p>These fields are in use for this form title <code>{{$form->title ?? '' }}</code> </p>
                                    </div>
                                    <div class="table-responsive" style="height: 300px; overflow-y: scroll">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Enabled?</th>
                                                <th>Required?</th>
                                            </tr>
                                            </thead>
                                            @foreach($form->getFormProperties as $prop)
                                                <tr>
                                                    <td>
                                                        <strong>{{$prop->getFormField->label ?? '' }}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="enabledChoice[]"  id="switchEnabled_{{$prop->getFormField->id}}" {{$prop->form_field_enabled ? 'checked' : '' }} switch="primary" >
                                                        <label for="switchEnabled_{{$prop->getFormField->id}}" data-on-label="Yes" data-off-label="No"></label>
                                                        <input type="hidden" name="enabledFields[]" value="{{$prop->getFormField->id}}">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="requiredChoice[]"  id="switch_{{$prop->getFormField->id}}" {{$prop->form_field_required ? 'checked' : '' }} switch="primary" >
                                                        <label for="switch_{{$prop->getFormField->id}}" data-on-label="Yes" data-off-label="No"></label>
                                                        <input type="hidden" name="requiredFields[]" value="{{$prop->getFormField->id}}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="card-header bg-primary text-white mb-3">Other Form Fields</h5>
                                        <p>Choose what information to collect for this form. <i class="text-danger">Enabled</i> simply means that that form field will be available to capture data. <i class="text-danger">Required</i> on the other hand means that field is compulsory. </p>
                                    </div>
                                    <div class="table-responsive" style="height: 400px; overflow-y: scroll">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Label</th>
                                                <th>Enabled?</th>
                                                <th>Required?</th>
                                            </tr>
                                            </thead>
                                            @foreach($formFields as $field)
                                                <tr>
                                                    <td>
                                                        <strong>{{$field->label ?? '' }}</strong>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="enabledChoice[]"  id="switchEnabled_{{$field->id}}" switch="primary" {{$field->enabled == 1 ? 'checked' : ''}}>
                                                        <label for="switchEnabled_{{$field->id}}" data-on-label="Yes" data-off-label="No"></label>
                                                        <input type="hidden" name="enabledFields[]" value="{{$field->id}}">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" name="requiredChoice[]"  id="switch_{{$field->id}}" switch="primary" {{$field->required == 1 ? 'checked' : ''}}>
                                                        <label for="switch_{{$field->id}}" data-on-label="Yes" data-off-label="No"></label>
                                                        <input type="hidden" name="requiredFields[]" value="{{$field->id}}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>

                                <div class="form-group d-flex justify-content-center mt-3">
                                    <button class="btn btn-primary btn-rounded waves-effect waves-light">Save Changes</button>
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
    <script src="/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 250,
            promotion: false,
            menu: {

            },
        });
    </script>
@endsection
