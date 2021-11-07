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
                                    <div><label for="">Số điện thoại</label></div>
                                    <div><input type="number" name="phone" placeholder="Số điện thoại *" id="phone"></div>
                                    <div class="modal-errorMessage">
                                        <span class="errorMessage"></span>
                                    </div>
                                </div>
                                <div class="form-login-input-page">
                                    <div><label for="">Email</label></div>
                                    <div><input type="text" name="email" placeholder="Email *" id="email"></div>
                                    <div class="modal-errorMessage">
                                        <span class="errorMessage"></span>
                                    </div>
                                </div>
                                <div class="m-product-bill-user-info-sent-email d-flex">
                                    <div >
                                        <input type="checkbox" name="sendemail" id="sendemail">
                                    </div>
                                    <label for="sendemail">Gửi email cho tôi với tin tức và ưu đãi</label>
                                </div>
                            </div>
                            <div class="m-product-bill-user-info-contact">
                                <div><h2>
                                        Địa chỉ giao hàng</h2></div>
                                <div class="form-login-input-page">
                                    <div><label for="">Tên</label></div>
                                    <div><input type="text" placeholder="Fisrt name" name="firstname" id="firstname">
                                    </div>
                                    <div class="modal-errorMessage">
                                        <span class="errorMessage"></span>
                                    </div>
                                </div>
                                <div class="form-login-input-page">
                                    <div><label for="">Họ</label></div>
                                    <div><input type="text" placeholder="Last name" name="lastname" id="lastname"></div>
                                    <div class="modal-errorMessage">
                                        <span class="errorMessage"></span>
                                    </div>
                                </div>
                                <div class="form-login-input-page">
                                    <div><label for="">Địa chỉ</label></div>
                                    <div><input type="text" placeholder="Address" name="address" id="address"></div>
                                    <div class="modal-errorMessage">
                                        <span class="errorMessage"></span>
                                    </div>
                                </div>
                            </div>
                            <div >
                                <button type="submit"
                                        class="m-product-bill-user-info-button">
                                    Đặt hàng</button>

                                <a href="/cart.html">
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
                                        <div><p>{{$product->pivot->quantily}}</p></div>
                                        <div> <p>{!! \App\Helpers\Helper::price($product->pricesell*(1-$product->discount/100)) !!}</p></div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="m-product-bill-detail-discount">
                                <input type="text" name="discount" id="discount" placeholder="mã voucher">
                                <button type="button">Áp dụng</button>
                            </div>
                            <div class="m-product-bill-detail-payment" >
                                <div>
                                    <div>Tổng tiền hàng</div>
                                    <div><span>{!! \App\Helpers\Helper::price($bill->totalprice) !!}</span></div>
                                </div>
                                <div>
                                    <div>Phí giao hàng</div>
                                    <div><span>$3.00</span></div>
                                </div>
                                <div>
                                    <div>Thuế</div>
                                    <div><span>$328.60</span></div>
                                </div>
                            </div>
                            <div class="m-product-bill-detail-total" >
                                <div>
                                    <div>Tổng </div>
                                    <div><span>$328.60</span></div>
                                </div>
                            </div>
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
                validation.isRequired("#firstname", "Bạn hãy nhập họ "),
                validation.isRequired("#lastname", "Bạn hãy nhập tên "),
                validation.isRequired("#address","Nhập địa chỉ"),


            ],
            onSubmit: function (data) {
                console.log(data)
            }
        })
    </script>
@endsection
