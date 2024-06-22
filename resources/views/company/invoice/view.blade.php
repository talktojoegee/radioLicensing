@extends('layouts.master-layout')
@section('title')
    Invoice Detail
@endsection
@section('current-page')
    Invoice Detail
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
                    <div class="card-header">
                        <a href="{{ route('manage-applications') }}" class="btn btn-secondary "> <i
                                class="bx bx bxs-left-arrow"></i> Go back</a>

                        @if(($invoice->status == 1) && \Illuminate\Support\Facades\Auth::user()->type == 1)
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#declinePayment" class="btn btn-danger ">  Decline <i
                                    class="bx bx-x"></i>
                            </a>
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#verifyPayment" class="btn btn-success ">  Verify <i
                                    class="bx bx-check"></i>
                            </a>
                        @endif
                        @if(\Illuminate\Support\Facades\Auth::user()->type != 1)
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#submitPayment" class="btn btn-warning ">  Submit Payment <i
                                    class="bx bx-wallet"></i>
                            </a>
                        @endif
                    </div>

                    @if(session()->has('success'))
                        <div class="card-body">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-check-all me-2"></i>
                                {!! session()->get('success') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-close me-2"></i>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <div class="row"   >
                <div class="col-lg-12"   >
                    <div class="card"   >
                        <div class="card-body"   >
                            <div class="invoice-title"   >
                                <h5 class="float-end font-size-16">Application Ref.: {{ strtoupper($workflow->p_title ?? '') }}
                                    <p class="mt-2"><strong>Status:</strong>
                                        @switch($invoice->status)
                                            @case(0)
                                            <span class="text-info">Pending</span>
                                            @break
                                            @case(1)
                                            <span class="text-info">Paid</span>
                                            @break
                                            @case(2)
                                            <span class="text-success">Verified</span>
                                            @break
                                            @case(3)
                                            <span class="text-danger" style="color: #ff0000 !important;">Declined</span>
                                            @break
                                        @endswitch
                                    </p>
                                </h5>
                                <div class="mb-4"   >
                                    <img src="/assets/drive/logo/logo-dark.png" alt="logo" height="60">
                                </div>
                            </div>
                            <hr>
                            <div class="row"   >
                                <div class="col-sm-6"   >
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        {{$workflow->getCompany->organization_name ?? ''  }}<br>
                                        {{$workflow->getCompany->phone_no ?? ''  }}<br>
                                        {{$workflow->getCompany->email ?? ''  }}<br>
                                        {{$workflow->getCompany->address ?? ''  }}
                                    </address>
                                </div>
                                <div class="col-sm-6 text-sm-end"   >
                                    <address class="mt-2 mt-sm-0">
                                        <strong>From:</strong><br>
                                        {{env('ORG_NAME')}}<br>
                                        {{env('ORG_PHONE')}}<br>
                                        {{env('ORG_EMAIL')}}<br>
                                        {{env('ORG_ADDRESS')}}
                                    </address>
                                </div>
                            </div>
                            <div class="row"   >
                                <div class="col-sm-6 mt-3"   >
                                    <address>
                                        <strong>RC No.:</strong><br>
                                        {{$workflow->getCompany->organization_code ?? '' }}<br>
                                        <strong>Year of Incorporation:</strong><br>
                                        {{ date('d M, Y', strtotime($workflow->getCompany->start_date)) ?? '' }}<br>
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-end"   >
                                    <address>
                                        <strong>Date Issued:</strong><br>
                                        {{date('d M, Y', strtotime($invoice->created_at))}}<br><br>
                                    </address>
                                </div>
                            </div>
                            <div class="py-2 mt-3"   >
                                <h3 class="font-size-15 fw-bold">Order summary</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">

                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Station</th>
                                        <th>Mode</th>
                                        <th>Category</th>
                                        <th>Frequency</th>
                                        <th>Type</th>
                                        <th>Quantity</th>
                                        <th style="text-align: right;">Rate({{env('APP_CURRENCY')}})</th>
                                        <th style="text-align: right;">Amount({{env('APP_CURRENCY')}})</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($workflow->getRadioLicenseDetails as $key => $detail)
                                        <tr>
                                            <th>{{ $key +1  }}</th>
                                            <td>{{$detail->getWorkstation->name ?? '' }}</td>
                                            <td>{{$detail->operation_mode == 1 ? 'Simplex' : 'Duplex' }}</td>
                                            <td>{{ $detail->getLicenseCategory->category_name ?? '' }}</td>
                                            <td>
                                                @switch($detail->frequency_band)
                                                    @case(1)
                                                    MF/HF
                                                    @break
                                                    @case(2)
                                                    VHF
                                                    @break
                                                    @case(3)
                                                    UHF
                                                    @break
                                                    @case(4)
                                                    SHF
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                @switch($detail->type_of_device)
                                                    @case(1)
                                                    Handheld
                                                    @break
                                                    @case(2)
                                                    Base Station
                                                    @break
                                                    @case(3)
                                                    Repeaters Station
                                                    @break
                                                    @case(4)
                                                    Vehicular Station
                                                    @break
                                                @endswitch
                                            </td>
                                            <td style="text-align: center;">
                                                <input type="hidden" value="{{$detail->id}}" name="itemId[]">
                                                {{ number_format($detail->no_of_device ?? 0)  }}
                                            </td>
                                            <td style="text-align: right;">
                                                 {{ number_format($detail->getInvoiceDetail->amount ?? 0) }}
                                            </td>
                                            <td style="text-align: right;">
                                                 {{ number_format( ($detail->getInvoiceDetail->amount * $detail->no_of_device),2 ) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="8" class="border-0 text-end">
                                            <strong>Amount Paid</strong></td>
                                        <td class="border-0 text-end"><span>{{env('APP_CURRENCY')}}</span><span>{{number_format($invoice->amount_paid ?? 0 ,2)}}</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" class="border-0 text-end">
                                            <strong>Total</strong></td>
                                        <td class="border-0 text-end"><h4 class="m-0"> <span>{{env('APP_CURRENCY')}}</span><span id="totalAmount">{{number_format($invoice->total ?? 0 ,2)}}</span></h4></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-print-none mt-3"   >
                                <div class="float-end"   >
                                    <button type="submit" class="btn btn-warning w-md waves-effect waves-light">Print <i class="bx bx-printer"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="postId" value="{{$workflow->p_id}}" class="form-control">
        </div>
        @if($invoice->status >= 1) <!-- Paid,Verified,Declined -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">

                                <thead>
                                <tr>
                                    <th>Remita Retrieval Reference(RRR)</th>
                                    <th>Proof</th>
                                    <th>Actioned By</th>
                                    <th>Date Actioned</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$invoice->rrr ?? '' }}</td>
                                    <td><a href="{{ route('download-attachment',$invoice->attachment ?? '') }}">{{$invoice->attachment ?? '' }}</a></td>
                                    <td>{{$invoice->getActionedBy->title ?? '' }} {{ $invoice->getActionedBy->first_name ?? '' }} {{$invoice->getActionedBy->last_name ?? '' }} {{ $invoice->getActionedBy->other_names ?? '' }}</td>
                                    <td>{{ date('d M, Y', strtotime($invoice->date_actioned)) }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="modal right fade" id="submitPayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" style="width: 900px;">
        <div class="modal-dialog w-100" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <h6 class="modal-title text-uppercase" style="text-align: center;" id="myModalLabel2">Submit Proof of Payment</h6>
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p><strong class="text-danger">Note:</strong> Ensure you upload the right proof of payment for this invoice.</p>
                    <form autocomplete="off" action="{{route('submit-proof-of-payment')}}" id="createIncomeForm" data-parsley-validate="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">RRR <sup style="color: #ff0000;">*</sup></label>
                            <input type="text" name="rrr" value="{{ old('rrr') }}" placeholder="RRR" class="form-control">
                            @error('rrr') <i class="text-danger" style="color: #ff0000;">{{ $message }}</i> @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="form-group mt-1 col-md-12 mt-3 " id="nextAuthWrapper">
                                <label for="">Upload Proof of Payment <sup style="color: #ff0000;">*</sup></label> <br>
                                <input type="file" name="attachment" accept="application/pdf,image/*" class="form-control-file">
                                @error('attachment') <i class="text-danger" style="color: #ff0000;">{{$message}}</i>@enderror
                            </div>
                        </div>
                        <input type="hidden" name="invoiceId" value="{{$invoice->id}}">
                        <div class="form-group d-flex justify-content-center mt-3">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary  waves-effect waves-light">Submit  <i class="bx bxs-right-arrow"></i> </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal  fade" id="verifyPayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog w-100" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <h6 class="modal-title text-uppercase" style="text-align: center;" id="myModalLabel2">Verify Payment</h6>
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form autocomplete="off" action="{{route('action-payment')}}" id="createIncomeForm" data-parsley-validate="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="form-group mt-1 col-md-12 mt-3 ">
                                <p>This action cannot be undone. Are you sure you want to verify this payment?</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group mt-1 col-md-12">
                                <label for="">Comment<sup style="color: #ff0000;">*</sup></label> <br>
                                <input type="hidden" name="invoiceId" value="{{$invoice->id}}">
                                <input type="hidden" name="status" value="2">
                                <textarea name="comment" style="resize: none;" placeholder="Leave your comment here..." class="form-control">{{old('comment')}}</textarea>
                                @error('comment') <i class="text-danger" style="color: #ff0000;">{{$message}}</i>@enderror

                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center mt-3">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary  waves-effect waves-light">Yes, proceed  <i class="bx bxs-right-arrow"></i> </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal  fade" id="declinePayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog w-100" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <h6 class="modal-title text-uppercase" style="text-align: center;" id="myModalLabel2">Decline Payment</h6>
                    <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form autocomplete="off" action="{{route('action-payment')}}" id="createIncomeForm" data-parsley-validate="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="form-group mt-1 col-md-12 mt-3 ">
                                <p>This action cannot be undone. Are you sure you want to <code>decline</code> this payment?</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group mt-1 col-md-12">
                                <label for="">Comment<sup style="color: #ff0000;">*</sup></label> <br>
                                <input type="hidden" name="invoiceId" value="{{$invoice->id}}">
                                <input type="hidden" name="status" value="3">
                                <textarea name="comment" style="resize: none;" placeholder="Leave your comment here..." class="form-control">{{old('comment')}}</textarea>
                                @error('comment') <i class="text-danger" style="color: #ff0000;">{{$message}}</i>@enderror

                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center mt-3">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary  waves-effect waves-light">Yes, proceed  <i class="bx bxs-right-arrow"></i> </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')


@endsection



