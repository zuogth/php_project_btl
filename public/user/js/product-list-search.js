
$('#m-form-product-list-search input,#select-option').change(function (){
    let formSumbit = $('#m-form-product-list-search').serializeArray();
    let data={}
    $.each(formSumbit, function (i,v){
        data[v.name] = v.value;
    })

    $('.pagination').html(`<nav aria-label="Page navigation">
                                <ul class="pagination" id="paginationTest"></ul>
                            </nav>
                         `);
    $.ajax({
        url:'/total',
        type:'get',
        datatype:'JSON',
        data:data,
        success:function(result){
            pagetest(data,result);
        }
    })


})
function pagetest(data,count) {
        window.pagObj = $('#paginationTest').twbsPagination({
            totalPages: count,
            visiblePages: 6,
            onPageClick: function (event, page) {
                data['page'] = page;
                $.ajax({
                    url:'/product',
                    type:'get',
                    datatype:'JSON',
                    data:data,
                    success:function(result){
                        console.log(result)
                        let html = ``;
                        result.forEach(e=>{

                            html +=`  <div class="product">
                            <div class="product-t">
                                <span>0</span>
                                <div class="wishlist">
                                    <button type="button" class="wishlistBtn"></button>
                                </div>
                            </div>
                            <div class="img-prod">
                                <img src="${e.images}" alt=""  height="250px">
                            </div>
                            <div class="info-prod">
                                <a href="/product-detail/${e.productcode}" >${e.productname}</a>
                                ${disount(e.discount)}
                            </div>
                            <div class="star-prod">
                                <a href="#">
                                    <input id="input-1" name="input-1" class="rating rating-loading"
                                           data-min="0" data-max="5" data-step="0.1" value="${star(e.star)}" disabled>
                                    <div class="star-num">(${e.cmt})</div>
                                </a>
                            </div>
                            <div class="label-prod">
                                <div class="label-prod-item">
                                    <i class="fal fa-shipping-fast"></i><span>Vận chuyển miễn phí</span>
                                </div>
                                <div class="label-prod-item"><i class="fal fa-shield-check"></i><span>An tâm giao dịch và tận hưởng ưu đãi độc
                                        quyền</span>
                                </div>
                            </div>
                            <div class="price-prod">
                                ${pricesale(e.pricesell, e.discount)}

                            </div>
                            <div class="add-cart">

                                <a onclick="addCart(this,${e.id})" class="btn btn-danger">Mua</a>
                            </div>
                        </div><script src="/user/stars/starts-rating.js"></script>`;
                        })

                        $('.products-list').html(html)
                        if (page > 1){
                            $(window).scrollTop(1000);
                        }
                    }
                })
            }
        })

}


function star(value){
    value == null ? value = 0 :  value;
    return value;
}

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

//test
$(function () {

    let categoryCode = $('#category_code').html()
    let typeCode = $('#type_code').html()
    let brandCode = $('#brand_code').html()
    let count = $('#count_pageing').html()

    window.pagObj = $('#pagination').twbsPagination({
        totalPages: count,
        visiblePages: 6,
        onPageClick: function (event, page) {
            $.ajax({
                url:'/page',
                type:'get',
                datatype:'JSON',
                data:{page,categoryCode,typeCode,brandCode},
                success:function(result){
                    console.log(result)
                    count = $('#count_pageing').html()
                    let html = `
                                    <div id="category_code" style="display: none">${result.cateName}</div>
                                     <div id="type_code" style="display: none" >${result.type}</div>

                                    <div id="brand_code" style="display: none" >${result.brand}</div>
                                     <div id="count_pageing" style="display: none" >${result.totalProduct}</div>`;
                    result.product.forEach(e=>{

                        html +=`  <div class="product">
                            <div class="product-t">
                                <span>0</span>
                                <div class="wishlist">
                                    <button type="button" class="wishlistBtn"></button>
                                </div>
                            </div>
                            <div class="img-prod">
                                <img src="${e.images}" alt=""  height="250px">
                            </div>
                            <div class="info-prod">
                                <a href="/product-detail/${e.productcode}" >${e.productname}</a>
                                ${disount(e.discount)}
                            </div>
                            <div class="star-prod">
                                <a href="#">
                                    <input id="input-1" name="input-1" class="rating rating-loading"
                                           data-min="0" data-max="5" data-step="0.1" value="${star(e.star)}" disabled>
                                    <div class="star-num">(${e.cmt})</div>
                                </a>
                            </div>
                            <div class="label-prod">
                                <div class="label-prod-item">
                                    <i class="fal fa-shipping-fast"></i><span>Vận chuyển miễn phí</span>
                                </div>
                                <div class="label-prod-item"><i class="fal fa-shield-check"></i><span>An tâm giao dịch và tận hưởng ưu đãi độc
                                        quyền</span>
                                </div>
                            </div>
                            <div class="price-prod">
                                ${pricesale(e.pricesell, e.discount)}

                            </div>
                            <div class="add-cart">
                                <a onclick="addCart(this,${e.id})" class="btn btn-danger">Mua</a>
                            </div>
                        </div><script src="/user/stars/starts-rating.js"></script>`;
                    })

                    $('.products-list').html(html)
                    if (page > 1){
                        $(window).scrollTop(1000);
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
}


//////////////////////////////////////////////////////////////////////////

// $('#m-form-product-list-search input,#select-option').change(function (){
//     let formSumbit = $('#m-form-product-list-search').serializeArray();
//     $.ajax({
//         url:'/product',
//         type:'get',
//         datatype:'JSON',
//         data:formSumbit,
//         success:function(result){
//             console.log(result)
//             html = "";
//             result.forEach(e=>{
//
//                 html +=' <div class="product">\n' +
//                     '                        <div class="product-t">\n' +
//                     '                            <span>0</span>\n' +
//                     '                            <div class="wishlist">\n' +
//                     '                                <button type="button" class="wishlistBtn"></button>\n' +
//                     '                            </div>\n' +
//                     '                        </div>\n' +
//                     '                        <div class="img-prod">\n' +
//                     '                            <img src="/storage/'+e.images+'" alt=""  height="250px">\n' +
//                     '                        </div>\n' +
//                     '                        <div class="info-prod">\n' +
//                     '                            <a href="./product_detail.html" >'+e.productname+'</a>'
//                     + disount(e.discount)+'\n' +
//                     '                        </div>\n' +
//                     '                        <div class="star-prod">\n' +
//                     '                            <a href="#">\n' +
//                     '                                <input id="input-1" name="input-1" class="rating rating-loading"\n' +
//                     '                                       data-min="0" data-max="5" data-step="0.1" value="'+star(e.star)+'" disabled>\n' +
//                     '                                <div class="star-num">('+e.cmt+')</div>\n' +
//                     '                            </a>\n' +
//                     '                        </div>\n' +
//                     '                        <div class="label-prod">\n' +
//                     '                            <div class="label-prod-item">\n' +
//                     '                                <i class="fal fa-shipping-fast"></i><span>Vận chuyển miễn phí</span>\n' +
//                     '                            </div>\n' +
//                     '                            <div class="label-prod-item"><i class="fal fa-shield-check"></i><span>An tâm giao dịch và tận hưởng ưu đãi độc\n' +
//                     '                                    quyền</span>\n' +
//                     '                            </div>\n' +
//                     '                        </div>\n' +
//                     '                        <div class="price-prod">\n' +
//                     '                            '+pricesale(e.pricesell, e.discount)+'\n' +
//                     '                        </div>\n' +
//                     '                        <div class="add-cart">\n' +
//                     '                            <a href="" class="btn btn-danger">Mua</a>\n' +
//                     '                        </div>\n' +
//                     '                    </div>' +
//                     '<script src="/user/stars/starts-rating.js"></script>'
//
//             })
//             $('.products-list').html(html)
//             $('.pagination').html(`
//                              <nav aria-label="Page navigation">
//                                 <ul class="pagination" id="pagination"></ul>
//                             </nav>`);
//             $('#m-count-product').html(result.length);
//             test()
//         }
//     })
// })

//phân trang

    // $(function () {
    //     let categoryCode = $('#category_code').html()
    //     let typeCode = $('#type_code').html()
    //     let brandCode = $('#brand_code').html()
    //     let count = $('#count_pageing').html()
    //
    //     window.pagObj = $('#pagination').twbsPagination({
    //         totalPages: count,
    //         visiblePages: 6,
    //         onPageClick: function (event, page) {
    //             $.ajax({
    //                 url:'/page',
    //                 type:'get',
    //                 datatype:'JSON',
    //                 data:{page,categoryCode,typeCode,brandCode},
    //                 success:function(result){
    //                     count = $('#count_pageing').html()
    //                     let html = `
    //                                 <div id="category_code" style="display: none">${result.cateName}</div>
    //                                  <div id="type_code" style="display: none" >${result.type}</div>
    //
    //                                 <div id="brand_code" style="display: none" >${result.brand}</div>
    //                                  <div id="count_pageing" style="display: none" >${result.totalProduct}</div>`;
    //                     result.product.forEach(e=>{
    //
    //                         html +=`  <div class="product">
    //                         <div class="product-t">
    //                             <span>0</span>
    //                             <div class="wishlist">
    //                                 <button type="button" class="wishlistBtn"></button>
    //                             </div>
    //                         </div>
    //                         <div class="img-prod">
    //                             <img src="/storage/${e.images}" alt=""  height="250px">
    //                         </div>
    //                         <div class="info-prod">
    //                             <a href="./product_detail.html" >${e.productname}</a>
    //                             ${disount(e.discount)}
    //                         </div>
    //                         <div class="star-prod">
    //                             <a href="#">
    //                                 <input id="input-1" name="input-1" class="rating rating-loading"
    //                                        data-min="0" data-max="5" data-step="0.1" value="${star(e.star)}" disabled>
    //                                 <div class="star-num">(${e.cmt})</div>
    //                             </a>
    //                         </div>
    //                         <div class="label-prod">
    //                             <div class="label-prod-item">
    //                                 <i class="fal fa-shipping-fast"></i><span>Vận chuyển miễn phí</span>
    //                             </div>
    //                             <div class="label-prod-item"><i class="fal fa-shield-check"></i><span>An tâm giao dịch và tận hưởng ưu đãi độc
    //                                     quyền</span>
    //                             </div>
    //                         </div>
    //                         <div class="price-prod">
    //                             ${pricesale(e.pricesell, e.discount)}
    //
    //                         </div>
    //                         <div class="add-cart">
    //                             <a href="" class="btn btn-danger">Mua</a>
    //                         </div>
    //                     </div><script src="/user/stars/starts-rating.js"></script>`;
    //                     })
    //
    //                     $('.products-list').html(html)
    //                     if (page > 1){
    //                         $(window).scrollTop(1000);
    //                     }
    //                 }
    //             })
    //         }
    //     })
    // });



