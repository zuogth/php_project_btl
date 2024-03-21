@extends('user.main')
@section('head')
    <link rel="stylesheet" href="/user/css/bill.css">
@endsection
@section('content')
    <div class="main">
        @include('admin.alert')
        <form action="/bill/{{$bill->id}}" method="POST" id="m-cart-to-bill">
            <div class="container-fluid m-product-bill-container">
                <div class="row">
                    <div class="col-xl-7">
                        <div class="m-product-bill-user-info">
                            <div class="m-product-bill-user-info-contact">
                                <div><h2>
                                        Thông tin liên lạc </h2></div>
                                <div class="form-login-input-page">
                                    <div><label for="">Họ và tên</label></div>
                                    <div><input type="text" placeholder="Name" name="fullname" id="fullname" value="{{$user->fullname}}"></div>
                                    <div class="modal-errorMessage">
                                        <span class="errorMessage"></span>
                                    </div>
                                </div>
                                <div class="form-login-input-page">
                                    <div><label for="">Số điện thoại</label></div>
                                    <div><input type="number" name="phone" placeholder="Số điện thoại *" id="phone" value="{{$user->phone}}"></div>
                                    <div class="modal-errorMessage">
                                        <span class="errorMessage"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-product-bill-user-info-contact">
                                <div><h2>
                                        Địa chỉ giao hàng</h2></div>

                                <div class="form-login-input-page form-group-cus">
                                    <div><label for="">Thành phố</label></div>
                                    <div>
                                        <input type="text" onkeyup="searchProvince(this)" onfocus="listProvince(this)" id="province" onfocusout="unFocusInput(this)"
                                               name="province" parent_code="" value="{!! \App\Helpers\Helper::address(0,$user->address) !!}" placeholder="Thành phố...">
                                        <div class="modal-errorMessage">
                                            <span class="errorMessage"></span>
                                        </div>
                                    </div>
                                    <div class="province" onmouseleave="onMouseLeave()" onmouseenter="onMouseEnter()">
                                        <ul id="listData"></ul>
                                    </div>
                                </div>
                                <div class="form-login-input-page form-group-cus">
                                    <div><label for="">Quận, huyện</label></div>
                                    <div>
                                        <input type="text" onkeyup="searchDistrict(this)" onfocus="listDistrict(this)" parent="province" onfocusout="unFocusInput(this)"
                                               name="district" id="district" parent_code="" value="{!! \App\Helpers\Helper::address(1,$user->address) !!}"
                                               placeholder="Huyện...">
                                        <div class="modal-errorMessage">
                                            <span class="errorMessage"></span>
                                        </div>
                                    </div>
                                    <div class="district" onmouseleave="onMouseLeave()" onmouseenter="onMouseEnter()">
                                        <ul class="listData"></ul>
                                    </div>
                                </div>
                                <div class="form-login-input-page form-group-cus">
                                    <div><label for="">Xã</label></div>
                                    <div>
                                        <input type="text" onkeyup="searchWard(this)" onfocus="listWard(this)" parent="district" onfocusout="unFocusInput(this)"
                                               name="ward" id="ward" parent_code="" value="{!! \App\Helpers\Helper::address(2,$user->address) !!}"
                                               placeholder="Xã...">
                                        <div class="modal-errorMessage">
                                            <span class="errorMessage"></span>
                                        </div>
                                    </div>
                                    <div class="ward" onmouseleave="onMouseLeave()" onmouseenter="onMouseEnter()">
                                        <ul class="listData"></ul>
                                    </div>
                                </div>
                                <div class="form-login-input-page form-group-cus">
                                    <div><label for="">Thôn, số nhà</label></div>
                                    <div>
                                        <input type="text" name="village" id="village"
                                               value="{!! \App\Helpers\Helper::address(3,$user->address) !!}" placeholder="Chi tiết (thôn, số nhà,...)">
                                        <div class="modal-errorMessage">
                                            <span class="errorMessage"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div >
                                <button type="submit"
                                        class="m-product-bill-user-info-button">
                                    Đặt hàng</button>

                                <a href="/cart">
                                    <button type="button" class="m-product-bill-user-info-button">
                                        Quay lại giỏ hàng
                                    </button>
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 m-product-bill-design-detail">
                        <div class="m-product-bill-detail-price">
                            <div class="m-product-bill-detail-list" >

                                @foreach($bill->products as $product)
                                    <div class="m-product-bill-detail-list-incart">
                                        <div class="d-flex">
                                            <img src="{{$product->images}}" alt="">
                                            <div> <p>{{$product->productname}}</p></div>
                                        </div>
                                        <div><p>x{{$product->pivot->quantily}}</p></div>
                                        <div> <p>{!! \App\Helpers\Helper::price($product->pricesell*(1-$product->discount/100)) !!}</p></div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="m-product-bill-detail-discount">
                                <input type="text" name="discount" id="discount" placeholder="Mã voucher">
                                <button type="button">Áp dụng</button>
                            </div>
                            <div class="m-product-bill-detail-payment" >
                                <div>
                                    <div>Tổng tiền hàng</div>
                                    <div><span>{!! \App\Helpers\Helper::price($bill->totalprice) !!}</span></div>
                                </div>
                                <div>
                                    <div>Phí giao hàng</div>
                                    <div><span>100.000 VND</span></div>
                                </div>
                            </div>
                            <div class="m-product-bill-detail-total" >
                                <div>
                                    <div>Tổng </div>
                                    <div><span>{!! \App\Helpers\Helper::price($bill->totalprice+100000) !!}</span></div>
                                </div>
                            </div>
                            <input type="hidden" name="totalprice" value="{{$bill->totalprice+100000}}">
                        </div>

                    </div>
                </div>
            </div>
            @csrf
        </form>
    </div>
@endsection
@section('footer')
    <script src="/user/js/validate.js"></script>
    <script>
        validation({
            form: "#m-cart-to-bill",
            error: ".errorMessage",
            formGroupSelector: '.form-login-input-page',
            rules: [
                validation.isRequired("#phone", "Bạn hãy nhập số điện thoại"),
                validation.isRequired("#email", "Bạn hãy nhập email"),
                validation.isEmail("#email","Trường này phải là email"),
                validation.isRequired("#fullname", "Bạn hãy nhập họ và tên "),
                validation.isRequired("#province","Nhập địa chỉ thành phố"),
                validation.isRequired("#district","Nhập địa chỉ huyện/quận"),
                validation.isRequired("#ward","Nhập địa chỉ phường/xã"),
                validation.isRequired("#village","Nhập địa chỉ chi tiết nơi nhận hàng"),


            ],
            onSubmit: function (data) {
                console.log(data)
            }
        })
    </script>
    <script src="/user/js/getcities.js"></script>
@endsection
