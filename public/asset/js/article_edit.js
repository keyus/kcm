(function(doc){

    //上传成功
    if(getCookie('upload_article')=='1'){
        layer.msg('保存成功',{icon: 1});
        clearCookie('upload_article');
    }
    //上传失败
    if(getCookie('upload_article')=='0'){
        layer.msg('保存失败',{icon: 2});
        clearCookie('upload_article');
    }

    //实例化编辑器
    var ue = UE.getEditor('editor');
    //是否存在分类id
    var Art=$('#Article')[0],
        title=Art.title;

    //提交表单
    $("#submit").on('click',function(){
        if($.trim(title.value)){
            return true;
        }else{
            layer.msg('标题必须填写',{icon:2})
            return false;
        }
    })

    //显示实时上传图片
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

    $("#show-upload-img img").on('click',function(){

    })


})(document)
