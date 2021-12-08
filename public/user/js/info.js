$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(() => {
    $('.content-l ul li').click(function () {
        $('.content-l ul li').each(function (index, element) {
            $(element).removeClass("active-info");
        });
        $(this).addClass("active-info");
    });
    $('.content-l ul li:eq(0)').click(function(){
        document.title='Thông tin cá nhân';
        $('.bill-info').hide();
        $('.user-info').show();
        $('h1#title-info').html('Thông tin cá nhân');

    });
    $('.content-l ul li:eq(1)').click(function(){
        document.title='Đơn đặt hàng';
        $('.bill-info').show();
        $('.user-info').hide();
        $('h1#title-info').html('Đơn đặt hàng');

    });
})
//Check password
function authPass(){
    let pass=$('input#password').val();
    $.ajax({
        url:'/user/detail/check',
        type:'POST',
        datatype:'JSON',
        data:{pass},
        success:function (result){
            if(result.error){
                window.location.href='/user/login';
            }
            if(result.check){
                window.location.href='/user/detail';
            }else{
                Swal.fire(
                    'Thông báo!',
                    'Mật khẩu không chính xác.',
                    'waring'
                )
            }
        },
        error:function (){
            Swal.fire(
                'Lỗi!',
                'Xảy ra lỗi, vui lòng thử lại.',
                'error'
            )
        }
    })
}

function cancelOrder(id){
    Swal.fire({
        title: 'Bạn có chắc muốn hủy không?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận',
        cancelButtonText:'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:'/bill/cancel',
                type:'POST',
                datatype:'JSON',
                data:{id},
                success:function (result){
                    location.reload();
                },
                error:function (){
                    Swal.fire(
                        'Lỗi!',
                        'Xảy ra lỗi, vui lòng thử lại.',
                        'error'
                    )
                }
            })
        }
    })

}

//update info user
validation({
    form: "#formDetail",
    error: ".errorMessage",
    formGroupSelector: '.form-group',
    rules: [
        validation.isRequired("#fullname", "Bạn hãy nhập họ và tên"),
        validation.isRequired("#email", "Bạn hãy nhập email"),
        validation.isEmail("#email","Trường này phải là email"),
        validation.isRequired("#phone", "Bạn hãy nhập số điện thoại"),
    ]
});
function updateUser(){

    let data={};
    let formData=$('#formDetail').serializeArray();
    $.each(formData,function(i,v){
        data[""+v.name+""]=v.value;
    });
    $.ajax({
        url:'/user/detail',
        type:'PUT',
        datatype:'JSON',
        data:data,
        success:function (result){
            if(result.error){
                window.location.href='/user/login';
            }else{
                Swal.fire({
                    title: 'Thành công!',
                    text:'Cập nhật thông tin thành công',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed){
                        location.reload();
                    }
                });
            }
        },
        error:function (){
            Swal.fire(
                'Lỗi!',
                'Xảy ra lỗi, vui lòng thử lại.',
                'error'
            )
        }
    })
}


//Đổi mật khẩu
validation({
    form: "#formChangePass",
    error: ".errorMessage",
    formGroupSelector: '.form-group',
    rules: [
        validation.isRequired("#password_now", "Bạn hãy nhập mật khẩu hiện tại"),
        validation.isMinLength("#password_now", min = 6 ,`Số kí tự phải lớn hơn hoặc bằng ${min}`),
        validation.isRequired("#new_password", "Bạn hãy nhập mật khẩu mới"),
        validation.isMinLength("#new_password", min = 6 ,`Số kí tự phải lớn hơn hoặc bằng ${min}`),
        validation.isRequired("#re_new_password", "Bạn hãy nhập lại mật khẩu mới"),
        validation.isPassword_confirm("#re_new_password",()=>{
            return document.querySelector('#formChangePass #new_password').value
        } , "Vui lòng xác nhập lại mật khẩu mới")
    ]
});

//Comment
validation({
    form: "#formComment",
    error: ".errorMessage",
    formGroupSelector: '.form-group',
    rules: [
        validation.isRequired("#input-1", "Bạn hãy chọn số sao"),
        validation.isRequired("#title", "Bạn hãy nhập tiêu đề đánh giá"),
        validation.isRequired("#content", "Bạn hãy nội dung đánh giá"),
        validation.isMinLength("#content", min = 30 ,`Số kí tự phải lớn hơn hoặc bằng ${min}`),
        validation.isRequired("#policy", "Bạn chưa đồng ý với chính sách bảo mật")
    ]
});

$(()=>{
    $('a.btn-comment').click(function (){
        let product_id=$(this).attr("data-id");
        $('input#product_id').val(product_id);
    })
})
