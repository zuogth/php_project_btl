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


$(function (){
    let count=$('span#count-span').html();
    if(count*1===0){
        $('a#btn-add-cart').addClass('dis-btn-buy');
    }
})

//Thêm sản phẩm vào cart
function addCart(event,id){
    let count=$('span#count-span').html();
    if(count*1===0){
        $('span.span-noti').show();
        return;
    }
    let user=$('div#info-user').attr("data-user");
    if(user){
        $.ajax({
            url:'/cart/'+id,
            type:'GET',
            success:function (result){
                if(result.error==true){
                    window.location.href='/user/login';
                }
                html=`<a onclick="addCart(this,${id})" class="btn btn-danger">Mua<i class="fas fa-check"></i></a>`
                $(event).parents().eq(0).html(html);
            },
            error:function (){
                alert('Error');
            }
        })
    }else{
        let list_cart=[];
        let flag=false;
        list_cart=JSON.parse(window.localStorage.getItem('list_cart'));
        if(list_cart!=null){
            for (let item of list_cart){
                if(item.product_id==id){
                    item.quantily+=1;
                    flag=true;
                }
            }
            if(!flag){
                let data={};
                data['product_id']=id;
                data['quantily']=1;
                list_cart.push(data);
            }
        }else{
            list_cart=[];
            let data={};
            data['product_id']=id;
            data['quantily']=1;
            list_cart.push(data);
        }
        localStorage.setItem('list_cart', JSON.stringify(list_cart));
        html=`<a onclick="addCart(this,${id})" class="btn btn-danger">Mua<i class="fas fa-check"></i></a>`
        $(event).parents().eq(0).html(html);
    }

}
