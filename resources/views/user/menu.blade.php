<style>
    .m-category-list{
        display: flex;
        width: 95%;
        margin: auto;
        justify-content: space-around;
    }
    .m-category-list>ul{
        width: 30%;
    }

</style>
<header>
    <div class="container-cus container-header">
        <div class="header">
            <div class="h-logo">
                <a href="/"><img src="/user/img/logo-b2c.jpg" alt=""></a>
            </div>
            <div class="header-r">
                <div class="h-menu-t">
                    <div>
                        <a href=""><i class="fas fa-heart"></i> Wishlist</a>
                    </div>
                </div>
                <div class="h-menu align-items-center">
                    <div class="h-menu-left">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-label="Toggle navigation">
                            <i class="fas fa-bars"></i>
                        </button>
                        <nav class="navbar-expand-lg navbar-light">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/">Trang chủ</a>
                                    </li>


                                    {!! \App\Helpers\HelperMenu::menus($menus,$brands) !!}


                                    <li class="nav-item h-span"><span class="nav-link">|</span></li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Hỗ trợ</a>
                                        <div class="hidden-menu-child">
                                            <div class="h-menu-child">
                                                <div class="h-menu-child-item">
                                                    <a href="#">Hỗ trợ <i class="fas fa-angle-right"></i></a>
                                                    <a href="#">Đăng ký thông tin sản phẩm <i
                                                            class="fas fa-angle-right"></i></a>
                                                    <a>Hướng dẫn & tải về</a>
                                                    <ul>
                                                        <li><a href="#">Thư viện trợ giúp</a></li>
                                                        <li><a href="#">Video hướng dẫn</a></li>
                                                        <li><a href="#">Hướng dẫn sử dụng</a></li>
                                                        <li><a href="#">Cập nhật phần mềm</a></li>
                                                    </ul>
                                                </div>
                                                <div class="h-menu-child-item h-border-menu">
                                                    <a>Liên hệ với chúng tôi</a>
                                                    <ul>
                                                        <li><a href="#">Chat & Email</a></li>
                                                        <li><a href="#">Điện thoại</a></li>
                                                        <li><a href="#">Kiểm tra tình trạng</a></li>
                                                        <li><a href="#">Khảo sát ý kiến khách hàng</a></li>
                                                    </ul>
                                                    <a class="margin-a">Dịch vụ sửa chữa</a>
                                                    <ul>
                                                        <li><a href="#">Đặt lịch sửa chữa</a></li>
                                                        <li><a href="#">Theo dõi tình trạng sửa chữa</a></li>
                                                        <li><a href="#">Tìm nơi sửa chữa</a></li>
                                                        <li><a href="#">Chính sách bảo hành</a></li>
                                                    </ul>
                                                </div>
                                                <div class="h-menu-child-item h-border-menu">
                                                    <a>Hỗ trợ bổ sung</a>
                                                    <ul>
                                                        <li><a href="#">Linh kiện & phụ kiện</a></li>
                                                        <li><a href="#">Thông báo</a></li>
                                                    </ul>
                                                    <a href="#" class="margin-a">Hỗ trợ cá nhân <i
                                                            class="fas fa-angle-right"></i></a>
                                                    <ul>
                                                        <li><a href="#">Thông tin cá nhân</a></li>
                                                        <li><a href="#">Sản phẩm đã đăng ký</a></li>
                                                        <li><a href="#">Theo dõi các yêu cầu</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="h-logo-m">
                        <img src="/user/img/logo-b2c-m.jpg" alt="">
                    </div>
                    <div class="h-menu-right">
                        <ul>
                            <li>
                                @if(\Illuminate\Support\Facades\Auth::user())
                                    <a>{{\Illuminate\Support\Facades\Auth::user()->fullname}}</a>
                                @else
                                    <a><i class="far fa-user" data-toggle="modal" data-target="#form-login"></i></a>
                                @endif
                            </li>
                            <li><a href="/cart"><i class="fas fa-shopping-cart"></i></a></li>
                            <li><a href="#" id="h-btn-search"><i class="fas fa-search"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-search" id="h-search">
            <div class="h-close-search"><a href="#" class="h-btn-close-search"><i class="fal fa-times"></i></a>
            </div>
            <div class="h-search-content">
                <h2>Bạn cần hỗ trợ ?</h2>
                <div class="h-search-input">
                    <form action="/search">

                        <input type="text" name="name" placeholder="Tìm kiếm trên LG" autocomplete="off" id="m-input-search-product"/>
                        <button type="button" class="h-btn-search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="h-keyword-field row">
                    <div class="h-recently-keyword col-sm-6">
                        <div class="h-recently-head">
                            <div class="head-keyword w-100">
                                <div class="d-flex justify-content-between">
                                    <p>Tìm kiếm gần đây</p>
                                    <p id="m-delete-text-input">Xóa tất cả</p>
                                </div>
                                <div id="m-product-result-search">
                                  {{--result--}}

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="most-searched col-sm-6">
                        <div class="head-keyword">Tìm kiếm nhiều nhất</div>
                        <div class="most-item">
                            <a href="">FC1409S2W</a>
                            <a href="">A5UW42GFA1</a>
                            <a href="">GR-B247JS</a>
                            <a href="">Màn hình ultragear</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
<script src="/user/js/search.js"></script>
@yield('slider')<?php
