@extends('Dashboard.layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    تعديل فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoices.update') }}" method="post"
                        autocomplete="off">
                        @csrf
                        @method('post')
                        {{-- 1 --}}

                        <div class="row">

                            <div class="col">
                                <label>أسم الزبون</label>
                                <input type="hidden" class="form-control fc-datepicker" value="{{$invoice->id}}" name="id">
                                <input class="form-control fc-datepicker" name="customer_name"
                                    type="text" value="{{$invoice->customer_name}}" required>
                            </div>

                        </div>

                        {{-- 2 --}}

                        <div class="row">

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="date" value="{{$invoice->invoice_Date}}" required>
                            </div>

                            <div class="col">
                                <label>العنوان</label>
                                <input class="form-control fc-datepicker" name="place"
                                    type="text" value="{{$invoice->place}}" required>
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
                        <input type="hidden" class="form-control"  name="index" value="{{$invoice->details->count()}}" readonly>
                        @foreach ($invoice->details as $detail)

                            <div class="row">
                                <span style="display:none">{{$total += $detail->count * $detail->price;}}</span>
                                <div class="col">
                                    {{$loop->iteration}}
                                </div>

                                <div class="col">
                                    <input type="hidden" class="form-control" name="detail_{{$loop->iteration}}" value="{{$detail->id}}" readonly>
                                    <input type="text" class="form-control" id="{{$loop->iteration}}" name="Totla_Val_{{$loop->iteration}}" value="{{$detail->count * $detail->price}}" readonly>
                                </div>
                                <div class="col">
                                    <input type="text"class="form-control" value="{{$detail->product}}" name="product_{{$loop->iteration}}">
                                </div>

                                <div class="col">
                                    <input type="number" class="form-control" id="count_{{$loop->iteration}}" value="{{$detail->count}}" name="count_{{$loop->iteration}}" onchange="myFun({{$loop->iteration}},{{$invoice->details->count()}})">
                                </div>

                                <div class="col">
                                    <input type="number" class="form-control" id="price_{{$loop->iteration}}" value="{{$detail->price}}" name="price_{{$loop->iteration}}" onchange="myFun({{$loop->iteration}},{{$invoice->details->count()}})">
                                </div>

                                <div class="col">
                                    <textarea class="form-control" id="exampleTextarea" name="note_{{$loop->iteration}}" rows="1">{{$detail->note}}</textarea>
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
                                    <input type="text" class="form-control" id="total" value="{{$total}}" name="total" readonly>
                                </div>
                            </div>

                        </div>


                        <br>



                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>


                    </form>
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
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>

    <script>
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>


    <script>

        function myFun($index, $i) {
            var count = parseFloat(document.getElementById('count_' + $index).value);
            var price = parseFloat(document.getElementById('price_' + $index).value);
            var Value_VAT = parseFloat(document.getElementById($index).value);

            sum = parseFloat(count * price).toFixed(2);
            document.getElementById('' + $index).value = sum;

            var total = 0;
            for (; $i > 0; $i--) {
                total += parseFloat(document.getElementById($i).value);
            }
            document.getElementById('total').value = total;
        }



    </script>


@endsection
