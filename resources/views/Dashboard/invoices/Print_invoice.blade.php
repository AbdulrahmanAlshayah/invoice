@extends('Dashboard.layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }

    </style>
@endsection
@section('title')
    معاينه طباعة الفاتورة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    معاينة طباعة الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
                            {{-- 1 --}}
        <div class="row row-sm">
            <div class="col-md-12 col-xl-12">
                <div class=" main-content-body-invoice" id="print">
                    <div class="card card-invoice">
                        <div class="card-body">

                                <div class="row mg-t-20">
                                    <div class="col-md">

                                    </div>
                                    <div class="col-md">
                                        <label class="tx-gray-600">معلومات الفاتورة</label>
                                        <p class="invoice-info-row"><span>أسم الزبون</span>
                                            <span>{{$invoice->customer_name}} </span></p>
                                        <p class="invoice-info-row"><span>تاريخ الفاتورة</span>
                                            <span>{{$invoice->invoice_Date}} </span></p>
                                        <p class="invoice-info-row"><span>العنوان</span>
                                            <span>{{$invoice->place}} </span></p>
                                    </div>
                                </div>

                            <br>
                            {{-- 3 --}}
                            <div class="row">
                                <div class="col">
                                    #
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">الإجمالي</label>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">المنتج</label>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">الكمية</label>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">السعر</label>
                                </div>

                                <div class="col">
                                    <label for="exampleTextarea">ملاحظات</label>
                                </div>
                            </div>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($invoice->details as $detail)

                                <div class="row">
                                    <span style="display:none">{{$total += $detail->count * $detail->price;}}</span>
                                    <div class="col">
                                        {{$loop->iteration}}
                                    </div>

                                    <div class="col">
                                        <p id="{{$loop->iteration}}">{{$detail->count * $detail->price}}</p>
                                    </div>
                                    <div class="col">
                                        <p >{{$detail->product}}</p>
                                    </div>

                                    <div class="col">
                                    <p >{{$detail->count}}</p>
                                </div>

                                <div class="col">
                                        <p >{{$detail->price}}</p>
                                    </div>

                                    <div class="col">
                                        <p >{{$detail->note}}</p>
                                    </div>
                                </div>
                                <br>

                                @endforeach

                            {{-- 13 --}}
                            <br>
                            <div class="row">

                                <div class="col">
                                    <label>المجموع</label>
                                    <div class="col">
                                        <h4 class="tx-primary tx-bold">sp {{$total}}</h4>
                                    </div>
                                </div>

                            </div>

                            <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>

@endsection
