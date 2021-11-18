$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function removeRow(id,url){
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
            $.ajax({
                url:url,
                type:'delete',
                datatype:'JSON',
                data:{id},
                success:function(rs){
                    if(!rs.error){
                        Swal.fire(
                            'Đã xóa!',
                            'success'
                        ).then((result)=>{
                            location.reload();
                        })
                    }else{
                        Swal.fire(
                            'Lỗi!',
                            'Xảy ra lỗi, vui lòng thử lại.',
                            'error'
                        )
                    }
                }
            });
        }
    })
}

function selectImg(event){
    let img=$(event).attr("data-img");
    $('#file').change(function(){
        const form=new FormData();
        form.append('file',$(this)[0].files[0]);
        $.ajax({
            processData:false,
            contentType:false,
            datatype:'JSON',
            type:'POST',
            data:form,
            url:'/admin/upload',
            success:function(result){
                if(!result.error){
                    $('img#'+img).attr("src",result.url);
                    $('input#'+img).val(result.url);
                    img="";
                }else{
                    alert("Upload image error");
                }
            },
            error:function (){
                alert("Error!");
            }
        })
    });
}

// function addProductToReceipt(){
//     $.ajax({
//         url:'/admin/receipt/product/list',
//         type:'GET',
//         success:function (result){
//             html='';
//             for(item of result.products){
//                 html+=`
//                             <tr id="1">
//                                 <td><img src="${item.images}" style="width: 80px"></td>
//                                 <td>${item.productname}</td>
//                                 <td>${item.priceentry}</td>
//                                 <td>${item.category.categoryname}</td>
//                                 <td id="selectProd"><input type="checkbox" data="${item.id}"></td>
//                             </tr>
//                 `;
//             }
//             $('tbody#tableProducts').html(html);
//         },
//         error:function (){
//             alert("Error");
//         }
//     })
// }


//Sắp xếp bằng ajax
function orderMoney(event){
    let order=$(event).attr("data-by");
    let code=$(event).attr("data-cate");
    $.ajax({
        datatype:'JSON',
        type:'GET',
        data: {order,code},
        url:'/admin/product/order',
        success:function(result){
            let html='';
            for(let item of result.products) {
                html += `<tr>
                            <td>${item.id}</td>
                            <td>${item.productname}</td>
                            <td>${toMoney(item.pricesell)}</td>
                            <td class="status-cus">${item.discount} %</td>
                            <td>${item.categoryname}</td>
                            <td class="status-cus">${item.import - item.sell}</td>
                            <td class="status-cus">${item.status}</td>
                            <td><img src="${item.images}" style="width: 100px;"></td>
                            <td>
                                <a href="/admin/product/edit/${result.code}/${item.id}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i></a>
                                <a href='#' class='btn btn-danger btn-sm' onClick='removeRow(${item.id},"/admin/product/delete")'>
                                    <i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>`;
            }
            $('tbody#table-products').html(html);
            if(order=='asc'){
                $('th#orderMoney').attr("data-by","desc");
            }else{
                $('th#orderMoney').attr("data-by","asc");
            }

        },
        error:function (){
            alert("Error!");
        }
    });
    $('#table-data').DataTable();
}
//id="orderMoney" onclick="orderMoney(this)" data-by="asc" data-cate="{{$code}}"

function addImages(event){
    let i=Number($(event).attr("data-count"));
    $('input#countImg').val(i);
    html=`
        <label id="select_imgs" for="file" data-img="image-${i}" onclick="selectImg(this)">
            <img src="" id="image-${i}" alt='Thêm ảnh' style='width:100%;'>
        </label>
        <input type="hidden" name="images-${i}" id="image-${i}">`
    $('div#addImages').append(html);
    i=i+1;
    $(event).attr("data-count",i);
}

function toMoney(totalprice){
    return totalprice.toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND'
    });
}
//Update status
function updateStatus(element,id,status){
    let table=$(element).attr("table");
    $.ajax({
        url:'/admin/status',
        type:'PUT',
        datatype:'JSON',
        data:{status,table,id},
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


