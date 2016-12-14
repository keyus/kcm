(function(doc){

    //清除编辑类型cookie
    clearCookie('links_type_id');

    //跳转到编辑页
    $('#add_link_type').on('click',function(){
        clearCookie('links_type_id');
        location.href=config.admin_linkTypeEdit_router;
    })

    //编辑功能
    $('[data-edit]').on('click',function(){
        var id=$(this).data('edit');
        setCookie('links_type_id',id);
        location.href=config.admin_linkTypeEdit_router;
    })

    //删除
    $('[data-delete]').on('click',function(){
        var id=$(this).data('delete');
        layer.confirm('确认删除？', {
            btn: ['确认','取消'] //按钮
        }, function(index) {
            layer.close(index);
            $.post('/api/delete_link_type',{pid:id}).then(function(response){
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




})(document)
