(function(doc){
    var form=doc.querySelector('#Links_type_edit'),
        name=form.name,
        sort=form.sort,
        links_type_id=form.links_type_id,
        submit=form.sub;

        submit.addEventListener('click',function () {
            var value={
                name:$.trim(name.value),
                sort:$.trim(sort.value) || 50,
                links_type_id:$.trim(links_type_id.value)
            }
            if(value.name){
                $.post('/api/edit_link_type',value).then(function (data) {
                    if(data.success){
                        layer.msg(data.msg, {icon: 1});
                        return ;
                    }
                    if(data.fail){
                        layer.msg(data.msg, {icon: 2});
                        return ;
                    }
                },function(){
                    layer.msg('服务器繁忙，请稍候再试', {icon: 2});
                })
            }else{
                layer.msg('信息填写错误',{icon:2});
            }

        })

})(document)
