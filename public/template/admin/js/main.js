$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function removeRow(id,url){
    if(confirm("Xóa không thể khôi phục. Bạn có chắc?")){
        $.ajax({
            url:url,
            type:'delete',
            datatype:'JSON',
            data:{id},
            success:function(result){
                if(!result.error){
                    alert(result.message)
                    location.reload();
                }else{
                    alert("Xóa thất bại, hãy thử lại !");
                }
            }
        });
    }
}

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
                $('#show-thumb').html("<a href="+result.url+" target='_blank'><img src="+result.url+" alt='' style='width:100%;'></a>");
                $('#image').val(result.url);
            }else{
                alert("Upload image error");
            }
        },
        error:function (){
            alert("Error!");
        }
    })
});
