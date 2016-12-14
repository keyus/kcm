$(function(){
    var doc=document,
        UserForm=doc.getElementById('UserForm'),
        error=$('.error'),
        button=$('input[type=button]'),
        success=$('.success');
    var input={
        user:UserForm.user,
        password:UserForm.password,
        repassword:UserForm.repassword,
        name:UserForm.name,
        company:UserForm.company,
        address:UserForm.address,
        tel:UserForm.tel,
        pid:UserForm.pid,
        note:UserForm.note,
    }
    $('input').on('focus',function(){
        error.text('');
        success.text('');
    })
    button.on('click',function(){

        var value={
            user:$.trim(input.user.value),
            password:$.trim(input.password.value),
            repassword:$.trim(input.repassword.value),
            name:$.trim(input.name.value),
            company:$.trim(input.company.value),
            address:$.trim(input.address.value),
            tel:$.trim(input.tel.value),
            pid:$.trim(input.pid.value),
            note:$.trim(input.note.value),
        }
        if(!value.user || !value.password || value.password!=value.repassword ){
            error.text('信息填写错误');
            return ;
        }

        this.classList.add('disabled');
        this.value='正在添加..';
        var self=this;

        if(this.classList.contains('disabled')){
            $.post('/api/add_user',value).then(function(data){
                if(data.fail==2){
                    self.classList.remove('disabled')
                    self.value='保存';
                    layer.msg('用户名已经存在', {icon: 2});
                    return ;
                }
                if(data.fail==0){
                    self.classList.remove('disabled')
                    self.value='保存';
                    layer.msg('添加失败，请稍候再试', {icon: 2});
                    return ;
                }
                if(data.success){
                    layer.alert('添加成功！',{}, function(){
                        location.reload();
                    });
                }
            })
        }



    })

})