$('#m-input-search-product').keyup(()=>{
    let value = $('#m-input-search-product').val();
    search_menu(value)
})
function search_menu(value){
    if (value == '') {
        $('#m-product-result-search').html('');
        return;
    }
    else {
        $.ajax({
            url:'/product-search',
            type:'get',
            dataType:'JSON',
            data:{value},
            success:(result)=>{
                let html = ``;
                result.forEach(e=>{
                    html += ` <div class="h-product-search">
                                    <div>
                                        <img src="${e.images}" alt="">
                                    </div>
                                    <div class="h-product-detail-search">
                                        <div>
                                           ${e.productname}
                                           ${disount_search(e.discount)}
                                        </div>
                                        <div class="mt-1">
                                           ${pricesale_search(e.pricesell,e.discount)}
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        <a href="/product-detail/${e.productcode}" style="color: brown;">chi tiết</a>
                                    </div>
                                </div>`
                })
                $('#m-product-result-search').html(html);
            }
        })
    }

}

function pricesale_search(price, discount){
    let html = '';
    if (discount  > 0){
        html += ' <span style="text-decoration: line-through;color: red ">'+
            toMoney(price) + '</span> - <span>'+ toMoney(price * (100 - discount)/100) +'</span>';

    } else {
        html += ' <span>'+ toMoney(price) +'</span>';
    }
    return html;
}
function disount_search(discount){
    let html = '';
    if (discount > 0 ){
        html = '  <span style="color: red; font-size: 0.8rem">(<span>-'+discount+'</span>%)</span>'
    }
    return html;
}

function toMoney(totalprice){
    return totalprice.toLocaleString('it-IT', {
        style: 'currency',
        currency: 'VND'
    });
}

$(document).on('click','#m-delete-text-input',function (){
    search_menu($('#m-input-search-product').val(''))
})


$(document).ready(function () {
    $("#h-btn-search").click(function () {
        $("#h-search").show();
        $("body").addClass("scroll-hand");
    });
    $(".h-btn-close-search").click(function () {
        $("#h-search").hide();
        $("body").removeClass("scroll-hand");
    });
})
