@extends('user.main')
@section('head')
    <link rel="stylesheet" href="/user/css/login.css">
@endsection
@section('content')
    <div class="main">
        <div class="container">
            <div class="l-page-desgin">
                <div class="l-detail-page-forgot forgot-design">
                    <div>  <h1>Quên mật khẩu?</h1></div>
                    <div>  <p>Chúng tôi sẽ gửi cho bạn một email để đặt lại mật khẩu của bạn.</p> </div>

                </div>
                <form method="post" action="" id="m-form-forgot-main">
                    <div class="form-login-input-page">
                        <div class="l-themes-page"><label for="email">Email *</label></div>
                        <input type="email"  id="email" placeholder="Email*" name="email">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>

                    <div class="l-list-button-page">
                        <div class="l-button-login-page-forgot">
                            <button type="submit" id="login" class="submit">Gửi</button>
                        </div>
                        <div class="l-button-login-page-forgot">
                            <a href="/user/login" class="l-button-login-page-forgot-cancel">
                                <button type="button">Quay lại</button>
                            </a>
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
            form: "#m-form-forgot-main",
            error: ".errorMessage",
            formGroupSelector: '.form-login-input-page',
            rules: [
                validation.isEmail("#email","trường này phải là email"),
                validation.isRequired("#phone", "Bạn hãy nhập số điện thoại"),

            ],
            onSubmit: function (data) {
                console.log(data)
            }
        })
    </script>
@endsection
