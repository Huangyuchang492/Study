$.ajaxSetup({
   headers:{
       'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
   }
});

var editor = new wangEditor('content');
if(editor.config)
{
    editor.config.uploadImgUrl = '/laraveldemo/posts/image/upload';
// 设置 headers（举例）
    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    };
    editor.create();
}


$(".preview_input").change(function (event) {
    var file = this.files[0];
    var url=webkitURL.createObjectURL(file);
    $(event.target).next(".preview_img").attr("scr",url);
});

$(".like-button").click(function(event) {
    var target = $(event.target);
    var fans=target.attr('')
    var current_like=target.attr("like-value");
    var user_id=target.attr("like-user");
    if(current_like==1){
        //取消关注
        $.ajax({
            url:"/laraveldemo/user/"+user_id+"/unfan",
            method:"POST",
            dataType:"json",
            success:function (data) {
                if(data.error!==0){
                    alert(data.msg);
                    return ;
                }
                target.attr("like-value",0);
                target.text("关注");
                window.location.reload();
            }
        })
    }else{
        //关注
        $.ajax({
            url:"/laraveldemo/user/"+user_id+"/fan",
            method:"POST",
            dataType:"json",
            success:function (data) {
                if(data.error!==0){
                    alert(data.msg);
                    return;
                }
                target.attr("like-value",1);
                target.text("取消关注");
                window.location.reload();
            }
        })
    }
});

/*
导航栏搜索
 */
$(".btn-default").click(function (event) {
    var target = $(event.target);
    var query =$(".form-control").text();

});
