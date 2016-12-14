(function(doc){
    //清楚ID
    clearCookie('slider_id');

    //编辑
    $('table').on('click','[data-edit]',function(){
        var id=$(this).data('edit');
        setCookie('slider_id',id);
        location.href=config.admin_sliderEdit_router;
    })

    //删除
    $('table').on('click','[data-delete]',function(){
        var id=$(this).data('delete');
        var self=this;
        layer.confirm('确认删除？', {
            btn: ['确认','取消'] //按钮
        }, function(index){
            layer.close(index);
            $.post('/api/delete_slider',{id:id}).then(function(response){
                if(response.success){
                    location.reload();
                    return ;
                }
                if(response.fail){
                    layer.msg(response.msg, {icon: 2});
                }

            })
        },function(){
            layer.msg('服务器繁忙，请稍候再试', {icon: 2});
        });
    })

    //跳转到编辑页面
    $('#add_Cate').on('click',function () {
        clearCookie('category_id');
        location.href=config.admin_cateEdit_router
    })

    //查看图片大图
    $('table .img img').on('click',function () {
        if($(this).data('img')){
            var host = window.location;
            var img=host.origin+$(this).data('img');
            var data= {
                "title": "11111", //相册标题
                "id": 123, //相册id
                "start": 0, //初始显示的图片序号，默认0
                "data": [   //相册包含的图片，数组格式
                    {
                        "alt": "图片访问地址:"+img,
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
        }
    })

})(document)
