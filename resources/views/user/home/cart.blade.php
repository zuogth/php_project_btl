
@extends('user.main')
@section('head')
    <link rel="stylesheet" href="/user/css/cart.css">
    <link rel="stylesheet" href="/user/stars/stars-rating.css">
@endsection
@section('content')
    <div class="main">
        @if($cart==null || $cart->totalprice==0)
            <div>
                <h1>Giỏ hàng</h1>
                <hr/>
                <h4>Chưa có sản phẩm nào trong giỏ hàng!</h4>
            </div>
        @else
            <form method="get" id="m-product-to-bill">
                <div class="container-fluid m-product-cart-container">
                    <div class="m-product-cart-title">
                        <h1>Giỏ hàng</h1>
                    </div>
                    <div class="m-product-cart-context">
                        <table class="table m-product-cart-table">
                            <thead>
                            <tr>
                                <th scope="col">Chi tiết sản phẩm</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="m-product-cart-table-body">
                            @foreach($cart->products as $key => $product)
                                <tr data-id="{{$key+1}}" class="m-cart-table-line">
                                    <td scope="row">
                                        <div class="m-product-cart-table-body-img">
                                            <input type="text" hidden value="{{$product->id}}" name="id" id="id" class="id">
                                            <a href="product-detail/{{$product->productcode}}">
                                                <img src="{{$product->images}}" alt="" srcset="">
                                            </a>
                                            <div>
                                                <span>{{$product->productname}}</span>
                                                <input id="input-1" name="input-1" class="rating rating-loading"
                                                       data-min="0" data-max="5" data-step="0.1" value="4.5" disabled>
                                            </div>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="m-product-cart-price-total-button">
                                            <span class="m-cart-price-product" data-price="{{$product->pricesell*(1-$product->discount/100)}}">{!! \App\Helpers\Helper::price($product->pricesell*(1-$product->discount/100)) !!}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="m-product-cart-table-body-count-button">
                                            <div class="m-product-cart-table-body-minus">
                                                <button type="button" class="m-cart-minus">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                            <div class="m-product-cart-table-body-count">
                                                <input type="number" value="{{$product->pivot->quantily}}" name="count" class="count">
                                            </div>
                                            <div class="m-product-cart-table-body-minus">
                                                <button type="button" class="m-cart-plus">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="m-product-cart-price-total-button">
                                            <span class="m-cart-total-payment-product" data-total="{{$product->pricesell*(1-$product->discount/100)*$product->pivot->quantily}}">{!! \App\Helpers\Helper::price($product->pricesell*(1-$product->discount/100)*$product->pivot->quantily) !!}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="m-product-cart-table-body-remove">
                                            <button type="button" onclick="removeItemCart(this,{{$product->id}})">
                                                <a>
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="m-product-cart-button-clear">
                        <button class="clear-test" type="button">
                            Xoá giỏ hàng
                        </button>
                    </div>
                    <div class="m-product-cart-grand-total">
                        <div class="row">
                            <div class="col-xl-8 m-product-cart-add-note">
                                <div>
                                    <label for="title-note">Thêm ghi chú vào đơn đặt hàng của bạn
                                    </label>
                                </div>
                                <div>
                                    <textarea name="note" id="title-note" rows="6" cols="90"
                                              placeholder="Thêm ghi chú vào đơn đặt hàng của bạn" form="m-product-to-bill"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="m-product-cart-price-total">
                                    <div class="m-product-cart-price-title">
                                        <p>Tổng cộng</p>
                                    </div>
                                    <div class="m-product-cart-price-Subtotal">
                                        <div>Tổng tiền hàng</div>
                                        <div><span id="m-cart-grand-total" data-total-price="{{$cart->totalprice}}">{!! \App\Helpers\Helper::price($cart->totalprice) !!}</span></div>
                                    </div>
                                    <div class="m-product-cart-price-total-submit">

                                        <button class="test" type="button">
                                            Mua hàng
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="bill_id" id="bill_id" value="{{$cart->id}}">
                @csrf
            </form>
        @endif
    </div>
@endsection

@section('footer')
    <script src="/user/js/jquery.min.js"></script>
    <script src="/user/js/bootstrap.min.js"></script>
    <script src="/user/stars/starts-rating.js"></script>
    <script src="/user/js/product-cart.js"></script>



@endsection
