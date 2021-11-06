

function pricesale(price, discount){
    let html = '';
    if (discount  > 0){
        html += ' <span style="text-decoration: line-through; color: red">'+
            toMoney(price) + '</span> - <span>'+ toMoney(price * (100 - discount)/100) +'</span>';

    } else {
        html += ' <span>'+ toMoney(price) +'</span>';
    }
    return html;
}

function disount(discount){
    let html = '';
    if (discount > 0 ){
        html = '  <span style="color: red; font-size: 1.2rem">(<span>-'+discount+'</span>%)</span>'
    }
    return html;
}

function toMoney(totalprice){
    return totalprice.toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND'
    });
}






$(function () {

    let name = $('#m-search-name-page').val()

    let count = $('#m-search-total-page').val()

    window.pagObj = $('#pagination').twbsPagination({
        totalPages: count != 0 ? Math.ceil(count/6) : 1,
        visiblePages: 6,
        onPageClick: function (event, page) {
            $.ajax({
                url:'/search-all-page',
                type:'get',
                datatype:'JSON',
                data:{page,name},
                success:function(result){
                    console.log(result)
                    let html =``;
                    if (result.length > 0){
                        result.forEach(e=>{
                            html += `<div class="img-new1 col-xl-4">
                    <div class="img-scale">
                        <img src="/storage/${e.images}" alt="" srcset="" class="product-img">
                    </div>
                    <div class="product-detail">
                        <div class="product-name"><a href="#">${e.productname} </a> ${disount(e.discount)}</div>
                        <div class="price-sell">
                         <div class="m-price-product-description">
                            <a href="#"> ${e.description}
                                </a>
                                </div>
                                <div class="m-price-product-show">${pricesale(e.pricesell,e.discount)}</div>
                        </div>
                        <div class="product-action">

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
                            <a href="#">
                                <div class="icon-cart" style="color: white;">
                                    <i class="fas fa-cart-plus"></i>
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </a>

                        </div>
                    </div>

                </div>`
                        })
                        $('#m-search-page-result').html(html)
                        if (result.length < 6 &&page > 1){
                            $(window).scrollTop(200);
                        }
                        $('#m-text-search').html(name)
                        $('#m-count-search').html(count)
                    }
                    else {
                        $('#m-search-page-result').html('<h2>không tìm thấy sản phẩm nào</h2>')
                        $('#m-text-search').html(name)
                        $('#m-count-search').html(0)
                    }

                }
            })
        }
    })
});


