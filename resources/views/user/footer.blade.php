<footer>
    <div class="container-cus footer-t">
        <p>Giá cả, chương trình khuyến mãi có thể thay đổi tùy theo cửa hàng (bao gồm cả cửa hàng trực tuyến).
            Giá có thể thay đổi mà không cần thông báo. Số lượng có hạn. Kiểm tra với các nhà bán lẻ để biết mức
            giá cuối cùng.</p>
        <hr>
        <p><strong>Với những khu vực áp dụng giãn cách Xã hội theo yêu cầu của các Cơ quan Nhà nước có thẩm
                quyền, thời gian giao hàng (từ 03 đến 07 ngày) sẽ được tính kể từ ngày chấm dứt giãn cách Xã
                hội.</strong></p>
        <p>LG Ti Vi, Máy Tính, Thiết Bị Gia Dụng, Điều Hòa Nhiệt Độ Và Điện Thoại Di Động.</p>
        <p>LG Việt Nam cung cấp những thiết bị âm thanh và hình ảnh tối ưu, những thiết bị nghe nhìn đáp ứng cho
            chuẩn mực giải trí tại nhà. Thưởng thức những bộ phim hay nhất, những màn hành động gay cấn, chương
            trình thể thao đẳng cấp quốc tế,… trên <a href="#">các loại tivi</a> LG chắc chắn sẽ làm bạn hài
            lòng.</p>
        <p>LG Việt Nam luôn không ngừng sáng tạo để mang đến những sản phẩm giải trí tiên tiến với công nghệ 3D
            và SmartTV nhằm đáp ứng tốt nhất những tiêu chuẩn giải trí số và đưa bạn đến thế giới giải trí bất
            tận trên Internet.</p>
        <p>Không cần đi đâu xa, tận hưởng cả thế giới giải trí số ngay tại căn hộ ấm cúng để thưởng thức những
            hình ảnh sắc nét nhất cùng hiệu ứng âm thanh sống động với những sản phẩm từ LG.</p>
        <hr>
        <div class="footer-m align-items-center">
            <div class="f-national">
                <img src="./img/vietnam.png" alt=""><a href="#">Việt Nam</a>
            </div>
            <div class="f-social">
                <ul>
                    <li><a href=""><i class="fab fa-facebook"></i></a></li>
                    <li><a href=""><i class="fab fa-youtube"></i></a></li>
                    <li><a href=""><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>

    </div>
    <div class="footer">
        <div class="container-cus footer-b">
            <div class="footer-b-r">
                <ul>
                    <li><a href="">Sitemap</a></li>
                    <li><a href="">Quyền riêng tư</a></li>
                    <li><a href="">Phát lý</a></li>
                    <li><a href="">Chính sách mua hàng và đổi trả</a></li>
                </ul>
                <p>Bản quyền © 2021 Công ty HHH bảo lưu mọi quyền</p>
                <p>ĐT: 024 3934 5151</p>
                <p>Email: <a href="mailto:tuanhieu342000@gmail.com">tuanhieu342000@gmail.com</a></p>
            </div>
            <fiv class="footer-b-l">
                <img src="./img/icon-vn01.png" alt="">
            </fiv>
        </div>
    </div>
</footer>

<!-- login -->
<div class="modal fade" id="form-login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog login-desgin" role="document">
        <div class="modal-content">
            <div class="modal-body-desgin">
                <div class="l-detail">
                    <h3>Đăng nhập</h3>
                    <div class="l-exits">
                        <i class="fas fa-times" data-dismiss="modal"></i>
                    </div>
                </div>
                <form action="/user/login" method="POST" id="modal-form-login" >
                    <div class="form-login-input">
                        <input type="text" id="username" placeholder="Tài khoản*" name="username">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>
                    <div class="form-login-input">
                        <input type="password" id="password" placeholder="Mật khẩu *" name="password">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>
                    <div class="l-modal-footer-detail">
                        <div class="forgot-password"><a  href="./forgot.html"
                            >Quên mật khẩu?</a></div>
                    </div>
                    <div class="l-list-button">
                        <div class="l-button-login">
                            <button type="submit" id="login" class="login">Đăng nhập</button>
                        </div>
                        <div class="l-button-register">

                            <a href="./register.html" >
                                <button id="register" class="register" type="button"> Đăng ký</button></a>

                        </div>
                    </div>
                    @csrf
                </form>
            </div>

        </div>
    </div>
</div>

<!-- jQuery -->



<script src="/user/js/validate.js"></script>
<script>
    validation({
        form: "#modal-form-login",
        error: ".errorMessage",
        formGroupSelector: '.form-login-input',
        rules: [
            validation.isRequired("#username", "Bạn hãy nhập tài khoản"),
            validation.isRequired("#password", "Bạn hãy nhập mật khẩu"),
            validation.isMinLength("#password", min = 6 ,`số kí tự phải lớn hơn hoặc bằng ${min}`)
        ],
        onSubmit: function (data) {
            console.log(data)
        }
    })
</script>
<script src="/template/admin/plugins/sweet/sweetalert2.all.min.js"></script>
@yield('footer')<?php
