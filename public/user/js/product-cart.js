

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

      $(".total-payment-product")
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
 
    })
    function totalPrice(id,count){
        $('.m-cart-price-product').each(function (index, value) {
            let id2= $(this).parents().eq(2).attr('data-id')          
            if(id2 == id){
                let price = + $(this).html() * count;
                putPrice(id,price)
            }
    
        });
    }

    function putPrice(id,result){
        let getGrandTotal = 0;
        $('.m-cart-total-payment-product').each(function (index, value) {
            let id2= $(this).parents().eq(2).attr('data-id')          
            if(id2 == id){
               $(this).html(result) 
            }
            let grand =  + $(this).html() 
            getGrandTotal += grand 
            
        });
        console.log(getGrandTotal)
        $("#m-cart-grand-total").html(getGrandTotal)
    }
  

    $(document).on("click",".test" ,function(){
           let  data = {}
           data['id'] = [];
           data['count'] = [];
           data['note'] = $("#title-note").val()
           $('.id').each(function (index, value) {
               var listId = $(this).val()
             data['id'].push(listId)
             });
             $('.count').each(function (index, value) {
                var listId = $(this).val()
              data['count'].push(listId)
              });
        console.log(JSON.stringify(data))
       
    })
    
    putPrice(null,null)
});