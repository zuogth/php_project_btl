@extends('user.main')
@section('head')
    <link rel="stylesheet" href="/user/css/slick.css">
    <link rel="stylesheet" href="/user/css/category.css">
                {{--    stars--}}
    <link rel="stylesheet" href="/user/stars/stars-rating.css">



@endsection
@section('content')
    <section>
        <div class="container-cus title">
            <ul>
                <li><a href="">Trang chủ</a></li>/
                <li><a>{{$typeName}}</a></li>
            </ul>
            <div class="title-txt">
{{--                <h1>{{$typeName}}</h1>--}}
                <p>{!! $typeDesciption !!}</p>
            </div>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/user/img/Main-Hero-banner_dang-ky-thanh-vien-1600x800.jfif"
                         alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/user/img/TV-OLED-Category-Banner-Desktop-A-V1.webp" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/user/img/TV-1600x600.webp" alt="Third slide">
                </div>
            </div>
        </div>
        <form  id="m-form-product-list-search">
        <div class="container-cus product-main">
                <div class="option-l">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categories-prod" aria-controls="categories-prod" aria-expanded="false" aria-label="Toggle navigation">
                            Chọn lọc <i class="fas fa-chevron-down"></i>
                        </button>

                        <div class="collapse navbar-collapse d-flex flex-column" id="categories-prod">

                                <input type="text" value="{{$typeCode}}" name="type" readonly hidden>
                            <div class="categories">
                                <p><label for="catehidden">Loại màn hình</label></p>
                                <input  type="radio" name="category"  value="" hidden checked id="catehidden">
                            @foreach($categoryChile as $cate)
                                    <div>
                                          <input  type="radio" name="category" id="{{$cate->categorycode}}" value="{{$cate->id}}">
                                    <label style="cursor: pointer" for="{{$cate->categorycode}}">{{$cate->categoryname}}</label>
                                </div>
                                @endforeach
                            </div>
                            <div class="categories">
                                <p><label for="brandHidden">Thương hiệu</label></p>
                                <input  type="radio" name="brand"  value="" hidden checked id="brandHidden">
                                @foreach($brands as $brand)
                                    <div>
                                        <input type="radio" name="brand" id="{{$brand->brandcode}}" value="{{$brand->id}}">
                                        <label style="cursor: pointer" for="{{$brand->brandcode}}">{{$brand->brandname}}</label>
                                    </div>
                                @endforeach
                            </div>
                                <input  type="radio" name="speciality"  value=""  checked hidden>
                                @foreach($specialities as $key => $special)
                                    <div class="categories">
                                        <p>{{$key}}</p>
                                        @foreach($special as $key => $e)
                                            <div>
                                                <input type="radio" name="speciality" id="{{$e->mata}}" value="{{$e->id}}">
                                                <label style="cursor: pointer" for="{{$e->mata}}">{{$e->mata}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach

                        </div>
                    </nav>

                </div>
                <div class="products-r">
                    <div class="option-t">
                        <div class="option-t-l">
                            <label for="select_option">Sắp xếp theo</label>
                            <select name="select_option" id="select-option">
                                <option value="">Tất cả</option>
                                <option value="name_asc">sắp xếp tên từ a->z</option>
                                <option value="name_desc">sắp xếp tên từ z->a</option>
                                <option value="price_asc">Giá sản phẩm tăng dần</option>
                                <option value="price_desc">Giá sản phẩm nhỏ dần</option>
                                <option value="5000000">Giá nhỏ hơn 5.000.000VND</option>
                                <option value="15000000">Giá từ 5.000.000VND đến 15.000.000</option>
                                <option value="25000000">Giá từ 15.000.000VND đến 25.000.000</option>
                                <option value="35000000">Giá trên 35.000.000VND </option>
                            </select>
                        </div>
                        <div class="option-t-r">

{{--                            <span id="m-count-product">{{count($products)}}</span><span> Tổng cộng</span>--}}
                            <a href="">Xem tất cả</a>
                        </div>
                    </div>

                    <!-- Danh sach san pham -->
                    <div class="products-list">
                        {{--  phan trang--}}
                        <div id="category_code" style="display: none">{{$typeCode}}</div>
                        <div id="type_code" style="display: none">
                            {{$categoryChildCode}}
                        </div>

                        <div id="brand_code" style="display: none">{{$brandCode}}</div>
                        <div id="count_pageing"style="display: none">{{$totalProduct}}</div>
                        {{--  phan trang--}}


                    </div>
                    <div class = 'd-flex w-100 justify-content-center pagination'>
                            <nav aria-label="Page navigation">
                                <ul class="pagination" id="pagination"></ul>
                            </nav>
                    </div>

                </div>
        </div>
        </form>
        <div class="container-cus view-max">
            <h2>Sản phẩm {{$productName}} bán nhiều nhất </h2>
            <div class="view-ul">
                @foreach($bestsell as $e)
                    <div class="product" style="border-radius: 10px; border: 1px solid rgba(152,141,141,0.42)">
                        <div class="product-t">
                            <span>0</span>
                            <div class="wishlist">
                                <button type="button" class="wishlistBtn"></button>
                            </div>
                        </div>
                        <div class="img-prod">
                            <img src="{{$e->images}}" alt=""  height="250px">
                        </div>
                        <div class="info-prod">
                            <a href="/product-detail/{{$e->productcode}}" >{{$e->productname}}</a>
                            @if($e->discount > 0)
                                <span style="color: red; font-size: 1.2rem">(<span>{{$e->discount}}</span>%)</span>
                            @endif
                        </div>
                        <div class="star-prod">
                            <a href="#">
                                <input id="input-1" name="input-1" class="rating rating-loading"
                                       data-min="0" data-max="5" data-step="0.1" value="{{$e->star}}" disabled>
                                <div class="star-num">({{$e->cmt}})</div>
                            </a>
                        </div>
                        <div class="label-prod">
                            <div class="label-prod-item">
                                <i class="fal fa-shipping-fast"></i><span>Vận chuyển miễn phí</span>
                            </div>
                            <div class="label-prod-item"><i class="fal fa-shield-check"></i><span>An tâm giao dịch và tận hưởng ưu đãi độc
                                    quyền</span>
                            </div>
                        </div>
                        <div class="price-prod">
                            {!! \App\Helpers\HelperMenu::pricesale($e->pricesell,$e->discount) !!}
                        </div>
                        <div class="add-cart">
                            <a href="" class="btn btn-danger">Mua</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <button id="myBtnTop" title="Lên đầu trang"></button>

@endsection

@section('footer')
    <script src="/paging/jquery.twbsPagination.js" type="text/javascript"></script>
    <script src="/user/js/slick.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.view-ul').slick({
                slidesToShow: 4,
                slidesToScroll: 4,
                infinite:false,
                draggable: true,
                arrows: true,
                Swipe: true,
                responsive: [
                    {
                        breakpoint: 1300,
                        settings:{
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 992,
                        settings:{
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    }],
                prevArrow: '<a class="prev-slick btn-slick"><img src="/user/img/carousel-left-over.svg" alt=""></a>',
                nextArrow: '<a class="next-slick btn-slick"><img src="/user/img/carousel-right-over.svg" alt=""></a>'
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#h-btn-search").click(function () {
                $("#h-search").show();
                $("body").addClass("scroll-hand");
            });
            $(".h-btn-close-search").click(function () {
                $("#h-search").hide();
                $("body").removeClass("scroll-hand");
            });
        })
    </script>
    <!-- scrollTop -->
    <script>
        $(document).ready(function () {
            $(window).scroll(function () {
                var e = $(window).scrollTop();
                if (e > 1000) {
                    $('#myBtnTop').show();
                } else {
                    $('#myBtnTop').hide();
                }
            });
            $('#myBtnTop').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                });
            });
        })
    </script>
    <script src="/user/stars/starts-rating.js"></script>
    <script src="/user/js/product-list-search.js"></script>


@endsection
