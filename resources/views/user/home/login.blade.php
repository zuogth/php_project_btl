@extends('user.main')
@section('head')
    <link rel="stylesheet" href="/user/css/login.css">
@endsection
@section('content')
    <div class="main">
        <div class="container">
            <div class="l-page-desgin">
                @include('admin.alert')
                <div class="l-detail-page">
                    <div class="l-themes-login-page"> <h1>Đăng nhập</h1></div>

                    <div class="l-themes-register-page"><h1><a href="/user/register">Đăng ký</a></h1></div>
                </div>
                <form method="post" action="" id="m-form-login-main">
                    <div class="form-login-input-page">
                        <div class="l-themes-page"><label for="username">Tài khoản *</label></div>
                        <input type="text"  id="username" placeholder="Nhập tài khoản *" name="username">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>
                    <div class="form-login-input-page">
                        <div class="l-themes-page"><label for="password">Mật khẩu *</label></div>
                        <input type="password" id="password" placeholder="Nhập mật khẩu *" name="password">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>
                    <div class="btn-google">
                        <a href="/google/login" class="btn">
                            <i class="fab fa-google"></i>
                        </a>
                    </div>

                    <div class="l-list-button-page">
                        <div class="l-button-login">
                            <button type="submit" id="login" class="login">Đăng nhập</button>
                        </div>
                        <div class="l-footer-page">
                            <div class="forgot-password-page"><a href="./forgot.html">Quên mật khẩu?</a></div>
                        </div>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="./js/validate.js"></script>
    <script>
        validation({
            form: "#m-form-login-main",
            error: ".errorMessage",
            formGroupSelector: '.form-login-input-page',
            rules: [
                validation.isRequired("#username", "Bạn hãy nhập tài khoản"),
                validation.isRequired("#password", "Bạn hãy nhập mật khẩu"),
                validation.isMinLength("#password", min = 6 ,`Số kí tự phải lớn hơn hoặc bằng ${min}`)
            ],
            onSubmit: function (data) {
                console.log(data)
            }
        })
    </script>
@endsection
