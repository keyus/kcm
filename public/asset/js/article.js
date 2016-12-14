(function(doc){
    var delete_select=$('#delete_select');
    var select_init_value=$('select#category').val();          //select下拉框初始值

    $('#add_article').on('click',function(){
        clearCookie('article_id');
        location.href=config.admin_articleEdit_router;
    })

    //编辑
    $('[data-edit]').on('click',function(){
        var id=$(this).data('edit');
        setCookie('article_id',id);
        location.href=config.admin_articleEdit_router;
    })

    //单个删除
    $('[data-delete]').on('click',function(){
        var id=$(this).data('delete');
        layer.confirm('确认删除？', {
            btn: ['确认','取消'] //按钮
        }, function(index) {
            layer.close(index);
            $.post('/api/delte_article',{id:id}).then(function(response){
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

    //监听checkbox
    $('table input[type=checkbox]').on('change',function () {
        var checkbox=$('table input[type=checkbox]:checked');
        if(checkbox.length){
            delete_select.removeClass('disabled');
        }else{
            delete_select.addClass('disabled');
        }
    })

    //批量删除
    delete_select.on('click',function(){
        if($(this).hasClass('disabled')){
            return ;
        }
        var arr=[];
        $('table td input[type=checkbox]:checked').each(function(){
            arr.push(this.value);
        })
        arr=arr.join(',');
        console.log(arr);

        layer.confirm('确认删除？', {
            btn: ['确认','取消'] //按钮
        }, function(index) {
            layer.close(index);
            $.post('/api/delte_article',{id:arr}).then(function(response){
                if(response.success){
                    layer.msg(response.msg, {icon: 1});
                    setTimeout(function () {
                        location.reload();
                    },1000)
                    return ;
                }
                if(response.fail){
                    layer.msg(response.msg, {icon: 2});
                }
            },function(){
                layer.msg('服务器繁忙，请稍候再试', {icon: 2});
            })
        });

    })

    //全选
    $('#selectall').on('change',function(){
        if(this.checked){
            $('table td input[type=checkbox]').attr('checked',true);
        }else{
            $('table td input[type=checkbox]').attr('checked',false);
        }
    })

    //搜索input
    $("#search").on('click','.search',function(){
        var text=$.trim($(this).siblings('input').val());
        if(text){
            $("#search").submit();
        }else{
            layer.msg('请输入搜索关键',{icon:2});
        }
    })

    //搜索select筛选
    $("#search").on('change','select#category',function(){
        var text=$(this).val();
        $('#search input[type=text]').val('');
        if(text!=select_init_value){
            $("#search").submit();
        }
    })

    //查看图片大图
    $('table img').on('click',function () {
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
