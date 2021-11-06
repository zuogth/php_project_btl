$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//Hàm thêm product vào list product selected
$('#btnAddProd').click(function (){
    ids=$('tbody input[type=checkbox]:checked').map(function(){
        return $(this).attr("data");
    }).get();
    $.ajax({
        url:'/admin/receipt/product/selected',
        type:"GET",
        datatype:'JSON',
        data: {ids},
        success:function (result){
            html='';
            totalprice=0;
            index=0
            for(item of result.products){
                index++;
                html+=`
                            <tr id="${item.id}">
                                <td><img src="${item.images}" style="width: 80px"></td>
                                <td>${item.productname}</td>
                                <td id="priceentry" data="${item.priceentry}">${toMoney(item.priceentry)}</td>
                                <td><input type="number" value="1" name="quantily-${index}" id="quantily" onchange="updateTotal()" price="${item.priceentry}"></td>
                                <td>${item.category.categoryname}</td>
                                <td>
                                    <a class="btn btn-danger btn-xs" onclick="removeProduct(${item.id})"><i class="fas fa-times"></i></a>
                                </td>
                                <input type="hidden" name="product-${index}" id="product" value="${item.id}">
                            </tr>
                `;
                totalprice+=item.priceentry;
            }
            $('tbody#productsSelected').html(html);
            totalprice_s=totalprice.toLocaleString('it-IT',{
                style:'currency',
                currency:'VND'
            });
            $('input#totalprice_s').val(totalprice_s);
            $('input#totalprice').val(totalprice);
            $('input#count_prod').val(index);
            $('input#product_selected').val('true');
        },
        error:function (){
            alert("Error!");
        }
    })
});

//Hàm xóa product selected
function removeProduct(id){
    $('tr#'+id).remove();
    updateListProdSelected('quantily');
    updateListProdSelected('product');
    totalPrice();
    let count=$('tbody#productsSelected tr').length;
    $('input#count_prod').val(count);
    if(count==0){
        $('input#product_selected').val('');
    }
}

//Hàm update list product selected
function updateListProdSelected(name){
    $('input#'+name).each(function (index,element){
        let str=name+'-'+(index+1);
        $(element).attr("name",str);
    });
}
//Hàm chuyển định dạng tiền
function toMoney(totalprice){
    return totalprice.toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND'
    });
}

//Hàm tính tổng tiền trong đơn nhập hàng
function totalPrice(){
    totalprice=0;
    $('td#priceentry').each(function(index,element){
        price=Number($(element).attr("data"));
        sl=Number($('td input#quantily:eq('+index+')').val());
        console.log(price+' '+sl);
        totalprice+=price*sl;
    })
    totalprice_s=toMoney(totalprice);
    $('input#totalprice_s').val(totalprice_s);
    $('input#totalprice').val(totalprice);
}


function updateTotal(){
    totalPrice();
}
