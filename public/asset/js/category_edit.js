(function(doc){
    //是否存在分类id
        var cate=$('#Category_edit')[0],
            name=cate.name,
            sort=cate.sort,
            parent_id=cate.parent_id,
            category_id=cate.category_id;

        $("input[type=button]").on('click',function(){
            var isnav_check=doc.querySelector('input[name=is_nav]:checked'),
                isnav_value;
            if(isnav_check){
                isnav_value=isnav_check.value;
            }else{
                isnav_value=0;
            }
            var value={
                name:$.trim(name.value),
                is_nav:$.trim(isnav_value),
                sort:$.trim(sort.value),
                parent_id:$.trim(parent_id.value),
                category_id:$.trim(category_id.value)
            };
            if(value.name){
                $.post('/api/edit_category',value).then(function (data) {
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
            }
        })


    
})(document)
