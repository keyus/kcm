(function(doc){
    //是否存在分类id
    if(getCookie('links_save')=='1'){
        layer.msg('保存成功',{icon:1});
    }
    if(getCookie('links_save')=='0'){
        layer.msg('保存失败，请稍候再试',{icon:2});
    }
    clearCookie('links_save');

        var links=$('#Links_edit')[0],
            name=links.name,
            url=links.url;

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

    //表单简单空检测
        $("input[type=submit]").on('click',function(){
            var file=$('form input[type=file]')[0].files[0];
            if(file && file.size>1024*1024*3){
                layer.msg('图片不能超过2M',{icon:2});
                return false;
            }

            var value={
                name:$.trim(name.value),
                url:$.trim(url.value)
            }
            if(value.name && value.url){
                return true;
            }
            layer.msg('信息填写不完整',{icon:2})
            return false;
        })


    $("#show-upload-img img").on('click',function(){
        var host = window.location;
        var img=host.origin+$.trim($(this).data('img'));
        var data= {
            "title": "", //相册标题
            "id": 123, //相册id
            "start": 0, //初始显示的图片序号，默认0
            "data": [   //相册包含的图片，数组格式
                {
                    "alt": "图片名",
                    "pid": 666, //图片id
                    "src": img, //原图地址
                    "thumb": img
                }
            ]
        }
        layer.photos({
            photos:data,
            shift: 5
        });

    })


})(document)
