(function(){
    //三级分类树伸展
    $(".outcate i.iconfont").on('click',function(){
        var self=$(this),
            parent=self.parent('td'),
            parents=self.parents('tr'),
            show=parent.data('show'),
            type=parent.data('type');

        if(show==1){
            //收缩
            console.log(1)
            checkType(type,parents,'hide');
            parent.data('show',0);
            self.html("&#xe623;");
        }else{
            //展开
            console.log(2)
            checkType(type,parents,'show');
            parent.data('show',1);
            self.html("&#xe6d2;");
        }
    })
    //检测类型
    function checkType(type,dom,handle){
        if(handle=='hide'){
            if(type==1){
                dom.nextUntil('.data'+type).hide();
            }
            if(type==2){
                dom.nextAll('.data'+3).hide();
            }
        }else{
            if(type==1){
                dom.nextUntil('.data'+type).show();
            }
            if(type==2){
                dom.nextAll('.data'+3).show();
            }
        }
    }

    //编辑
    $('table').on('click','[data-edit_id]',function(){
        var id=$(this).data('edit_id');
        setCookie('category_id',id);
        location.href=config.admin_cateEdit_router;
    })

    //删除
    $('table').on('click','[data-delete_id]',function(){
        var id=$(this).data('delete_id');
        var self=this;
        layer.confirm('确认删除？', {
            btn: ['确认','取消'] //按钮
        }, function(index){
            layer.close(index);
            $.post('/api/delete_category',{pid:id}).then(function(response){
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

})()
