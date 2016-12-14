var doc=document;
var form=doc.getElementById('form');
var error=$('span.error');


$('#login_submit').on('click',function(){
    var user=$.trim(form.user.value),
        password=$.trim(form.password.value),
        check=$.trim(form.check.value);

    if(!user || !password) {
        error.text('请输入用户名或密码');
        return ;
    }
    if(!check) {
        error.text('请输入验证码');
        return ;
    }

    $.post('/api/login_check',{user:user,password:password,check:check}).then(function (data) {
        if(data.success){
            location.href= admin_router
            return ;
        }
        if(data.code){
            error.text('验证码错误');
            $('.refresh').trigger('click');
            return ;
        }
        if(!data.pass){
            error.text('用户名或密码错误');
            $('.refresh').trigger('click');
            return ;
        }

    })
})
$('form input').on('focus',function(){
    error.text('');
})
$('.imgcode,.refresh').on('click',function(){
    var img=doc.querySelector('#checkcode'),
        src=img.src,
        random=Math.random();
    var arr=src.split('?');
    img.src=arr[0]+'?'+random;
})


doc.addEventListener('keyup',function(e){
    if (e.keyCode == "13") {
        $('#login_submit').trigger('click');
    }
},false)