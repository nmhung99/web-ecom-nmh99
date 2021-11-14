@extends('admin.admin_layouts')
@push('title')
Danh sách sản phẩm | Trang quản trị ManhF Store
@endpush
@section('admin-content')
@csrf
<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Sản Phẩm</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Sản Phẩm</a>
                        </li>
                        <li class="breadcrumb-item active">Danh Sách Sản Phẩm</li>
                    </ol>
                </div>
            </div>

            <div class="col-md-4">
                <div class="float-right d-none d-md-block app-datepicker">
                    <input type="text" class="form-control" data-date-format="MM dd, yyyy" readonly="readonly" id="datepicker">
                    <i class="mdi mdi-chevron-down mdi-drop"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- end page-title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="mt-0 clearfix header-title mb-3">
                    Danh sách sản phẩm
                    <a href="{{ route('add.product')}}" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Thêm Mới</a>
                </h4>
                                    <!-- <p class="sub-title">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                    </p> -->

                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr class="text-center">
                                                <th style="width: 60px;">Mã Sản Phẩm</th>
                                                <th>Tên Sản Phẩm</th>
                                                <th>Ảnh Sản Phẩm</th>
                                                <th>Danh Mục Cha</th>
                                                <th>Nhãn Hàng</th>
                                                <th>Số Lượng</th>
                                                <!-- <th>Màu Sắc</th> -->
                                                <th>Trạng Thái</th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">
                                            @foreach ($product as $key => $item)
                                            <tr>
                                                <td>{{$item->product_code}}</td>
                                                <td style="white-space:normal;">{{$item->product_name}}</td>
                                                <?php $image = json_decode($item->image) ?>
                                                <td>
                                                    <img src="{{asset($image[0])}}" alt="" width="100%" >
                                                    <!-- {{ !empty($item->img) && file_exists(public_path($item->img)) ? asset($item->img) : '/image/default.jpg' }} -->
                                                </td>
                                                <td>{{$item->category_name}}</td>
                                                <td>{{$item->brand_name}}</td>
                                                <td>{{$item->product_quantity}}</td>
                                                <!-- <td>{{$item->product_color}}</td> -->
                                                <td>
                                                    @if($item->status == 1)
                                                        <span class="badge badge-success">Hoạt động</span>
                                                    @else
                                                        <span class="badge badge-danger">Không Hoạt động</span>
                                                    @endif
                                                </td>
                                                <td  style="white-space:normal;">
                                                    <a href="{{ asset('/admin/product/edit/'.$item->id)}}" class="btn btn-info waves-effect waves-light mb-2" title="Chỉnh Sửa"><i class="fas fa-edit"></i></a>
                                                    <button id="{{$item->id}}" onclick="deleteProduct(this.id)" class="btn btn-danger waves-effect waves-light mb-2" title="Xóa"><i class="fas fa-trash"></i></button>
                                                    <a href="{{ asset('/admin/view/product/'.$item->id)}}" onclick="deleteBrand(this.id)" class="btn btn-primary waves-effect waves-light" title="Xem"><i class="fas fa-eye"></i></a>
                                                    @if($item->status == 1)
                                                        <button  class="btn btn-warning waves-effect waves-light" id="{{$item->id}}" onclick="inactive(this.id)" title="Hủy Hoạt Động"><i class="fas fa-thumbs-down"></i></button>
                                                    @else
                                                        <button class="btn btn-success waves-effect waves-light" id="{{$item->id}}" onclick="active(this.id)" title="Hoạt Động"><i class="fas fa-thumbs-up"></i></button>
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    <!-- /.modal -->
                    @endsection
                    @push('js')
                    <!-- Required datatable js -->
                    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
                    <!-- Buttons examples -->
                    <script src="{{ asset('plugins/datatables/dataTables.buttons.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/jszip.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/pdfmake.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/vfs_fonts.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/buttons.html5.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/buttons.print.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/buttons.colVis.min.js')}}"></script>
                    <!-- Responsive examples -->
                    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js')}}"></script>
                    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

                    <!-- Datatable init js -->
                    <script src="{{ asset('backend/assets/pages/datatables.init.js')}}"></script>
                    <!-- category js -->
                    <script src="{{ asset('/js/backend/index_product.js') }}"></script>
                    @endpush