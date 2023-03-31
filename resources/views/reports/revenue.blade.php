@extends('layouts.master-layout')
@section('current-page')
    Revenue Report
@endsection
@section('extra-styles')
    <link rel="stylesheet" href="/css/nprogress.css">
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/parsley.css" rel="stylesheet" type="text/css" />
    <style>
        .fs-22{
            font-size: 22px;
        }
    </style>
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-xxl-12 col-sm-12">
                <p>Currently showing revenue report for @if($search == 0)<code>{{date('Y')}}</code> @else
                    <span><strong class="text-success">From:</strong> {{date('d M, Y', strtotime($from))}}</span>
                    <span><strong class="text-danger">To:</strong> {{date('d M, Y', strtotime($to))}}</span>
                    @endif</p>
            </div>
            <div class="col-xxl-4 col-md-4 col-sm-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">Select</div>
                    <div class="card-header m-4">
                        <form action="{{route('filter-sales-report')}}" class="" method="get">
                            @csrf
                            <div class="form-group">
                                <label for="" class="text-muted">Filter</label>
                                <select name="filterType" id="filterType" class="form-control">
                                    <option value="1">All</option>
                                    <option value="2">Date Range</option>
                                </select>
                                @error('filterType') <i class="text-danger">{{$message}}</i> @enderror
                            </div>
                            <div class="form-group mt-3 dateInputs">
                                <label for="" class="text-success">From</label>
                                <input type="date" class="form-control" name="from">
                                @error('from') <i class="text-danger">{{$message}}</i> @enderror
                            </div>
                            <div class="form-group mt-3 dateInputs">
                                <label for="" class="text-danger">To</label>
                                <input type="date" class="form-control" name="to">
                                @error('to') <i class="text-danger">{{$message}}</i> @enderror
                            </div>
                            <div class="mt-3 form-group d-flex justify-content-center">
                                <button class="btn btn-primary btn-sm">Submit <i class="bx bx-filter"></i> </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8 col-md-8 col-sm-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Revenue Chart</div>
                    <div class="card-body">
                        <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>

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
                        <div class="row">
                            <div class="col-md-12 col-lx-12">
                                <h4 class="card-title">Revenue Table</h4>
                                <div class="table-responsive mt-3">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th class="">#</th>
                                            <th class="wd-15p">Date</th>
                                            <th class="wd-15p">Client</th>
                                            <th class="wd-15p">Total</th>
                                            <th class="wd-15p">Payment Method</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $index = 1; @endphp
                                        @foreach($sales as $sale)
                                            <tr>
                                                <td>{{$index++}}</td>
                                                <td>{{date('d M, Y', strtotime($sale->transaction_date))}}</td>
                                                <td>{{$sale->getClient->first_name ?? '' }} {{$sale->getClient->last_name ?? '' }}</td>
                                                <td style="text-align: right;">{{env('APP_CURRENCY')}}{{number_format($sale->sub_total ?? 0,2)}}</td>
                                                <td>
                                                    @switch($sale->payment_method)
                                                        @case(1)
                                                        Payment Card
                                                        @break
                                                        @case(2)
                                                        Bank Account
                                                        @break
                                                        @case(3)
                                                        Manual Payment
                                                        @break
                                                        @case(4)
                                                        Cash
                                                        @break
                                                        @case(5)
                                                        Cheque
                                                        @break
                                                        @case(6)
                                                        Referral Credit
                                                        @break
                                                        @case(6)
                                                        Internet
                                                        @break
                                                    @endswitch
                                                </td>
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
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/js/pages/datatables.init.js"></script>


    <script src="/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/libs/jszip/jszip.min.js"></script>
    <script src="/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>


    <script src="/js/parsley.js"></script>
    <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <script>
        const incomeData = [0,0,0,0,0,0,0,0,0,0,0,0];
        const expenseData = [0,0,0,0,0,0,0,0,0,0,0,0];
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const search = "{{$search}}";
        const url = parseInt(search) === 0 ? "{{route('revenue-statistics') }}" : "{{route('revenue-statistics-range')}}";
        $(document).ready(function(){
            $('.dateInputs').hide();
            $('#filterType').on('change', function(e){
                e.preventDefault();
                if($(this).val() == 1){
                    $('.dateInputs').hide();
                }else{
                    $('.dateInputs').show();
                }
            });

            /*Bar chart*/
            axios.get(url)
                .then(res=> {
                    const income = res.data.income;
                    income.map((inc) => {
                        switch (inc.month) {
                            case 1:
                                plotGraph(1, 1, inc.amount);
                                break;
                            case 2:
                                plotGraph(2, 1, inc.amount);
                                break;
                            case 3:
                                plotGraph(3, 1, inc.amount);
                                break;
                            case 4:
                                plotGraph(4, 1, inc.amount);
                                break;
                            case 5:
                                plotGraph(5, 1, inc.amount);
                                break;
                            case 6:
                                plotGraph(6, 1, inc.amount);
                                break;
                            case 7:
                                plotGraph(7, 1, inc.amount);
                                break;
                            case 8:
                                plotGraph(8, 1, inc.amount);
                                break;
                            case 9:
                                plotGraph(9, 1, inc.amount);
                                break;
                            case 10:
                                plotGraph(10, 1, inc.amount);
                                break;
                            case 11:
                                plotGraph(11, 1, inc.amount);
                                break;
                            case 12:
                                plotGraph(12, 1, inc.amount);
                                break;
                        }

                    });
                    //then
                    var options = {
                            chart: { height: 360, type: "bar", stacked: !0, toolbar: { show: !1 }, zoom: { enabled: !0 } },
                            plotOptions: { bar: { horizontal: !1, columnWidth: "15%", endingShape: "rounded" } },
                            dataLabels: { enabled: !1 },
                            series: [
                                { name: "Revenue", data: incomeData },
                            ],
                            xaxis: { categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"] },
                            colors: ["#34c38f", "#f1b44c"],
                            legend: { position: "bottom" },
                            fill: { opacity: 1 },
                        },
                        chart = new ApexCharts(document.querySelector("#stacked-column-chart"), options);
                    chart.render();

                });
        });

        function plotGraph(index,type, value){
            if(parseInt(type) === 1){
                incomeData[index-1] = value;
            }
        }
    </script>
@endsection
