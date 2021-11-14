@extends('admin.admin_layouts')
@push('title')
Chỉnh sửa mã giảm giá | Trang quản trị ManhF Store
@endpush
@section('admin-content')

<div class="container-fluid">
    <div class="page-title-box">

        <div class="row align-items-center ">
            <div class="col-md-8">
                <div class="page-title-box">
                    <h4 class="page-title">Mã Giảm Giá</h4>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">ManhZ Store</a>
                        </li> -->
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Mã Giảm Giá</a>
                        </li> 
                        <!-- <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Danh Mục Con</a>
                        </li> -->
                        <li class="breadcrumb-item active">Chỉnh Sửa</li>
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
                    Chỉnh Sửa Mã Giảm Giá
                    <!-- <a href="#" data-toggle="modal" data-target=".bs-example-modal-center" class="btn btn-primary waves-effect waves-light mr-3" style="float: right;">Thêm Mới</a> -->
                </h4>
                                    <!-- <p class="sub-title">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                                    </p> -->

                                    <!--  -->
                                    <form class="" method="POST" id="form_coupon">
                                        @csrf
                                        <div class="form-group">
                                            <label>Mã Giảm Giá</label>
                                            <input type="text" onkeypress="removeMessage($(this))" name="coupon" class="form-control" value="{{$info->coupon}}" style="text-transform:uppercase"  required placeholder="Mã Giảm Giá" />
                                            <span class="text-danger" id="coupon_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Phần Trăm Giảm</label>
                                            <input  type="number" min="1" max="100"  onkeypress="removeMessage($(this))" name="discount" class="form-control" value="{{$info->discount}}" required placeholder="Phần Trăm Giảm" />
                                            <span class="text-danger" id="discount_error"></span>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="{{$info->id}}" onclick="updateCoupon(this.id)" class="btn btn-primary">Cập Nhật</button>
                                        <a href="{{ asset('/admin/sup/coupon')}}" class="btn btn-secondary">Trở Về</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                    <!-- end row -->

                    @endsection
                    @push('js')
                    <!-- category js -->
                    <script src="{{ asset('/js/backend/coupon.js') }}"></script>

                    @endpush