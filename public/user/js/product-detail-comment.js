$(function () {

    let product_id = $('#product_id').html()
    // let typeCode = $('#type_code').html()
    // let brandCode = $('#brand_code').html()
    let count = $('#count_pageing').html()

    window.pagObj = $('#pagination').twbsPagination({
        totalPages: count == 0? 1 : count,
        visiblePages: 6,
        onPageClick: function (event, page) {
            $.ajax({
                url:'/product-comment',
                type:'get',
                datatype:'JSON',
                data:{page,product_id},
                success:function(result){
                    console.log(result)
                    let html = ``;
                    result.forEach(e=>{
                        html +=`<div class="content-cm">
                        <div class="content-cm-left">
                            <div class="m-stars">
                                <input id="input-1" name="input-1" class="rating rating-loading"
                                       data-min="0" data-max="5" data-step="0.1" value="${e.stars}" disabled>
                            </div>
                            <p class="mt-2 ml-4">${e.name}<span> -- </span><span> ${e.cmt_datetime}</span></p>
                        </div>
                        <div class="content-cm-right">
                            <h5>${e.title}</h5>
                            <p>${e.context}</p>

                        </div>
                    </div>
                    <script src="/user/stars/starts-rating.js"></script>
                    </div>`
                    });

                    $('#m-list-comment').html(html)
                    if (result.length < 6 && page != 1){
                        $(window).scrollTop(3600);
                    }
                }
            })
        }
    })
});


//Thêm sản phẩm vào cart
function addCart(event,id){
    $.ajax({
        url:'/cart/'+id,
        type:'GET',
        success:function (result){
            html=`<a onclick="addCart(this,${id})" class="btn btn-danger">Mua<i class="fas fa-check"></i></a>`
            $(event).parents().eq(0).html(html);
        },
        error:function (){
            alert('Error');
        }
    })
}
