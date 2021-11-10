
@extends('user.main')
@section('head')
    <link rel="stylesheet" href="/user/css/info.css">
@endsection
@section('content')
    <div class="container-cus info-content">
        <h1 id="title-info">{{$title}}</h1>
        <div class="options">
            <p><span>*</span> Mục bắt buộc</p>
        </div>
        <div class="update-info-group">
            <div class="update-info">
                <h2>Chỉnh sửa thông tin tài khoản</h2>
                <form action="" id="formDetail">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="fullname">Họ và tên <span>*</span></label>
                            <input type="text" name="fullname" id="fullname" value="{{$user->fullname}}" class="input-update-info" placeholder="Họ và tên">
                            <div class="modal-errorMessage">
                                <span class="errorMessage"></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{$user->email}}" class="input-update-info" placeholder="Email">
                            <div class="modal-errorMessage">
                                <span class="errorMessage"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="phone">Điện thoại <span>*</span></label>
                            <input type="number" name="phone" id="phone" value="{{$user->phone}}" class="input-update-info" placeholder="Điện thoại">
                            <div class="modal-errorMessage">
                                <span class="errorMessage"></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" value="{{$user->address}}" class="input-update-info" placeholder="Địa chỉ">
                        </div>
                    </div>
                    <div class="btn-update-group">
                        <a href="/user/detail/1" class="btn btn-cancel">Hủy</a>
                        <button type="button" onclick="updateUser()" class="btn btn-submit">Lưu</button>
                    </div>
                </form>
            </div>
            <br>
            <div class="options">
                <p><span>*</span> Mục bắt buộc</p>
            </div>
            <div class="update-info">
                <h2 style="margin: 0;">Đổi mật khẩu</h2>
                <p>Để thay đổi mật khẩu, chỉ cần nhập mật khẩu cũ của bạn và sau đó nhập mật khẩu mới vào cả hai dòng dưới đây.</p>
                <form action="/user/detail" method="post" id="formChangePass">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="password_now">Mật khẩu hiện tại <span>*</span></label>
                            <input type="password" name="password_now" id="password_now" class="input-update-info" placeholder="Mật khẩu hiện tại">
                            <div class="modal-errorMessage">
                                <span class="errorMessage"></span>
                                @if(Session::has('password-err'))
                                    <span>{{Session::get('password-err')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="new_password">Mật khẩu mới <span>*</span></label>
                            <input type="password" name="new_password" id="new_password" class="input-update-info" placeholder="Mật khẩu mới">
                            <span class="modal-errorMessage">
                                <span class="errorMessage"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="re_new_password">Xác nhận mật khẩu <span>*</span></label>
                            <input type="password" name="re_new_password" id="re_new_password" class="input-update-info" placeholder="Xác nhận lại mật khẩu">
                            <div class="modal-errorMessage">
                                <span class="errorMessage"></span>
                            </div>
                        </div>
                    </div>
                    @csrf
                    <div class="btn-update-group">
                        <button type="submit" class="btn btn-submit">Lưu mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="/user/js/info.js"></script>
@endsection

