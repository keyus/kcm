(function(doc){

    if(getCookie('save_slider')=='1'){
        layer.msg('保存成功',{icon:1})
    }
    if(getCookie('save_slider')=='0'){
        layer.msg('保存失败',{icon:2})
    }
    clearCookie("save_slider");


    $("#Slider_edit").on('submit',function(){
        var file=$('form input[type=file]')[0].files[0];
        if(!getCookie("slider_id")){
            if(!file){
                layer.msg('请添加图片',{icon:2});
                return false;
            }
            if(file.size>1024*1024*3){
                layer.msg('图片不能超过2M',{icon:2});
                return false;
            }
        }
    })

    $('.form input[type=file]').on('change',function(){
        var file=this.files[0];
        var self=$(this);
        if(window.FileReader){
            var fr=new FileReader();
            fr.onloadend = function(e) {
                var target=e.target.result;
                $("#show-upload-img").show().find('img').attr('src',target);
            };
            fr.readAsDataURL(file);
        }else{
            layer.msg('实时显示上传图片请使用chrome或者360,搜狗等浏览器，或IE10[2]以上版本',{icon:2})
        }
    })





})(document)
