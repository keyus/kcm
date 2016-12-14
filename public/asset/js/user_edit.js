var User=new Vue({
    el:'#UserForm',
    data:{
        user:'',
        select:'',
        curid:'',
        password:null,
        selected:''
    },
    methods:{
        submit:function(e){
            var post=$.extend(this.user,{pid:this.selected},{password:$.trim(this.password)});
            $.post('/api/update_user',post).then(function(data){
                if(data.fail){
                    layer.msg(data.fail, {icon: 2});
                    return ;
                }
                if(data.success){
                    layer.msg('更新成功', {icon: 1});
                    return ;
                }
            })
        }
    }
})

$(function(){
    var id=getCookie('update_userid');
    User.selected=id;
    $.get('/api/get_user/id/'+id).then(function (data) {
        User.user=data[0];
        User.curid=data[0].pid;
    })
    $.get('/api/get_user/').then(function (data) {
        User.select=data;
    })
})

