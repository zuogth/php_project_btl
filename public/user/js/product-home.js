

function suggestion(value){
    $.ajax({
        url: '/new',
        type: 'get',
        datatype: 'JSON',
        data: {value},
        success: function (result) {
            console.log(result)
            let html = ''
            result.forEach(e =>{
               console.log(e)
                html += `<div class="img-new1">
                                               <div class="img-scale">
                                                   <img src="${e.images}" alt="" srcset="" class="product-img">
                                               </div>
                                               <div class="product-detail">
                                                    <div class="product-name">
                                                    <a href="#">${e.productname + disount(e.discount)}</a>`;
                                                    if(e.count*1===0){
                                                        html+=`<p class="p-noti" id="noti-${e.id}">Hết hàng</p>`;
                                                    }else {
                                                        html+=`<p class="p-noti non-ac" id="noti-${e.id}">Sản phẩm đã hết hàng</p>`;
                                                    }
                                                   html+=`</div>
                                                    <div class="price-sell">
                                                       <div class="m-price-product-description">
                                                            <a href="#">${e.description}
                                                                </a>
                                                        </div>
                                                        <div class="m-price-product-show">${pricesale(e.pricesell,e.discount)}</div>
                                                   </div>`;
                                                    if(e.count*1===0){
                                                        html+=`<div class="product-action">

                                                                <div class="icon-heart">
                                                                    <i class="far fa-heart"></i>
                                                                    <i class="fas fa-heart"></i>
                                                                </div>
                                                                 <a style="color: #ffffff" href="/product-detail/${e.productcode}">
                                                                    <div class="icon-search">
                                                                        <i class="fas fa-search"></i>
                                                                        <i class="fas fa-search-plus"></i>
                                                                    </div>
                                                                  </a>

                                                            </div>`
                                                    }else {
                                                        html+=`<div class="product-action">

                                                                <div class="icon-heart">
                                                                    <i class="far fa-heart"></i>
                                                                    <i class="fas fa-heart"></i>
                                                                </div>
                                                                 <a style="color: #ffffff" href="/product-detail/${e.productcode}">
                                                                    <div class="icon-search">
                                                                        <i class="fas fa-search"></i>
                                                                        <i class="fas fa-search-plus"></i>
                                                                    </div>
                                                                  </a>
                                                                <a onclick="addCart(this,${e.id},${e.count})">
                                                                    <div class="icon-cart" style="color: white;">
                                                                        <i class="fas fa-cart-plus"></i>
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                    </div>
                                                                </a>

                                                            </div>`
                                                    }

                                               html+=`</div>
                                            </div>`;
           })
            $('.m-product-load-suggestion').html(html)
            let slide_two = new slideImg('.container-list-warp .product-new-list-img',
                '.container-list-warp .product-new-list-img .img-new1', '.container-list-warp .prev',
                '.container-list-warp .next');
            slide_two.slide_img()
        }
    })
}

function pricesale(price, discount){
    let html = '';
    if (discount  > 0){
        html += '<span style="text-decoration: line-through">'+
            toMoney(price) + '</span> - <span>'+toMoney(price * (100 - discount)/100) +'</span>';

    } else {
        html += ' <span>'+price +'</span>VND';
    }
    return html;
}

function disount(discount){
    let html = '';
    if (discount > 0 ){
       html = '<span style="color: #9b3838">(<span>-'+discount+'</span>%)</span>'
    }
    return html;
}

function toMoney(totalprice){
    return totalprice.toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND'
    });
}

function addCart(event,id,countMax){
    let user=$('div#info-user').attr("data-user");
    if(user){
        $.ajax({
            url:'/cart/'+id,
            type:'GET',
            success:function (result){
                if(result.error==true){
                    if(result.count==null){
                        window.location.href='/user/login';
                    }else {
                        $('p#noti-'+id).removeClass("non-ac");
                    }
                }
                html=`<div class="icon-cart" style="color: white;">
                                            <i class="fas fa-cart-plus"></i>
                                            <i class="fas fa-check"></i>
                                        </div>`
                $(event).html(html);
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
                    if(item.quantily===countMax){
                        $('p#noti-'+id).removeClass("non-ac");
                        flag=true;
                    }else {
                        item.quantily+=1;
                        flag=true;
                    }
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
        html=`<div class="icon-cart" style="color: white;">
                                            <i class="fas fa-cart-plus"></i>
                                            <i class="fas fa-check"></i>
                                        </div>`
        $(event).html(html);
    }

}
