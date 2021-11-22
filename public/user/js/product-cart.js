$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$( document ).ready(function() {


    $(document).on("click",".m-cart-minus" ,function(){
        let id= $(this).parents().eq(3).attr('data-id')
        let count=$(this).parents('.m-product-cart-table-body-count-button').children().eq(1).children().val();
        if(count*1===1){return;}
        count--;
        updateCart(id,count,count+1);
    })

    $(document).on("click",".m-cart-plus" ,function(){
        let id= $(this).parents().eq(3).attr('data-id')
        // console.log("id"+id)
        let count=$(this).parents('.m-product-cart-table-body-count-button').children().eq(1).children().val();
        count++;
        updateCart(id,count,count-1);
    })
    $('input.count').focusin(function (){
        $(this).data('val',$(this).val());
    }).change(function (){
        let id= $(this).parents().eq(3).attr('data-id')
        let countOld=$(this).data('val');
        let count=$(this).val();
        if(count*1<1){
            $(this).val("1");
            totalPrice(id,1);
            return;
        }
        updateCart(id,count,countOld);
    })
});
function putPrice(id,result){
    let getGrandTotal = 0;
    $('.m-cart-total-payment-product').each(function (index, value) {
        let id2= $(this).parents().eq(2).attr('data-id')
        if(id2 == id){
            $(this).html(toMoney(result));
            $(this).attr("data-total",result);
        }
        let grand =  + $(this).attr("data-total");
        getGrandTotal += grand

    });
    $("#m-cart-grand-total").html(toMoney(getGrandTotal));
    $("#m-cart-grand-total").attr("data-total-price",getGrandTotal)
}
function totalPrice(id,count){
    $('.m-cart-price-product').each(function (index, value) {
        let id2= $(this).parents().eq(2).attr('data-id')
        if(id2 == id){
            let price = + $(this).attr("data-price") * count;
            putPrice(id,price)
        }

    });
}
function updateCart(product_id,count,countOld){
    let user=$('div#info-user').attr("data-user");
    if(user){
        let  data = {}
        data['bill_id']=$('#bill_id').val();
        data['id'] = product_id;
        data['count'] = count;
        data['totalprice']=$("#m-cart-grand-total").attr("data-total-price");
        $.ajax({
            url:'/cart',
            type:'put',
            datatype:'json',
            contentType: 'application/json',
            data:JSON.stringify(data),
            success:function (result){
                console.log(result.rs);
                if(result.countOut){
                    if(result.count<countOld){
                        $('button#plus-'+product_id).attr("disabled","true");
                    }
                    $('span#'+product_id).html('Chỉ còn '+result.count+' sản phẩm');
                    $('tr#product-'+product_id).children().eq(2).children().children().eq(1).children().val(countOld);
                }else if (result.error){
                    Swal.fire(
                        'Thông báo!',
                        'Xảy ra lỗi, vui lòng thử lại.',
                        'error'
                    )
                }else{
                    $('tr#product-'+product_id).children().eq(2).children().children().eq(1).children().val(count);
                    totalPrice(product_id,count);
                    $('button#plus-'+product_id).attr("disabled",false);
                }
            },
            error:function (){
                Swal.fire(
                    'Lỗi!',
                    'Xảy ra lỗi, vui lòng thử lại.',
                    'error'
                )
            }
        });
    }
}

function updateCartLocal(op,id){
    let user=$('div#info-user').attr("data-user");
    if(!user){
        let list_cart=[];
        list_cart=JSON.parse(window.localStorage.getItem('list_cart'));
        for (let item of list_cart){
            if(item.product_id===id){
                if(op==1){
                    item.quantily+=1;
                }else {
                    if(item.quantily>1){
                        item.quantily-=1;
                    }
                }
            }
        }
        localStorage.setItem('list_cart', JSON.stringify(list_cart));
    }
}

function removeItemCart(event,id){
    Swal.fire({
        title: 'Bạn có chắc muốn xóa không?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa',
        cancelButtonText:'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            let user=$('div#info-user').attr("data-user");
            if(user){
                bill_id=$('#bill_id').val();
                $.ajax({
                    url:'/cart/delete/'+id,
                    type:'DELETE',
                    datatype: 'JSON',
                    data: {bill_id},
                    success:function (result){
                        $(event).parents().eq(2).remove();
                        updateTotal();
                    },
                    error:function (result){
                        alert(result);
                    }
                })
            }else{
                let list_cart=[];
                list_cart=JSON.parse(window.localStorage.getItem('list_cart'));
                for (let item of list_cart) {
                    if(item.product_id===id){
                        list_cart=list_cart.filter(i=>i!=item);
                    }
                }
                localStorage.setItem('list_cart', JSON.stringify(list_cart));
                $(event).parents().eq(2).remove();
                updateTotal();
            }
        }
    })
}

function updateTotal(){
    let getGrandTotal=0;
    $('.m-cart-total-payment-product').each(function (index,element){
        let grand =  + $(this).attr("data-total");
        getGrandTotal += grand;
    });
    $("#m-cart-grand-total").html(toMoney(getGrandTotal));
    $("#m-cart-grand-total").attr("data-total-price",getGrandTotal);
    if(getGrandTotal==0){
        let html=`
                            <div>
                                <h1>Giỏ hàng</h1>
                                <hr/>
                                <h4>Chưa có sản phẩm nào trong giỏ hàng!</h4>
                            </div>`;
        $('div.main').html(html);
    }
}

function removeCart(){
    Swal.fire({
        title: 'Bạn có chắc muốn xóa không?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa',
        cancelButtonText:'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            let user=$('div#info-user').attr("data-user");
            if(user) {
                bill_id=$('#bill_id').val();
                $.ajax({
                    url:'/cart/delete/',
                    type:'DELETE',
                    datatype: 'JSON',
                    data: {bill_id},
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
            }else {
                window.localStorage.removeItem('list_cart');
                location.reload();
            }
        }
    })
};

function checkOrder(){
    let data={};
    data['id']=[];
    data['count']=[];
    $('tbody tr').each(function (index,element){
        data['id'].push($(element).attr("data-id"));
        data['count'].push($(element).children().eq(2).children().children().eq(1).children().val())
    })
    $.ajax({
        url:'/bill/check',
        type:'post',
        datatype:'JSON',
        contentType: 'application/json',
        data:JSON.stringify(data),
        success:function (result){
            if(!result.error){
                let bill_id=$('input#bill_id').val();
                window.location.href='/bill/'+bill_id;
            }else{
                for(let i=0;i<result.carts.length;i++){
                    let id=result.carts[i].id;
                    $('tr#product-'+id).children().eq(2).children().children().eq(1).children().val(result.carts[i].count);
                    $('span#'+id).html('Chỉ còn '+result.carts[i].count+' sản phẩm');
                    updateCart(id,result.carts[i].count,result.carts[i].count);
                }
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

//Load cart from local storage
$(()=>{
    let user=$('div#info-user').attr("data-user");
    let list_cart=JSON.parse(window.localStorage.getItem('list_cart'));
    if(list_cart){
            $.ajax({
                url:'/cart/load',
                type:'POST',
                datatype:'json',
                data: {list_cart},
                success:function (result){
                    if(!user){
                        let html=`<form method="get" id="m-product-to-bill">
                            <div class="container-fluid m-product-cart-container">
                                <div class="m-product-cart-title">
                                    <h1>Giỏ hàng</h1>
                                </div>
                                <div class="m-product-cart-context">
                                    <table class="table m-product-cart-table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Chi tiết sản phẩm</th>
                                            <th scope="col">Đơn giá</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Tổng</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody class="m-product-cart-table-body">`;
                        let index=0;
                        let totalprice=0;
                        for (item of result){
                            index+=1;
                            html+=`<tr data-id="${index}" class="m-cart-table-line">
                                              <td scope="row">
                                                  <div class="m-product-cart-table-body-img">
                                                       <input type="text" hidden value="${item.product.id}" name="id" id="id" class="id">
                                                        <a href="product-detail/${item.product.productcode}">
                                                            <img src="${item.product.images}" alt="" srcset="">
                                                        </a>
                                                        <div>
                                                            <span>${item.product.productname}</span>
                                                            <input id="input-1" name="input-1" class="rating rating-loading"
                                                                   data-min="0" data-max="5" data-step="0.1" value="4.5" disabled>
                                                        </div>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-product-cart-price-total-button">
                                                        <span class="m-cart-price-product" data-price="${item.product.pricesell*(1-item.product.discount/100)}">${toMoney(item.product.pricesell*(1-item.product.discount/100))}</span>
                                                        <input type="number" hidden value="${item.product.pricesell*(1-item.product.discount/100)}" name="price" id="price" class="price">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-product-cart-table-body-count-button">
                                                        <div class="m-product-cart-table-body-minus">
                                                            <button type="button" onclick="updateCartLocal(0,${item.product.id})" class="m-cart-minus">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </div>
                                                        <div class="m-product-cart-table-body-count">
                                                            <input type="number" value="${item.quantily}" name="count" class="count">
                                                        </div>
                                                        <div class="m-product-cart-table-body-minus">
                                                            <button type="button" onclick="updateCartLocal(1,${item.product.id})" class="m-cart-plus">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-product-cart-price-total-button">
                                                        <span class="m-cart-total-payment-product" data-total="${item.product.pricesell*(1-item.product.discount/100)*item.quantily}">${toMoney(item.product.pricesell*(1-item.product.discount/100)*item.quantily)}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-product-cart-table-body-remove">
                                                        <button type="button" onclick="removeItemCart(this,${item.product.id})">
                                                            <a>
                                                                <i class="fas fa-times"></i>
                                                            </a>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>`;
                            totalprice+=item.product.pricesell*(1-item.product.discount/100)*item.quantily;
                        }
                        html+=`</tbody>
                                    </table>

                                </div>
                                <div class="m-product-cart-button-clear">
                                    <button class="clear-test" type="button" onclick="removeCart()">
                                        Xoá giỏ hàng
                                    </button>
                                </div>
                                <div class="m-product-cart-grand-total">
                                    <div class="row">
                                        <div class="col-xl-8 m-product-cart-add-note">
                                            <div>
                                                <label for="title-note">Thêm ghi chú vào đơn đặt hàng của bạn
                                                </label>
                                            </div>
                                            <div>
                                                <textarea name="note" id="title-note"
                                                          placeholder="Thêm ghi chú vào đơn đặt hàng của bạn" form="m-product-to-bill"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="m-product-cart-price-total">
                                                <div class="m-product-cart-price-title">
                                                    <p>Tổng cộng</p>
                                                </div>
                                                <div class="m-product-cart-price-Subtotal">
                                                    <div>Tổng tiền hàng</div>
                                                    <div><span id="m-cart-grand-total" data-total-price="${totalprice}">${toMoney(totalprice)}</span></div>
                                                </div>
                                                <div class="m-product-cart-price-total-submit">
                                                    <a href="/user/login">
                                                        Mua hàng
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="bill_id" id="bill_id" value="">
                            @csrf
                        </form>`;
                        $('div.main').html(html);
                    }else{
                        window.localStorage.removeItem('list_cart');
                        location.reload();
                    }


                },error:function (){
                    Swal.fire(
                        'Lỗi!',
                        'Xảy ra lỗi, vui lòng thử lại.',
                        'error'
                    )
                }
            })
        }
})

function toMoney(totalprice){
    return totalprice.toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND'
    });
}
