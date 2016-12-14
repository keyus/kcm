
var Userlist=new Vue({
    el:'#userlist',
    data:{
        user:''
    },
    methods:{
        edit:function(e){
            setCookie('update_userid',e);
            location.href=config.admin_edit_router;
        },
        delete:function(e,index){
            var self=this;
            layer.confirm('确认删除？', {
                btn: ['确认','取消'] //按钮
            }, function(index){
                layer.close(index);
                $.post('/api/delete_user',{id:e}).then(function(response){
                    if(response.success){
                        self.user.splice(index,1)
                        if(response.self) location.href=config.admin_logout;
                        return ;
                    }
                    layer.msg(response.fail, {icon: 2});
                })
            },function(){

            });

        }
    }
})
$(function(){
    $.get('/api/get_user').then(function (data) {
        Userlist.user=data;
    })
})

