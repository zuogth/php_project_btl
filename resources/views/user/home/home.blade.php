@extends('user.main')
@section('head')

    <link rel="stylesheet" href="/user/css/home.css">
@endsection
@section('slider')

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="/user/img/aircare-homepage-21.09.webp" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/user/img/Main-Hero-banner_dang-ky-thanh-vien-1600x800.jfif"
                     alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/user/img/Delivery-pc-22.09.webp" alt="Third slide">
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="main">
        <div class="container-list">
            <div class="product-new">
                <div class="title">
                    <h1>THIẾT BỊ ĐIỆN GIA DỤNG ĐANG GIẢM GIÁ</h1>
                </div>
                <div class="product-new-list">
                    <div class="product-new-list-img">

                      @foreach($productsSale as $e)
                            <div class="img-new1">
                                <div class="img-scale">
                                    <img src="{{$e->images}}" alt="" srcset="" class="product-img">
                                </div>
                                <div class="product-detail">
                                    <div class="product-name"><a href="#">{{$e->productname}}
                                            @if($e->discount > 0)
                                                <span style="color: #9b3838">(<span>-{{$e->discount}}</span>%)</span>
                                            @endif
                                            </a></div>
                                    <div class="price-sell">
                                        <div class="m-price-product-description">
                                            <a href="#">{{$e->description}}
                                                LG</a>
                                        </div>
                                        <div class="m-price-product-show">
                                            {!! \App\Helpers\HelperMenu::pricesale($e->pricesell,$e->discount) !!}

                                        </div>
                                    </div>
                                    <div class="product-action">

                                        <div class="icon-heart">
                                            <i class="far fa-heart"></i>
                                            <i class="fas fa-heart"></i>

                                        </div>
                                        <a href="/product-detail/{{$e->productcode}}" style="color: #ffffff">
                                            <div class="icon-search">
                                                <i class="fas fa-search"></i>
                                                <i class="fas fa-search-plus"></i>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="icon-cart" style="color: white;">
                                                <i class="fas fa-cart-plus"></i>
                                                <i class="fas fa-shopping-cart"></i>

                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="product-new-list-btn">
                    <div class="prev">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="next">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>

            </div>
        </div>
        <div class="banner-introduce">
            <img src="/user/img/introduce.jpg" alt="" srcset="" width="100%">
            <div class="banner-introduce-context">
                <h2>TUYỆT TÁC TV DÁN TƯỜNG - OLED SIGNATURE W</h2>
            </div>
            <div class="detail-introduce">
                <a href="#" class="btn-detail">Tìm hiểu thêm</a>
            </div>
        </div>
        <div class="container-fluid component-wrap">
            <div class="row">
                <div class="col-4 warp-detail">
                    <img src="/user/img/warp1.jpg" alt="" srcset="">
                    <div class="warp-decript">
                        <h2>KHÁM PHÁ CÔNG NGHỆ NANOCELL TV</h2>
                    </div>
                    <div>
                        <a href="#">TÌM HIỂU THÊM</a>
                    </div>
                </div>
                <div class="col-4 warp-detail">
                    <img src="/user/img/warp2.jpg" alt="" srcset="">
                    <div class="warp-decript">
                        <h2>TỦ LẠNH LG - GIỮ THỰC PHẨM TƯƠI NGON LÂU HƠN</h2>
                    </div>
                    <div>
                        <a href="#">TÌM HIỂU THÊM</a>
                    </div>
                </div>
                <div class="col-4 warp-detail">
                    <img src="/user/img/warp3.jpg" alt="" srcset="">
                    <div class="warp-decript">
                        <h2>MÁY GIẶT LG - CHỐNG LẠI VI KHUẨN VÀ CÁC TÁC NHÂN GÂY DỊ ỨNG BẰNG HƠI NƯỚC</h2>

                    </div>
                    <div>
                        <a href="#">TÌM HIỂU THÊM</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-product-content">
            <div class="content-header">
                <ul id="m-content-header-myBtn">
                    <li class="m-content-header-btn active-warp">
                        <button style="cursor: pointer" onclick="suggestion('bestseller')" >Mua nhiều nhất</button>
                    </li>
                    <li class="m-content-header-btn">
                        <button style="cursor: pointer" onclick="suggestion('random')">đề xuất hấp dẫn</button>
                    </li>
                    <li class="m-content-header-btn">
                        <button style="cursor: pointer" onclick="suggestion('new')" >mới nhất</button>
                    </li>
                    <li class="m-content-header-btn">
                        <button style="cursor: pointer"  onclick="suggestion('rate')" >được đánh giá cao nhất</button>
                    </li>
                </ul>
            </div>

        </div>
        <div class="container-list-warp">
            <div class="product-new">
                <div class="product-new-list">
                    <div class="product-new-list-img m-product-load-suggestion">
                        @foreach($productBestSell as $e)
                        <div class="img-new1">
                            <div class="img-scale">
                                <img src="{{$e->images}}" alt="" srcset="" class="product-img">

                            </div>
                            <div class="product-detail">
                                <div class="product-name"><a href="#">{{$e->productname}}
                                        @if($e->discount > 0)
                                            <span style="color: #9b3838">(<span>-{{$e->discount}}</span>%)</span>
                                        @endif
                                    </a></div>
                                <div class="price-sell">
                                    <div class="m-price-product-description">
                                        <a href="#">{{$e->description}}
                                            </a>
                                    </div>
                                    <div class="m-price-product-show">
                                        {!! \App\Helpers\HelperMenu::pricesale($e->pricesell,$e->discount) !!}
                                    </div>
                                </div>
                                <div class="product-action">

                                    <div class="icon-heart">
                                        <i class="far fa-heart"></i>
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <a href="/product-detail/{{$e->productcode}}" style="color: #ffffff">
                                    <div class="icon-search">
                                        <i class="fas fa-search"></i>
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                    </a>
                                    <a href="#">
                                        <div class="icon-cart" style="color: white;">
                                            <i class="fas fa-cart-plus"></i>
                                            <i class="fas fa-shopping-cart"></i>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
                <div class="product-new-list-btn">
                    <div class="prev">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="next">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid product-discount">
            <div class="row">
                <div class="col-8 component-inner">
                    <a href="#" class="">
                        <img src="/user/img/discount.jpg" alt="" srcset="">
                    </a>
                </div>
                <div class="col-4 component-square">
                    <a href="#">
                        <img src="/user/img/discount2.jpg" alt="" srcset="">
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script src="/user/js/jquery.min.js"></script>
    <script src="/user/js/bootstrap.min.js"></script>
    <script src="/user/js/product-home.js"></script>
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
    <script src="/user/js/active.js"></script>
    <script src="/user/js/product_new.js"></script>
    <script>
        let actice_warp = new activeButton("#m-content-header-myBtn", ".m-content-header-btn", "active-warp");
        actice_warp.activeMethod()

        let slide_one = new slideImg('.container-list .product-new-list-img',
            '.container-list .product-new-list-img .img-new1',
            '.container-list .prev', '.container-list .next');
        slide_one.slide_img()
        let slide_two = new slideImg('.container-list-warp .product-new-list-img',
            '.container-list-warp .product-new-list-img .img-new1', '.container-list-warp .prev',
            '.container-list-warp .next');
        slide_two.slide_img()
    </script>

@endsection


