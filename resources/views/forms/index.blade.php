@extends('layouts.master-layout')
@section('current-page')
    Forms
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
        <div class="card-header">
            <a href="{{route('add-new-form')}}" class="btn btn-primary float-end mb-3">Add New Form <i class="bx bx-plus"></i> </a>
        </div>
        <div class="card-body" style="padding: 2px;">
            <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Last Updated</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $serial = 1; @endphp
                        @foreach($forms as $form)
                            <tr>
                                <th scope="row">{{$serial++}}</th>
                                <td><a href="{{route('form-details', $form->slug)}}">{{$form->form_name}}</a> </td>
                                <td>{{date('d M, Y', strtotime($form->created_at))}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>


@endsection

@section('extra-scripts')

@endsection
