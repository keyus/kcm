//获取cookie
function getCookie(c_name)
{
    if (document.cookie.length>0)
    {
        c_start=document.cookie.indexOf(c_name + "=")
        if (c_start!=-1)
        {
            c_start=c_start + c_name.length+1
            c_end=document.cookie.indexOf(";",c_start)
            if (c_end==-1) c_end=document.cookie.length
            return unescape(document.cookie.substring(c_start,c_end))
        }
    }
    return ""
}
//设置cookie
function setCookie(name, value, seconds) {
    seconds = seconds || 0;   //seconds有值就直接赋值，没有为0，这个根php不一样。
    var expires = "";
    if (seconds != 0 ) {      //设置cookie生存时间
        var date = new Date();
        date.setTime(date.getTime()+(seconds*1000));
        expires = "; expires="+date.toGMTString();
    }
    document.cookie = name+"="+escape(value)+expires+"; path=/";   //转码并赋值
}
//清除cookie
function clearCookie(name) {
    setCookie(name, "", -1);
}

var admin_router='/admin/';
var config={
    admin_logout:admin_router+'logout',
    admin_edit_router: admin_router+'user/edit',
    admin_cateEdit_router:admin_router+'category/edit',
    admin_articleEdit_router:admin_router+'article/edit',
    admin_linkEdit_router:admin_router+'links/edit',
    admin_linkTypeEdit_router:admin_router+'links/edit_type',
    admin_sliderEdit_router:admin_router+'slider/edit',
    admin_columnEdit_router:admin_router+'column/edit',
};

(function(){
    //重置密码
    var doc=document;
    var update_user=doc.querySelector('#update_user');
    update_user.addEventListener('click',function(){
        var id=this.dataset.id;
        setCookie('update_userid',id);
        location.href= config.admin_edit_router;
    })

    //左侧菜单，伸缩
    $("#side dt").on('click',function(){
        var i=$(this).find("i.iconfont");
        var dom=$(this).next('dd');
        console.log(dom.hasClass('hide'))
        if(dom.hasClass('hide')){
            dom.show();
            i.html("&#xe6d2;");
            dom.removeClass('hide')
            return ;
        }
        dom.addClass('hide')
        dom.hide();
        i.html("&#xe62c;")
    })


})()