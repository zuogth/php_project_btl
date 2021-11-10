
@extends('user.main')
@section('head')
    <link rel="stylesheet" href="/user/css/product_detail.css">
    <link rel="stylesheet" href="/user/css/info.css">
    <link rel="stylesheet" href="/user/stars/stars-rating.css">
@endsection
@section('content')
    <div class="container-cus info-content">
        <h1 id="title-info">{{$title}}</h1>
        <div class="content row">
            <div class="content-l col-sm-2">
                <ul>
                    <li class="{{$active==1?'active-info':''}}">
                        Tài khoản của tôi
                    </li>
                    <li class="{{$active==2?'active-info':''}}">
                        Đơn hàng của tôi
                    </li>
                </ul>
            </div>
            <div class="content-r col-sm-10">
                <div class="user-info {{$active==1?'active-detail':''}}">
                    <div class="detail-info detail-info-first">
                        <div class="detail-info-item">
                            <div class="title">
                                <p>Họ và tên</p>
                            </div>
                            <div class="data-title">
                                <p>{{$user->fullname}}</p>
                            </div>
                        </div>
                        <div class="detail-info-item">
                            <div class="title">
                                <p>Email</p>
                            </div>
                            <div class="data-title">
                                <p>{{$user->email}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="detail-info">
                        <div class="detail-info-item">
                            <div class="title">
                                <p>Điện thoại</p>
                            </div>
                            <div class="data-title">
                                <p>{{$user->phone}}</p>
                            </div>
                        </div>
                        <div class="detail-info-item">
                            <div class="title">
                                <p>Địa chỉ</p>
                            </div>
                            <div class="data-title">
                                <p>{{$user->address}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="options">
                        <button type="reset" class="btn btn-update-info" data-toggle="modal" data-target="#authPass">Chỉnh sửa thông tin</button>
                    </div>
                    <div class="modal fade" id="authPass" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Mật khẩu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body modal-body-cus">
                                    <input type="password" name="password" id="password" placeholder="Mật khẩu">
                                    <button type="button" onclick="authPass()" class="btn btn-authPass"  data-dismiss="modal">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bill-info {{$active==2?'active-detail':''}}">
                    @if(sizeof($bills)==0)
                        <p class="alert alert-warning">Bạn không có đơn đặt hàng nào</p>
                    @endif
                    @foreach($bills as $key => $bill)
                        <div class="bill-info-item">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$bill->bill_date}}</td>
                                    <td>{!! \App\Helpers\Helper::price($bill->totalprice) !!}</td>
                                    <td>{!! \App\Helpers\Helper::statusBillClient($bill->status) !!}</td>
                                    <td class="td-detail" data-toggle="collapse" href="#detail-{{$key}}">Chi tiết <i
                                            class="fas fa-chevron-down"></i></td>
                                </tr>
                                </tbody>
                            </table>
                            <div id="detail-{{$key}}" class="collapse">
                                <div class="detail-item">
                                    <table class="table">
                                        <tbody>
                                        @foreach($bill->products as $product)
                                            <tr>
                                                <td class="img-item"><img src="{{$product->images}}" alt="" width="100px"></td>
                                                <td>
                                                    <a href="/product-detail/{{$product->productcode}}">{{$product->productname}}</a>
                                                </td>
                                                <td>{!! \App\Helpers\Helper::price($product->pivot->price) !!}</td>
                                                <td>x<span>{{$product->pivot->quantily}}</span></td>
                                                <td>
                                                    @if(in_array($product->id,$comments))
                                                        <a data-id="{{$product->id}}" class="btn-comment">Đã đánh giá</a>
                                                    @else
                                                        <a data-toggle="modal" data-target="#comment" data-id="{{$product->id}}" class="btn-comment">Đánh giá</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="detail-price">
                                        <h4>Tính tiền:</h4>
                                        <h6>22.000.000 VND</h6>
                                        <h6>+100.000 VND</h6>
                                        <h6>-1.000.000 VND</h6>
                                        <hr>
                                        <h5>21.100.000 VND</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="comment" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Viết đánh giá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body-cus-cm">
                    <div class="form-rate">
                        <p><span>*</span> Mục bắt buộc</p>
                        <div class="form-rate-content">
                            <form action="/user/comment" method="POST" id="formComment">
                                <div class="form-group">
                                    <label for="">Đánh giá <span>*</span></label>
                                    <input id="input-1" name="stars" class="rating rating-loading"
                                           data-min="0" data-max="5" data-step="0.1" value="">
                                    <div class="modal-errorMessage">
                                        <span class="errorMessage"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Tiêu đề <span>*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Tiêu đề ví dụ: Tính năng tuyệt vời!">
                                    <div class="modal-errorMessage">
                                        <span class="errorMessage"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung <span>*</span></label>
                                    <textarea name="content" id="content" rows="10" class="form-control" placeholder="Ví dụ: Tôi mua sản phẩm này một tháng trước và tôi cảm thấy rất hạnh phúc với quyết định này"></textarea>
                                    <div class="modal-errorMessage">
                                        <span class="errorMessage"></span>
                                    </div>
                                </div>
                                <h6>Hướng dẫn viết</h6>
                                <p>Hãy gửi chúng tôi nhận xét về sản phẩm. Vui lòng không đề cập tới đối thủ, giá sản phẩm và các sản phẩm khác, trang web, thư rác hoặc quảng cáo tại đây. Không bình luận thông tin cá nhân và các nhận xét mang tính chất tục tĩu. Nếu bạn cần thông tin về lắp đặt và dịch vụ khách hàng: liên hệ trực tiếp với chúng tôi qua tổng đài hotline.</p>
                                <div class="form-group ip-policy-pr">
                                    <div class="ip-policy">
                                        <input type="checkbox" id="policy">
                                        <label for="policy">Tôi đồng ý với chính sách bảo vệ dữ liệu.<span>*</span></label><a href="#">Đọc chính sách <i class="far fa-chevron-right"></i></a>
                                    </div>
                                    <div class="modal-errorMessage">
                                        <span class="errorMessage"></span>
                                    </div>
                                </div>
                                <div class="form-group-btn">
                                    <a class="btn btn-secondary" data-dismiss="modal">Hủy</a>
                                    <button class="btn btn-danger" type="submit">Nhận xét</button>
                                </div>
                                <input type="hidden" name="product_id" id="product_id">
                                @csrf
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="/user/stars/starts-rating.js"></script>
    <script src="/user/js/info.js"></script>
@endsection
