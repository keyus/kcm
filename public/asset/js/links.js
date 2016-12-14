(function(doc){
    //清楚ID
    clearCookie('links_id');

    if(getCookie('error_links_id')){
        clearCookie('error_links_id');
        layer.msg('你访问了一个错误的页面',{icon:2});
    }

    //跳转到编辑页
    $('#add_link').on('click',function(){
        location.href=config.admin_linkEdit_router;
    })

    //编辑功能
    $('[data-edit]').on('click',function(){
        var id=$(this).data('edit');
        setCookie('links_id',id);
        location.href=config.admin_linkEdit_router;
    })

    //删除
    $('[data-delete]').on('click',function(){
        var id=$(this).data('delete');
        layer.confirm('确认删除？', {
            btn: ['确认','取消'] //按钮
        }, function(index) {
            layer.close(index);
            $.post('/api/delte_link',{id:id}).then(function(response){
                if(response.success){
                    location.reload();
                }
                if(response.fail){
                    layer.msg(response.msg, {icon: 2});
                }
            },function(){
                layer.msg('服务器繁忙，请稍候再试', {icon: 2});
            })
        });
    })


    //搜索select筛选
    var select_init_value=$('#search select#links_type').val();    //初始值select
    $("#search").on('change','select#links_type',function(){
        var text=$(this).val();
        console.log(text)
        if(text!=select_init_value){
            $("#search").submit();
        }
    })

    //提示
    $('table .what-show-img').on('click',function(){
        layer.tips('点击图片地址，可查看图片', this);
    })

    //加载图片
    $('table .show_img').on('click',function(){
        if($(this).data('img')){
            var host = window.location;
            var img=host.origin+$(this).data('img');
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
        }
    })


})(document)
