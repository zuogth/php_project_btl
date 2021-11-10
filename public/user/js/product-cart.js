$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$( document ).ready(function() {


    $(document).on("click",".m-cart-minus" ,function(){
        let id= $(this).parents().eq(3).attr('data-id')
        // console.log("id"+id)

       $('.count').each(function (index, value) {
            let id2 = $(this).parents().eq(3).attr('data-id')
           if(id2 == id){
               let count =+ $(value).val()
               if(count == 1) return;
               count--;
              $(value).val(count)
              totalPrice(id,count)

           }
      });
        updateCart();
    })

    $(document).on("click",".m-cart-plus" ,function(){
        let id= $(this).parents().eq(3).attr('data-id')
        // console.log("id"+id)

       $('.count').each(function (index, value) {
            let id2 = $(this).parents().eq(3).attr('data-id')
            // console.log(id2)
            if(id2 == id){
               let count =+ $(value).val()
               count++;
              $(value).val(count)
              totalPrice(id,count)
            }
      });
        updateCart();
    })
    function totalPrice(id,count){
        $('.m-cart-price-product').each(function (index, value) {
            let id2= $(this).parents().eq(2).attr('data-id')
            if(id2 == id){
                let price = + $(this).attr("data-price") * count;
                putPrice(id,price)
            }

        });
    }

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


    $(document).on("click",".test" ,function(){

        console.log(JSON.stringify(data))

    })
});

function updateCart(){
    let  data = {}
    data['bill_id']=$('#bill_id').val();
    data['id'] = [];
    data['count'] = [];
    data['price'] = [];
    data['note'] = $("#title-note").val()
    data['totalprice']=$("#m-cart-grand-total").attr("data-total-price");
    $('.id').each(function (index, value) {
        var listId = $(this).val()
        data['id'].push(listId)
    });
    $('.count').each(function (index, value) {
        var listId = $(this).val()
        data['count'].push(listId)
    });
    $('.price').each(function (index, value) {
        var listId = $(this).val()
        data['price'].push(listId)
    });
    $.ajax({
        url:'/cart',
        type:'put',
        datatype:'json',
        contentType: 'application/json',
        data:JSON.stringify(data),
        success:function (result){
            if (result.error){
                alert("Error");
            }
        },
        error:function (){
            alert("Error");
        }
    });
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
            bill_id=$('#bill_id').val();
            $.ajax({
                url:'/cart/delete/'+id,
                type:'DELETE',
                datatype: 'JSON',
                data: {bill_id},
                success:function (result){
                    $(event).parents().eq(2).remove();
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
                },
                error:function (result){
                    alert(result);
                }
            })
        }
    })
}


$('button.clear-test').click(function (){
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
        }
    })
})

function toMoney(totalprice){
    return totalprice.toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND'
    });
}
