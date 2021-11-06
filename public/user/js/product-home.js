

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
                html += '  <div class="img-new1">\n' +
                    '                            <div class="img-scale">\n' +
                    '                                <img src="'+e.images+'" alt="" srcset="" class="product-img">\n' +
                    '                            </div>\n' +
                    '                            <div class="product-detail">\n' +
                    '                                <div class="product-name"><a href="#">'+e.productname + disount(e.discount) +'</a>  </div>\n' +
                    '                                <div class="price-sell">\n' +
                    '                                    <div class="m-price-product-description">\n' +
                    '                                        <a href="#">'+e.description+'\n' +
                    '                                            </a>\n' +
                    '                                    </div>\n' +
                    '                                    <div class="m-price-product-show">'+pricesale(e.pricesell,e.discount)+'</div>\n' +
                    '                                </div>\n' +
                    '                                <div class="product-action">\n' +
                    '\n' +
                    '                                    <div class="icon-heart">\n' +
                    '                                        <i class="far fa-heart"></i>\n' +
                    '                                        <i class="fas fa-heart"></i>\n' +
                    '                                    </div>\n' +
                    '                                   <a style="color: #ffffff" href="/product-detail/'+e.productcode+'"> <div class="icon-search">\n' +
                    '                                        <i class="fas fa-search"></i>\n' +
                    '                                        <i class="fas fa-search-plus"></i>\n' +
                    '                                    </div></a>\n' +
                    '                                    <a href="#">\n' +
                    '                                        <div class="icon-cart" style="color: white;">\n' +
                    '                                            <i class="fas fa-cart-plus"></i>\n' +
                    '                                            <i class="fas fa-shopping-cart"></i>\n' +
                    '                                        </div>\n' +
                    '                                    </a>\n' +
                    '\n' +
                    '                                </div>\n' +
                    '                            </div>\n' +
                    '\n' +
                    '\n' +
                    '\n' +
                    '                        </div>'
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
