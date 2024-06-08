@extends('dashboard.layouts.master')
@section('title')
    المستخدمين
@stop
@section('css')
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

    <!-- Internal Data table css -->
<link href="{{URL::asset('dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    عرض الكل</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('dashboard.messages_alert')
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><input name="select_all"  id="example-select-all"  type="checkbox"/></th>
                                <th>اسم المنتج</th>
                                <th>الصورة</th>
                                <th>السعر</th>
                                <th>حالة النتج</th>
                                <th>أنشأ في</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach(Auth::user()->products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input type="checkbox" name="delete_select" value="{{$product->id}}" class="delete_select">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        @if($product->image)
                                            <img src="{{Url::asset('dashboard/img/product/'.$product->image->filename)}}"
                                                 height="50px" width="50px" alt="">

                                        @else
                                            <img src="{{Url::asset('dashboard/img/product_default.jpg')}}" height="50px"
                                                 width="50px" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $product->price }}</td>

                                    <td>
                                        <div
                                            class="dot-label bg-{{$product->status == 1 ? 'success':'danger'}} ml-1"></div>
                                        {{$product->status == 1 ? "مفعل":"غير مفعل"}}
                                    </td>
                                    @if($product->created_at)
                                    <td>{{ $product->created_at->diffForHumans() }}</td>
                                    @else
                                    <td>---</td>
                                    @endif
                                    <td>

                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">العمليات<i class="fas fa-caret-down mr-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_Products{{$product->id}}"><i   class="text-warning ti-back-right"></i>&nbsp;&nbsp;حذف</a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                {{-- @include('dashboard.User.delete') --}}
                                {{-- @include('dashboard.User.delete_select') --}}
                                {{-- @include('dashboard.User.update_password') --}}
                                @include('dashboard.User.delete_product')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>

    <!-- Internal Data tables -->
<script src="{{URL::asset('dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('dashboard/js/table-data.js')}}"></script>


    <script>
        $(function() {
            jQuery("[name=select_all]").click(function(source) {
                checkboxes = jQuery("[name=delete_select]");
                for(var i in checkboxes){
                    checkboxes[i].checked = source.target.checked;
                }
            });
        })
    </script>


    <script type="text/javascript">
        $(function () {
            $("#btn_delete_all").click(function () {
                var selected = [];
                $("#example input[name=delete_select]:checked").each(function () {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_select').modal('show')
                    $('input[id="delete_select_id"]').val(selected);
                }
            });
        });
    </script>



@endsection
