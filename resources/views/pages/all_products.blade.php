@extends('layouts.main')
@section('slider')
@include('layouts.slider')
@endsection
@push('title')
ManhF Store - Chuyên điện thoại, phụ kiện, đồng hồ thông minh
@endpush
@push('css')
<link rel="stylesheet" href="{{ asset('css/frontend/shoppage.css')}}">
<style type="text/css">
    .shorting-style a:hover{
        color: red;
    }
</style>
@endpush
@section('content')
<div class="shop-area pt-50 pb-120">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
                        <div class="shop-topbar-wrapper">
                            <div class="shop-topbar-left">
                                <div class="view-mode nav">
                                    <a class="active" href="#shop-1" data-toggle="tab"><i class="icon-grid"></i></a>
                                    <!-- <a href="#shop-2" data-toggle="tab"><i class="icon-menu"></i></a> -->
                                </div>
                                <p>Danh sách các sản phẩm</p>
                            </div>
                            <div class="product-sorting-wrapper">
                                <form action="#" id="sortProduct">
                                    @if(Session::has('brandsubcat'))
                                    <input type="hidden" name="valuesort" class="input1" id="subcat" value="{{$cat->subcategory_name}}">
                                    <input type="hidden" class="input2" value="{{$cat->id}}">
                                    @elseif(Session::has('brandcat'))
                                    <input type="hidden" name="valuesort" class="input1" id="cat" value="{{$cat->category_name}}">
                                    <input type="hidden" class="input2" value="{{$cat->id}}">
                                    @else
                                    <input type="hidden" name="valuesort" class="input1" id="brand" value="{{$cat->brand_name}}">
                                    <input type="hidden" class="input2" value="{{$cat->id}}">
                                    @endif
                                    <div class="product-sorting-wrapper">
                                        <div class="product-show shorting-style">
                                            <label>Lọc Theo :</label>
                                            <a class="pr-2 sortproduct" id="name_asc" name="name_asc">Tên A-Z</a>
                                            <a class="pr-2 sortproduct" id="name_desc" name="name_desc">Tên Z-A</a>
                                            <a class="pr-2 sortproduct" id="price_asc" name="price_asc">Giá Thấp - Cao</a>
                                            <a class="sortproduct" id="price_desc" name="price_desc">Giá Cao - Thấp</a>
                                        </div>
                                    </div>  
                                </form>
                            </div>
                        </div>
                        <div class="shop-bottom-area">
                            <div class="tab-content jump">
                                <div id="shop-1" class="tab-pane active">
                                    <div class="row">
                                        @foreach($products as $item)
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                            <div class="single-product-wrap mb-35">
                                                <div class="product-img product-img-zoom mb-15">
                                                    <?php 
                                                        $image = json_decode($item->image)
                                                     ?>
                                                    <a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">
                                                        <img width="100%" height="100%" src="{{asset($image[0])}}" alt="">
                                                    </a>
                                                    @if($item->discount_price !== NULL)
                                                    @php
                                                    $amount = $item->selling_price - $item->discount_price;
                                                    $discount = $amount/$item->selling_price*100;
                                                    @endphp
                                                    <span class="pro-badge left bg-red">{{number_format($discount)}}%</span>
                                                    <!-- <span class="pro-badge right1" style="color: orange; font-size: 18px;"><i class="fas fa-bolt"></i></span> -->
                                                    @endif
                                                    <div class="product-action-2 tooltip-style-2">
                                                        <button  class="addWishlist" data-id="{{$item->id}}"><i class="icon-heart"></i></button>
                                                        <button title="Xem Nhanh" data-toggle="modal" data-target="#exampleModal" onclick="productview(this.id)" class="preview" id="{{($item->id)}}"><i class="icon-eye"></i></button>
                                                        <!-- <button title="Compare"><i class="icon-refresh"></i></button> -->
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap-2 text-center">
                                                    <div class="product-rating-wrap">
                                                        <?php 
                                                        $idrate = $item->id;

                                                        $five = DB::table('ratings')->where('rate',5)->where('product_id',$idrate)->get();
                                                        $four = DB::table('ratings')->where('rate',4)->where('product_id',$idrate)->get();
                                                        $three = DB::table('ratings')->where('rate',3)->where('product_id',$idrate)->get();
                                                        $two = DB::table('ratings')->where('rate',2)->where('product_id',$idrate)->get();
                                                        $one = DB::table('ratings')->where('rate',1)->where('product_id',$idrate)->get();

                                                        $sum = DB::table('ratings')->where('product_id',$idrate)->get();

                                                        if($sum->count() != 0){
                                                         $perfive = $five->count()*100/$sum->count();
                                                         $perfour = $four->count()*100/$sum->count();
                                                         $perthree = $three->count()*100/$sum->count();
                                                         $pertwo = $two->count()*100/$sum->count();
                                                         $perone = $one->count()*100/$sum->count();

                                                         $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                                         $aveg = round($sumstar/$sum->count()); 
                                                         $aveg2 = round($sumstar/$sum->count(),1); 
                                                     }else {
                                                       $perfive = 0;
                                                       $perfour = 0;
                                                       $perthree = 0;
                                                       $pertwo = 0;
                                                       $perone = 0;

                                                       $sumstar = 5*$five->count() + 4*$four->count() + 3*$three->count() + 2*$two->count() + 1*$one->count();
                                                       $aveg = 0; 
                                                       $aveg2 = 0; 
                                                   }


                                                   ?>
                                                        <div class="product-rating">
                                                            @if($aveg == 0)
                                                            <i class="icon_star gray"></i>
                                                            <i class="icon_star gray"></i>
                                                            <i class="icon_star gray"></i>
                                                            <i class="icon_star gray"></i>
                                                            <i class="icon_star gray"></i>
                                                            @elseif($aveg == 1)
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star gray"></i>
                                                            <i class="icon_star gray"></i>
                                                            <i class="icon_star gray"></i>
                                                            <i class="icon_star gray"></i>
                                                            @elseif($aveg == 2)
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star gray"></i>
                                                            <i class="icon_star gray"></i>
                                                            <i class="icon_star gray"></i>
                                                            @elseif($aveg == 3)
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star gray"></i>
                                                            <i class="icon_star gray"></i>
                                                            @elseif($aveg == 4)
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star gray"></i>
                                                            @else
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            @endif
                                                        </div>
                                                        <span>
                                                            ({{$aveg2}})
                                                        </span>
                                                    </div>
                                                    <h3><a href="product-details.html">{{$item->product_name}}</a></h3>
                                                    <div class="product-price-2">
                                                        @if($item->discount_price == null)
                                                        <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                                        <!-- <span class="old-price">ss</span> -->
                                                        @else
                                                        <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                                        <span class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap-2 product-content-position text-center">
                                                    <div class="product-rating-wrap">

                                                   <div class="product-rating">
                                                    @if($aveg == 0)
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 1)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 2)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 3)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    <i class="icon_star gray"></i>
                                                    @elseif($aveg == 4)
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star gray"></i>
                                                    @else
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    @endif
                                                </div>
                                                <span>
                                                    ({{$aveg2}})
                                                </span>
                                            </div>
                                                    <h3><a href="{{asset('/product/details/'.$item->id.'/'.$item->product_name)}}">{{$item->product_name}}</a></h3>
                                                    <div class="product-price-2">
                                                        @if($item->discount_price == null)
                                                        <span class="new-price">{{number_format($item->selling_price)}} ₫</span>
                                                        <!-- <span class="old-price">ss</span> -->
                                                        @else
                                                        <span class="new-price">{{number_format($item->discount_price)}} ₫</span>
                                                        <span class="old-price">{{number_format($item->selling_price)}} ₫</span>
                                                        @endif
                                                    </div>
                                                    <div class="pro-add-to-cart">
                                                        <button title="Thêm Vào Giỏ" data-id="{{($item->id)}}" class="addcart">Thêm Vào Giỏ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-10">
                                {!! $products->links() !!}
                                <ul>
                                    <!-- <li><a class="prev" href="#"><i class="icon-arrow-left"></i></a></li>
                                    <li><a class="active" href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a class="next" href="#"><i class="icon-arrow-right"></i></a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="sidebar-wrapper sidebar-wrapper-mrg-right">
                            <!-- <div class="sidebar-widget mb-40">
                                <h4 class="sidebar-widget-title">Tìm Kiếm </h4>
                                <div class="sidebar-search">
                                    <form class="sidebar-search-form" action="#">
                                        <input type="text" placeholder="Bạn muốn tìm gì...">
                                        <button>
                                            <i class="icon-magnifier"></i>
                                        </button>
                                    </form>
                                </div>
                            </div> -->
                            <div class="sidebar-widget shop-sidebar-border mb-35 pt-40">
                                <h4 class="sidebar-widget-title">Danh Mục </h4>
                                <div class="shop-catigory">
                                    <ul>
                                        @php
                                        $catproduct = DB::table('categories')->get();
                                        @endphp
                                        @foreach($catproduct as $item)
                                        <li><a href="{{asset('/products/cat/'.$item->id)}}">{{$item->category_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget shop-sidebar-border mb-35 pt-40">
                                <h4 class="sidebar-widget-title">Nhãn Hàng </h4>
                                <div class="shop-catigory">
                                    <ul>
                                        @if(Session::has('brandsubcat') || Session::has('brandcat'))
                                        @foreach($brands as $item)
                                        @php
                                            $brandproduct = DB::table('brands')->where('id',$item->brand_id)->first();
                                        @endphp
                                        @if($brandproduct == NULL )

                                        @else
                                        <li><a href="{{asset('/products/brands/'.$brandproduct->id)}}">{{$brandproduct->brand_name}}</a></li>
                                        @endif
                                        @endforeach
                                        @else
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                                <h4 class="sidebar-widget-title">Lọc Theo Giá </h4>
                                <div class="price-filter">
                                    <span>Lựa chọn khoảng giá</span>
                                    <div id="slider-range"></div>
                                    <div class="price-slider-amount">
                                        <div class="label-input">
                                            <form action="" id="form_range_price" method="get">
                                                <input type="hidden" class="checkrange" value="{{$check}}">
                                                <input type="hidden" class="minrange" value="{{$min}}">
                                                <input type="hidden" class="maxrange" value="{{$max}}">
                                                <input type="text" disabled="" value="" id="amount" name="price" placeholder="Add Your Price" />
                                                <input type="hidden" class="col-4" disabled="" value="" id="minprice">
                                                <input type="hidden" class="col-4" disabled="" value="" id="maxprice">
                                            </form>
                                            
                                        </div>
                                        <button type="button" onclick="sortPriceRange()">Lọc</button>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                                <h4 class="sidebar-widget-title">Tùy Chọn </h4>
                                <div class="sidebar-widget-list">
                                    <ul>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox"> <a href="#">Khuyến Mãi <span>4</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">Sản Phẩm Mới <span>5</span></a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">Còn Hàng<span>6</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                                <h4 class="sidebar-widget-title">Size </h4>
                                <div class="sidebar-widget-list">
                                    <ul>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">XL <span>4</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">L <span>5</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">SM <span>6</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">XXL <span>7</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
                                <h4 class="sidebar-widget-title">Color </h4>
                                <div class="sidebar-widget-list">
                                    <ul>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">Green <span>7</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">Cream <span>8</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">Blue <span>9</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input type="checkbox" value=""> <a href="#">Black <span>3</span> </a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget shop-sidebar-border pt-40">
                                <h4 class="sidebar-widget-title">Popular Tags</h4>
                                <div class="tag-wrap sidebar-widget-tag">
                                    <a href="#">Clothing</a>
                                    <a href="#">Accessories</a>
                                    <a href="#">For Men</a>
                                    <a href="#">Women</a>
                                    <a href="#">Fashion</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Modal Product-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Mua Nhanh Sản Phẩm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12 col-sm-12">
                            <!-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner" id="imgpre">

                                <div class="carousel-item active">
                                  <img class="d-block w-100" src="{{ asset('frontend/assets/images/product-details/large-1.jpg')}}">
                                  </div>
                              </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                                </a>
                            </div> -->
                            <div class="tab-content quickview-big-img" id="imgpre">
                                <!-- <div id="pro-1" class="tab-pane fade show active">
                                    <img src="{{ asset('frontend/assets/images/product/product-1.jpg')}}" alt="">
                                </div> -->
                            </div>
                            <div class="quickview-wrap mt-15 ">
                                <div class="quickview-slide-active nav-style-6" id="imgpremini">
                                    <!-- <a class="active" data-toggle="tab" href="#pro-1"><img src="{{ asset('frontend/assets/images/product/quickview-s1.jpg')}}" alt=""></a>
                                    <a data-toggle="tab" href="#pro-2"><img src="{{ asset('frontend/assets/images/product/quickview-s2.jpg')}}" alt=""></a>
                                    <a data-toggle="tab" href="#pro-3"><img src="{{ asset('frontend/assets/images/product/quickview-s3.jpg')}}" alt=""></a>
                                    <a data-toggle="tab" href="#pro-4"><img src="{{ asset('frontend/assets/images/product/quickview-s2.jpg')}}" alt=""></a> -->
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-7 col-md-6 col-12 col-sm-12">
                        <div class="product-details-content pro-details-content-mrg">
                            <h2 id="productname"></h2>
                            <!-- <div class="product-ratting-review-wrap">
                                <div class="product-ratting-digit-wrap">
                                    <div class="product-ratting">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <div class="product-digit">
                                        <span>5.0</span>
                                    </div>
                                </div>
                                <div class="product-review-order">
                                    <span>62 Reviews</span>
                                    <span>242 orders</span>
                                </div>
                            </div> -->
                            <!-- <p id="desc">{!!}</p> -->
                            <div class="product-details-meta">
                                <ul>
                                    <li><span style="width: 115px;">Mã Sản Phẩm:</span> <a id="codeproduct"></a></li>
                                    <li><span style="width: 90px;">Danh Mục:</span> <a id="cate"></a> <a id="subcate"></a></li>
                                    <li><span style="width: 90px;">Tình trạng:</span> <a id="stock"></a></li>
                                </ul>
                            </div>
                            <div class="pro-details-price" id="modalprice">
                                <!-- <span class="new-price" id="newprice"></span><span class="new-price"> ₫</span> -->
                                <!-- <span class="old-price">95.72</span><span class="old-price m-0">₫</span> -->
                            </div>
                            <form action="#" method="POST" id="form_quick_cart">
                                <input type="hidden" name="productid" id="productid">
                            <div class="pro-details-size">
                                <span>Màu:</span>
                                <div class="pro-details-size-content">
                                    <ul>
                                        <!-- <li><a href="#">XS</a></li>
                                        <li><a href="#">S</a></li>
                                        <li><a href="#">M</a></li>
                                        <li><a href="#">L</a></li>
                                        <li><a href="#">XL</a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="pro-details-quality">
                                <span>Số Lượng:</span>
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" disabled="" type="number" name="qtybutton" value="1">
                                </div>
                            </div>
                            <div class="pro-details-action-wrap">
                                <div class="pro-details-add-to-cart mt-2">
                                    <a title="Add to Cart" href="#" type="button" onclick="insertCart()">Thêm Vào Giỏ </a>
                                </div>
                            </form>
                                <div class="pro-details-action">
                                    <button title="Thêm Vào Yêu Thích" type="button" class="addWishlist idproduct" id=""><i class="icon-heart"></i></button>
                                    <!-- <a title="Add to Wishlist" href="#"><i class="icon-heart"></i></a> -->
                                    <!-- <a title="Add to Compare" href="#"><i class="icon-refresh"></i></a> -->
                                    <a class="social" title="Social" href="#"><i class="icon-share"></i></a>
                                    <div class="product-dec-social">
                                        <a class="facebook" title="Facebook" href="#"><i class="icon-social-facebook"></i></a>
                                        <a class="twitter" title="Twitter" href="#"><i class="icon-social-twitter"></i></a>
                                        <a class="instagram" title="Instagram" href="#"><i class="icon-social-instagram"></i></a>
                                        <a class="pinterest" title="Pinterest" href="#"><i class="icon-social-pinterest"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                </div>
               
            </div>
        </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
</div>
</div>
@endsection
@push('js')
<script src="{{ asset('js/frontend/autonumeric.min.js')}}"></script>
<script src="{{ asset('js/frontend/shoppage.js')}}"></script>
@endpush