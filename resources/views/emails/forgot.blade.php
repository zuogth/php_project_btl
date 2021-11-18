@component('mail::message')
# Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!
Dear {{$email}},

Đây là mật khẩu mới của bạn: {{$password}}

@component('mail::button', ['url' => 'http://127.0.0.1:8000/user/login'])
Đăng nhập
@endcomponent

Thanks,<br>
H3 Electronic
@endcomponent
